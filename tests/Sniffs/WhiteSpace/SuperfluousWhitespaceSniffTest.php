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

    public function setUp()
    {
        parent::setUp(array('DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniff'));
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

    public function testSpaceInBeginning()
    {
        $this->_phpcs->processFile('SpaceInBeginning', $this->_spaceInBeginning);

        $this->assertErrorMessages('Additional whitespace found at start of file');
    }

    public function testTwoBlankLinesBeforeFunction()
    {
        $this->_phpcs->processFile('TwoBlankLinesBeforeFunction', $this->_twoBlankLinesBeforeFunction);

        $this->assertErrorMessages('Multiple empty lines in a row; found 2 empty lines');
    }

    public function testTwoBlankLinesInFunction()
    {
        $this->_phpcs->processFile('TwoBlankLinesInFunction', $this->_twoBlankLinesInFunction);

        $this->assertErrorMessages('Multiple empty lines in a row; found 2 empty lines');
    }

    public function testTwoBlankLinesAfterFunction()
    {
        $this->_phpcs->processFile('TwoBlankLinesAfterFunction', $this->_twoBlankLinesAfterFunction);

        $this->assertErrorMessages('Empty lines at end of file');
    }

    public function testBlankLineAfterClass()
    {
        $this->_phpcs->processFile('BlankLineAfterClass', $this->_blankLineAfterClass);

        $this->assertErrorMessages('Blank line at beginning of class');
    }

    public function testBlankLineBeforeEndClass()
    {
        $this->_phpcs->processFile('BlankLineBeforeEndClass', $this->_blankLineBeforeEndClass);

        $this->assertErrorMessages('Blank line at end of class');
    }

    public function testBlankLineAfterIf()
    {
        $this->_phpcs->processFile('BlankLineAfterIf', $this->_blankLineAfterIf);

        $this->assertErrorMessages('Blank line at beginning of if');
    }

    public function testBlankLineBeforeEndIf()
    {
        $this->_phpcs->processFile('BlankLineBeforeEndIf', $this->_blankLineBeforeEndIf);

        $this->assertErrorMessages('Blank line at end of if');
    }

    public function testBlankLineAfterFunction()
    {
        $this->_phpcs->processFile('BlankLineAfterFunction', $this->_blankLineAfterFunction);

        $this->assertErrorMessages('Blank line at beginning of function');
    }

    public function testBlankLineBeforeEndFunction()
    {
        $this->_phpcs->processFile('BlankLineBeforeEndFunction', $this->_blankLineBeforeEndFunction);

        $this->assertErrorMessages('Blank line at end of function');
    }
}
