<?php
/**
 * An abstract class that all sniff unit tests must extend.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 */

define('PHP_CODESNIFFER_IN_TESTS', true);

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * An abstract class that all sniff unit tests must extend.
 *
 * A sniff unit test checks a .inc file for expected violations of a single
 * coding standard. Expected errors and warnings that are not found, or
 * warnings and errors that are not expected, are considered test failures.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 */
abstract class AbstractSniffUnitTest extends PHPUnit_Framework_TestCase
{
    /**
     * The PHP_CodeSniffer object used for testing.
     *
     * @var PHP_CodeSniffer
     */
    protected static $_phpcs = null;

    /**
     * Sets up this unit test.
     *
     * @return void
     */
    protected function setUp()
    {
        if (self::$_phpcs === null) {
            self::$_phpcs = new PHP_CodeSniffer();
        }
    }

    /**
     * Tests the extending classes Sniff class.
     *
     * @return void
     * @throws PHPUnit_Framework_Error
     * @test
     */
    public final function runTest()
    {
        self::$_phpcs->process(array(), 'DWS', array($this->_getSniffName()));
        self::$_phpcs->setIgnorePatterns(array());

        $testFile = dirname(__DIR__) . '/tests/' . str_replace('_', '/', get_class($this)) . '.inc';
        if (!file_exists($testFile)) {
            $this->markTestSkipped();
            return;
        }

        try {
            self::$_phpcs->processFile($testFile);
        } catch (Exception $e) {
            $this->fail("An unexpected exception has been caught: {$e->getMessage()}");
        }

        $files = self::$_phpcs->getFiles();
        if ($files === array()) {
            echo "Skipped: {$testFile}\n";
            $this->markTestSkipped();
        }

        $failureMessages = $this->generateFailureMessages($files[0]);
        if (count($failureMessages) > 0) {
            $this->fail(implode("\n", $failureMessages));
        }
    }

    /**
     * Generate a list of test failures for a given sniffed file.
     *
     * @param PHP_CodeSniffer_File $file The file being tested.
     *
     * @return array
     * @throws PHP_CodeSniffer_Exception
     */
    public function generateFailureMessages(PHP_CodeSniffer_File $file)
    {
        $testFile = $file->getFilename();
        $foundErrors = $file->getErrors();
        $foundWarnings = $file->getWarnings();
        $expectedErrors = $this->getErrorList(basename($testFile));
        $expectedWarnings = $this->getWarningList(basename($testFile));

        if (!is_array($expectedErrors)) {
            throw new PHP_CodeSniffer_Exception('getErrorList() must return an array');
        }

        if (!is_array($expectedWarnings)) {
            throw new PHP_CodeSniffer_Exception('getWarningList() must return an array');
        }

        /*
         We merge errors and warnings together to make it easier
         to iterate over them and produce the errors string. In this way,
         we can report on errors and warnings in the same line even though
         it's not really structured to allow that.
        */
        $allProblems = array();
        $failureMessages = array();
        foreach ($foundErrors as $line => $lineErrors) {
            if (!array_key_exists($line, $allProblems)) {
                $allProblems[$line] = array(
                    'expected_errors' => 0,
                    'expected_warnings' => 0,
                    'found_errors' => array(),
                    'found_warnings' => array(),
                );
            }

            foreach ($lineErrors as $column => $errors) {
                $errorsTemp = array();
                foreach ($errors as $foundError) {
                    $errorsTemp[] = $foundError['message'];
                }

                $allProblems[$line]['found_errors'] = array_merge($allProblems[$line]['found_errors'], $errorsTemp);
            }

            $allProblems[$line]['expected_errors'] = array_key_exists($line, $expectedErrors) ? $expectedErrors[$line] : 0;
            unset($expectedErrors[$line]);
        }

        foreach ($expectedErrors as $line => $numErrors) {
            if (!array_key_exists($line, $allProblems)) {
                $allProblems[$line] = array(
                    'expected_errors' => 0,
                    'expected_warnings' => 0,
                    'found_errors' => array(),
                    'found_warnings' => array(),
                );
            }

            $allProblems[$line]['expected_errors'] = $numErrors;
        }

        foreach ($foundWarnings as $line => $lineWarnings) {
            if (!array_key_exists($line, $allProblems)) {
                $allProblems[$line] = array(
                    'expected_errors' => 0,
                    'expected_warnings' => 0,
                    'found_errors' => array(),
                    'found_warnings' => array(),
                );
            }

            foreach ($lineWarnings as $column => $warnings) {
                $warningsTemp = array();
                foreach ($warnings as $warning) {
                    $warningsTemp[] = $warning['message'];
                }

                $allProblems[$line]['found_warnings'] = array_merge($allProblems[$line]['found_warnings'], $warningsTemp);
            }

            $allProblems[$line]['expected_warnings'] = array_key_exists($line, $expectedWarnings) ? $expectedWarnings[$line] : 0;
            unset($expectedWarnings[$line]);
        }

        foreach ($expectedWarnings as $line => $numWarnings) {
            if (!array_key_exists($line, $allProblems)) {
                $allProblems[$line] = array(
                    'expected_errors' => 0,
                    'expected_warnings' => 0,
                    'found_errors' => array(),
                    'found_warnings' => array(),
                );
            }

            $allProblems[$line]['expected_warnings'] = $numWarnings;
        }

        ksort($allProblems);
        foreach ($allProblems as $line => $problems) {
            $numErrors = count($problems['found_errors']);
            $numWarnings = count($problems['found_warnings']);
            $expectedErrors = $problems['expected_errors'];
            $expectedWarnings = $problems['expected_warnings'];
            $errors = '';
            $foundString = '';

            if ($expectedErrors !== $numErrors || $expectedWarnings !== $numWarnings) {
                $lineMessage = "[LINE {$line}]";
                $expectedMessage = 'Expected ';
                $foundMessage = 'in ' . basename($testFile) . ' but found ';

                if ($expectedErrors !== $numErrors) {
                    $expectedMessage .= "{$expectedErrors} error(s)";
                    $foundMessage .= "{$numErrors} error(s)";
                    if ($numErrors !== 0) {
                        $foundString .= 'error(s)';
                        $errors .= implode("\n -> ", $problems['found_errors']);
                    }

                    if ($expectedWarnings !== $numWarnings) {
                        $expectedMessage .= ' and ';
                        $foundMessage .= ' and ';

                        if ($numWarnings !== 0 && $foundString !== '') {
                            $foundString .= ' and ';
                        }
                    }
                }

                if ($expectedWarnings !== $numWarnings) {
                    $expectedMessage .= "{$expectedWarnings} warning(s)";
                    $foundMessage .= "{$numWarnings} warning(s)";
                    if ($numWarnings !== 0) {
                        $foundString .= 'warning(s)';
                        if ($errors !== '') {
                            $errors .= "\n -> ";
                        }

                        $errors .= implode("\n -> ", $problems['found_warnings']);
                    }
                }

                $fullMessage = "{$lineMessage} {$expectedMessage} {$foundMessage}.";
                if ($errors !== '') {
                    $fullMessage .= " The {$foundString} found were:\n -> {$errors}";
                }

                $failureMessages[] = $fullMessage;
            }
        }

        return $failureMessages;
    }

    /**
     * Returns the lines where errors should occur.
     *
     * The key of the array should represent the line number and the value
     * should represent the number of errors that should occur on that line.
     *
     * @return array(int => int)
     */
    protected abstract function getErrorList();

    /**
     * Returns the lines where warnings should occur.
     *
     * The key of the array should represent the line number and the value
     * should represent the number of warnings that should occur on that line.
     *
     * @return array(int => int)
     */
    protected abstract function getWarningList();

    protected abstract function _getSniffName();
}
