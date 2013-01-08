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

    /**
     * Setup the test fixture
     *
     * @return void
     */
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

    /**
     * Verify that unwarrented double quotes report an error
     *
     * @return void
     */
    public function testUnwarrentedDoubleQuotes()
    {
        $this->_phpcs->processFile('UnwarrentedDoubleQuotes', $this->_unwarrentedDoubleQuotes);

        $this->assertErrorMessages('String "Hello, World" does not require double quotes; use single quotes instead');
    }

    /**
     * Verify that double quotes with a variable does not report an error
     *
     * @return void
     */
    public function testWarrentedDoubleQuotesVariable()
    {
        $this->_phpcs->processFile('WarrentedDoubleQuotesVariable', $this->_warrentedDoubleQuotesVariable);

        $this->assertNoErrors('WarrentedDoubleQuotesVariable');
    }

    /**
     * Verify that double quotes with a control character does not report an error
     *
     * @return void
     */
    public function testWarrentedDoubleQuotesControlCharacter()
    {
        $this->_phpcs->processFile('WarrentedDoubleQuotesControlCharacter', $this->_warrentedDoubleQuotesControlCharacter);

        $this->assertNoErrors('WarrentedDoubleQuotesControlCharacter');
    }

    /**
     * Verify that unwarrented double quotes in a multiline string reports an error
     *
     * @return void
     */
    public function testUnwarrentedDoubleQuotesMultiLine()
    {
        $this->_phpcs->processFile('UnwarrentedDoubleQuotesMultiLine', $this->_unwarrentedDoubleQuotesMultiLine);

        $this->assertErrorMessages("String \"Hello,\nWorld\" does not require double quotes; use single quotes instead");
    }

    /**
     * Verify that warrented double quotes in a multiline string does not report an error
     *
     * @return void
     */
    public function testWarrentedDoubleQuotesMultiLine()
    {
        $this->_phpcs->processFile('WarrentedDoubleQuotesMultiLine', $this->_warrentedDoubleQuotesMultiLine);

        $this->assertNoErrors('WarrentedDoubleQuotesMultiLine');
    }
}
