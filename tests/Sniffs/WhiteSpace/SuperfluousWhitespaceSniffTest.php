<?php
require_once 'PHP/CodeSniffer.php';
require_once __DIR__ . '/../../SniffTestCase.php';

class DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniff_Test extends SniffTestCase
{
    private $_spaceInBeginning;

    private $_twoBlankLinesBeforeFunction;

    private $_twoBlankLinesInFunction;

    private $_twoBlankLinesAfterFunction;

    private $_blankLineAfterClass;

    private $_blankLineBeforeEndClass;

    private $_blankLineAfterIf;

    private $_blankLineBeforeEndIf;

    /**
     * Setup the test fixture
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp(array('DWS_Sniffs_Strings_DoubleQuoteUsageSniff'));
        $this->_spaceInBeginning = <<< 'NOWDOC'

<?php
echo 3;
NOWDOC;
        $this->_twoBlankLinesBeforeFunction = <<< 'NOWDOC'
<?php


function foo ()
{
    echo 3;
}
NOWDOC;
        $this->_twoBlankLinesInFunction = <<< 'NOWDOC'
<?php
function foo ()
{
    echo 3;


    echo 4;
}
NOWDOC;
        $this->_twoBlankLinesAfterFunction = <<< 'NOWDOC'
<?php
function foo ()
{
    echo 3;
}


NOWDOC;
        $this->_blankLineAfterClass = <<< 'NOWDOC'
<?php
class Foo
{

    function bar ()
    {
        echo 3;
    }
}
NOWDOC;
        $this->_blankLineBeforeEndClass = <<< 'NOWDOC'
<?php
class Foo
{
    function bar ()
    {
        echo 3;
    }

}
NOWDOC;
        $this->_blankLineAfterIf = <<< 'NOWDOC'
<?php
if($i < 3) {

    echo 3;
}
NOWDOC;
        $this->_blankLineBeforeEndIf = <<< 'NOWDOC'
<?php
if($i < 3) {
    echo 3;

}
NOWDOC;
        $this->_blankLineAfterFunction = <<< 'NOWDOC'
<?php
function foo()
{

    echo 3;
}
NOWDOC;
        $this->_blankLineBeforeEndFunction = <<< 'NOWDOC'
<?php
function foo()
{
    echo 3;

}
NOWDOC;
    }

    /**
     * Verify that a space at the beginning of a file reports an error
     *
     * @return void
     */
    public function testSpaceInBeginning()
    {
        $this->_phpcs->process(
            array(),
            $this->_standard,
            array('DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('SpaceInBeginning', $this->_spaceInBeginning);

        $this->assertErrorMessages('Additional whitespace found at start of file');
    }

    /**
     * Verify that two blank lines before a function reports an error
     *
     * @return void
     */
    public function testTwoBlankLinesBeforeFunction()
    {
        $this->_phpcs->process(
            array(),
            $this->_standard,
            array('DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('TwoBlankLinesBeforeFunction', $this->_twoBlankLinesBeforeFunction);

        $this->assertErrorMessages('Multiple empty lines in a row; found 2 empty lines');
    }

    /**
     * Verify that two blank lines in a function reports an error
     *
     * @return void
     */
    public function testTwoBlankLinesInFunction()
    {
        $this->_phpcs->process(
            array(),
            $this->_standard,
            array('DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('TwoBlankLinesInFunction', $this->_twoBlankLinesInFunction);

        $this->assertErrorMessages('Multiple empty lines in a row; found 2 empty lines');
    }

    /**
     * Verify that two blank lines after a function reports an error
     *
     * @return void
     */
    public function testTwoBlankLinesAfterFunction()
    {
        $this->_phpcs->process(
            array(),
            $this->_standard,
            array('DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('TwoBlankLinesAfterFunction', $this->_twoBlankLinesAfterFunction);

        $this->assertErrorMessages('Empty lines at end of file');
    }

    /**
     * Verify that a blank line after a class reports an error
     *
     * @return void
     */
    public function testBlankLineAfterClass()
    {
        $this->_phpcs->process(
            array(),
            $this->_standard,
            array('DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('BlankLineAfterClass', $this->_blankLineAfterClass);

        $this->assertErrorMessages('Blank line at beginning of class');
    }

    /**
     * Verify that a blank line at the end of a class reports an error
     *
     * @return void
     */
    public function testBlankLineBeforeEndClass()
    {
        $this->_phpcs->process(
            array(),
            $this->_standard,
            array('DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('BlankLineBeforeEndClass', $this->_blankLineBeforeEndClass);

        $this->assertErrorMessages('Blank line at end of class');
    }

    /**
     * Verify that a blank line after an if reports an error
     *
     * @return void
     */
    public function testBlankLineAfterIf()
    {
        $this->_phpcs->process(
            array(),
            $this->_standard,
            array('DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('BlankLineAfterIf', $this->_blankLineAfterIf);

        $this->assertErrorMessages('Blank line at beginning of if');
    }

    /**
     * Verify that a blank line at the end of an if reports an error
     *
     * @return void
     */
    public function testBlankLineBeforeEndIf()
    {
        $this->_phpcs->process(
            array(),
            $this->_standard,
            array('DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('BlankLineBeforeEndIf', $this->_blankLineBeforeEndIf);

        $this->assertErrorMessages('Blank line at end of if');
    }

    /**
     * Verify that a blank line after a function reports an error
     *
     * @return void
     */
    public function testBlankLineAfterFunction()
    {
        $this->_phpcs->process(
            array(),
            $this->_standard,
            array('DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('BlankLineAfterFunction', $this->_blankLineAfterFunction);

        $this->assertErrorMessages('Blank line at beginning of function');
    }

    /**
     * Verify that a blank line at the end of a function reports an error
     *
     * @return void
     */
    public function testBlankLineBeforeEndFunction()
    {
        $this->_phpcs->process(
            array(),
            $this->_standard,
            array('DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('BlankLineBeforeEndFunction', $this->_blankLineBeforeEndFunction);

        $this->assertErrorMessages('Blank line at end of function');
    }
}
