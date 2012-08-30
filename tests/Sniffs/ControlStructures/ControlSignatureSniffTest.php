<?php
require_once 'PHP/CodeSniffer.php';
require_once __DIR__ . '/../../SniffTestCase.php';

class DWS_Sniffs_ControlStructures_ControlSignatureSniff_Test extends SniffTestCase
{
    private $_structuredIfSpaceMissingFailure;

    private $_structuredIfSpaceMissingPass;

    private $_doWhile;

    private $_brokenDoWhile;

    /**
     * Setup the test fixture
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp(array('DWS_Sniffs_ControlStructures_ControlSignatureSniff'));
        $this->_structuredIfSpaceMissingFailure = <<< 'NOWDOC'
<?php
if($value === true) {
    echo 3;
}
NOWDOC;
        $this->_structuredIfSpaceMissingPass = <<< 'NOWDOC'
<?php
if ($value === true) {
    echo 3;
}
NOWDOC;
        $this->_doWhile = <<< 'NOWDOC'
<?php
do {
    echo 3;
} while (true);

NOWDOC;
        $this->_brokenDoWhile = <<< 'NOWDOC'
<?php
do {
    echo 3;
} while(true);

NOWDOC;
    }

    /**
     * Verify that a missing space in front of a structured if reports an error
     *
     * @return void
     */
    public function testStructuredIfSpaceMissing()
    {
        $this->_phpcs->processFile('StructuredIfSpaceMissing', $this->_structuredIfSpaceMissingFailure);

        $this->assertErrorMessages('Expected "if (...) {\n"; found "if(...) {\n"');
    }

    /**
     * Verify that correct structured if spacing does not report an error
     *
     * @return void
     */
    public function testStructuredIfSpaceMissingPass()
    {
        $this->_phpcs->processFile('StructuredIfSpaceMissingPass', $this->_structuredIfSpaceMissingPass);

        $this->assertNoErrors('StructuredIfSpaceMissingPass');
    }

    /**
     * Verify that do whiles are allowed
     *
     * @return void
     */
    public function testDoWhile()
    {
        $this->_phpcs->processFile('DoWhile', $this->_doWhile);

        $this->assertNoErrors('DoWhile');
    }

    /**
     * Verify that broken do while's still fail
     *
     * @return void
     */
    public function testBrokenDoWhile()
    {
        $this->_phpcs->processFile('BrokenDoWhile', $this->_brokenDoWhile);

        $this->assertErrorMessages('Expected "do {\n...} while (...);\n"; found "do {\n...} while(...);\n"');
    }
}
