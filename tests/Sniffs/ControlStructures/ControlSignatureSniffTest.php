<?php
require_once 'PHP/CodeSniffer.php';
require_once __DIR__ . '/../../SniffTestCase.php';

class DWS_Sniffs_ControlStructures_ControlSignatureSniff_Test extends SniffTestCase
{
    private $_structuredIfSpaceMissingFailure;

    private $_structuredIfSpaceMissingPass;

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
    }

    public function testStructuredIfSpaceMissing()
    {
        $this->_phpcs->processFile('StructuredIfSpaceMissing', $this->_structuredIfSpaceMissingFailure);

        $this->assertErrorMessages('Expected "if (...) {\n"; found "if(...) {\n"');
    }

    public function testStructuredIfSpaceMissingPass()
    {
        $this->_phpcs->processFile('StructuredIfSpaceMissingPass', $this->_structuredIfSpaceMissingPass);

        $this->assertNoErrors('StructuredIfSpaceMissingPass');
    }
}
