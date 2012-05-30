<?php

require_once "PHP/CodeSniffer.php";

class DWS_Sniffs_ControlStructures_ControlSignatureSniff_Test extends PHPUnit_Framework_TestCase
{
    private $_phpcs;

    public function setUp()
    {
        $this->_phpcs = new PHP_CodeSniffer(0, 0, "iso-8859-1", false);
    }

    public function testInlineIfSpaceMissing()
    {
        $this->_phpcs->process(
            __DIR__ . "/InlineIfSpaceMissing.phps", //File
            "DWS", //Standard
            array("DWS_Sniffs_ControlStructures_ControlSignatureSniff"), //Sniff
            null
        );

        $messageFound = strstr(
            print_r($this->_phpcs->getFilesErrors(), true),
            'Expected "if (...)\n"; found "if(...)\n"'
        );

        $this->assertTrue($messageFound !== false, 'PHPCS errors didn\'t contain \'Expected "if (...)\n"; found "if(...)\n"\'');
    }

    public function testStructuredIfSpaceMissing()
    {
        $this->_phpcs->process(
            __DIR__ . "/StructuredIfSpaceMissing.phps", //File
            "DWS", //Standard
            array("DWS_Sniffs_ControlStructures_ControlSignatureSniff"), //Sniff
            null
        );

        $messageFound = strstr(
            print_r($this->_phpcs->getFilesErrors(), true),
            'Expected "if (...) {\n"; found "if(...)\n{\n"'
        );

        $this->assertTrue($messageFound !== false, 'PHPCS errors didn\'t contain \'Expected "if (...) {\n"; found "if(...)\n{\n"\'');
    }

    public function tearDown()
    {

    }
}
