<?php
abstract class SniffTestCase extends PHPUnit_Framework_TestCase
{
    protected $_phpcs;

    protected $_standard;

    /**
     * Setup the test fixture
     *
     * @param array $sniffs The sniffs to use in this test
     *
     * @return void
     */
    public function setUp($sniffs)
    {
        $this->_standard = dirname(__DIR__) . '/DWS';
        $this->_phpcs = new PHP_CodeSniffer();
        $this->_phpcs->process(array(), $this->_standard, $sniffs);
    }

    /**
     * Verify that a specific error was reported
     *
     * @param string|array $expectedErrorMessages The expected error messages
     *
     * @return void
     */
    protected function assertErrorMessages($expectedErrorMessages)
    {
        if (is_string($expectedErrorMessages) === true) {
            $expectedErrorMessages = array($expectedErrorMessages);
        }

        foreach ($expectedErrorMessages as $expectedMessage) {
            $this->assertContains(
                $expectedMessage,
                print_r($this->_phpcs->getFilesErrors(), true),
                print_r($this->_phpcs->getFilesErrors(), true)
            );
        }
    }

    /**
     * Verify that no errors were reported
     *
     * @param string $fileName The filename to check
     *
     * @return void
     */
    protected function assertNoErrors($fileName)
    {
        $errors = $this->_phpcs->getFilesErrors();
        $errorsText = print_r($errors, true);

        $this->assertSame(0, $errors[$fileName]['numWarnings'], "PHPCS warnings wasn't empty for {$fileName}.  The errors were: {$errorsText}");
        $this->assertSame(0, $errors[$fileName]['numErrors'], "PHPCS errors wasn't empty for {$fileName}.  The errors were: {$errorsText}");
    }
}
