<?php
require_once 'PHP/CodeSniffer.php';
require_once __DIR__ . '/../../SniffTestCase.php';

class DWS_Sniffs_Strings_DoubleQuoteUsageSniff_Test extends SniffTestCase
{
    private $_unwarrentedDoubleQuotes;

    private $_warrentedDoubleQuotesVariable;

    private $_warrentedDoubleQuotesControlCharacter;

    private $_unwarrentedDoubleQuotesMultiLine;

    private $_warrentedDoubleQuotesMultiLine;

    public function setUp()
    {
        parent::setUp(array('DWS_Sniffs_Strings_DoubleQuoteUsageSniff'));
        $this->_unwarrentedDoubleQuotes = <<< 'NOWDOC'
<?php
$foo = "Hello, World";
NOWDOC;
        $this->_warrentedDoubleQuotesVariable = <<< 'NOWDOC'
<?php
$world = 'World';
$foo = "Hello, $world";
NOWDOC;
        $this->_warrentedDoubleQuotesControlCharacter = <<< 'NOWDOC'
<?php
$foo = "Hello, World\n";
NOWDOC;
        $this->_unwarrentedDoubleQuotesMultiLine = <<< 'NOWDOC'
<?php
$foo = "Hello,
World";
NOWDOC;
        $this->_warrentedDoubleQuotesMultiLine = <<< 'NOWDOC'
<?php
$world = 'World';
$foo = "Hello,
$world";
NOWDOC;
    }

    public function testUnwarrentedDoubleQuotes()
    {
        $this->_phpcs->processFile('UnwarrentedDoubleQuotes', $this->_unwarrentedDoubleQuotes);

        $this->assertErrorMessages('String "Hello, World" does not require double quotes; use single quotes instead');
    }

    public function testWarrentedDoubleQuotesVariable()
    {
        $this->_phpcs->processFile('WarrentedDoubleQuotesVariable', $this->_warrentedDoubleQuotesVariable);

        $this->assertNoErrors('WarrentedDoubleQuotesVariable');
    }

    public function testWarrentedDoubleQuotesControlCharacter()
    {
        $this->_phpcs->processFile('WarrentedDoubleQuotesControlCharacter', $this->_warrentedDoubleQuotesControlCharacter);

        $this->assertNoErrors('WarrentedDoubleQuotesControlCharacter');
    }

    public function testUnwarrentedDoubleQuotesMultiLine()
    {
        $this->_phpcs->processFile('UnwarrentedDoubleQuotesMultiLine', $this->_unwarrentedDoubleQuotesMultiLine);

        $this->assertErrorMessages("String \"Hello,\nWorld\" does not require double quotes; use single quotes instead");
    }

    public function testWarrentedDoubleQuotesMultiLine()
    {
        $this->_phpcs->processFile('WarrentedDoubleQuotesMultiLine', $this->_warrentedDoubleQuotesMultiLine);

        $this->assertNoErrors('WarrentedDoubleQuotesMultiLine');
    }
}
