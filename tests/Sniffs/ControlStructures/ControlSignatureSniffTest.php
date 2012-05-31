<?php

require_once 'PHP/CodeSniffer.php';

class DWS_Sniffs_ControlStructures_ControlSignatureSniff_Test extends PHPUnit_Framework_TestCase
{
    private $_phpcs;

    private $_inlineIfSpaceMissingFailure;

    private $_structuredIfSpaceMissingFailure;

    public function setUp()
    {
        $this->_phpcs = new PHP_CodeSniffer();
        $this->_inlineIfSpaceMissingFailure = <<< 'IISMF'
<?php
if($value === true)
    echo 3;
IISMF;

        $this->_structuredIfSpaceMissingFailure = <<< 'SISMF'
<?php
if($value === true) {
    echo 3;
}'
SISMF;
    }

    public function testInlineIfSpaceMissing()
    {
        $this->_phpcs->process(
            array(),
            'DWS', //Standard
            array('DWS_Sniffs_ControlStructures_ControlSignatureSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('InlineIfSpaceMissing', $this->_inlineIfSpaceMissingFailure);

        $expectedMessage = 'Expected "if (...)\n"; found "if(...)\n"';

        $errors = print_r($this->_phpcs->getFilesErrors(), true);

        $messageFound = strstr($errors, $expectedMessage);

        $this->assertTrue($messageFound !== false, "PHPCS errors didn't contain $expectedMessage the errors were: $errors");
    }

    public function testStructuredIfSpaceMissing()
    {
        $this->_phpcs->process(
            array(),
            'DWS', //Standard
            array('DWS_Sniffs_ControlStructures_ControlSignatureSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('StructuredIfSpaceMissing', $this->_structuredIfSpaceMissingFailure);

        $expectedMessage = 'Expected "if (...) {\n"; found "if(...) {\n"';

        $errors = print_r($this->_phpcs->getFilesErrors(), true);

        $messageFound = strstr($errors, $expectedMessage);

        $this->assertTrue($messageFound !== false, "PHPCS errors didn't contain $expectedMessage the errors were: $errors");
    }
}
