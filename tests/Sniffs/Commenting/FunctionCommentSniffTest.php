<?php
require_once 'PHP/CodeSniffer.php';
require_once __DIR__ . '/../../SniffTestCase.php';

class DWS_Sniffs_Commenting_FunctionCommentSniff_Test extends SniffTestCase
{
    private $_functionWithComments;

    private $_functionWithoutParameterComments;

    private $_functionWithoutComments;

    private $_functionWithSeeTag;

    private $_functionWithOnlySeeTag;

    /**
     * Setup the test fixture
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp(array('DWS_Sniffs_Commenting_FunctionCommentSniff'));
        $this->_functionWithComments = <<< 'NOWDOC'
<?php
/**
 * Echo the value
 *
 * @param string $value The value to echo
 *
 * @return void
 */
function printMe($value)
{
    echo $value;
}
NOWDOC;
        $this->_functionWithoutParameterComments = <<< 'NOWDOC'
<?php
/**
 * Echo the value
 *
 * @return void
 */
function printMe($value)
{
    echo $value;
}
NOWDOC;
        $this->_functionWithoutComments = <<< 'NOWDOC'
<?php
function printMe($value)
{
    echo $value;
}
NOWDOC;
        $this->_functionWithSeeTag = <<< 'NOWDOC'
<?php
/**
 * @param string $value The value to echo=
 *
 * @see otherFunction
 *
 * @return void
 */
function printMe($value)
{
    echo $value;
}
NOWDOC;
        $this->_functionWithOnlySeeTag = <<< 'NOWDOC'
<?php
/**
 * @see anotherFunction
 */
function printMe()
{
    echo $value;
}
NOWDOC;
    }

    /**
     * Verify that a properly commented function does not report an error
     *
     * @return void
     */
    public function testFunctionWithComments()
    {
        $this->_phpcs->processFile('FunctionWithComments', $this->_functionWithComments);

        $this->assertNoErrors('FunctionWithComments');
    }

    /**
     * Verify that a function without parameter comments reports an error
     *
     * @return void
     */
    public function testFunctionWithoutParameterComments()
    {
        $this->_phpcs->processFile('FunctionWithoutParameterComments', $this->_functionWithoutParameterComments);

        $this->assertErrorMessages('Doc comment for "$value" missing');
    }

    /**
     * Verify that a function without comments reports an error
     *
     * @return void
     */
    public function testFunctionWithoutComments()
    {
        $this->_phpcs->processFile('FunctionWithoutComments', $this->_functionWithoutComments);

        $this->assertErrorMessages('Missing function doc comment');
    }

    /**
     * Verify that a function with a see tag does not report an error even if there is no description
     *
     * @return void
     */
    public function testFunctionWithSeeTag()
    {
        $this->_phpcs->processFile('FunctionWithSeeTag', $this->_functionWithSeeTag);

        $this->assertNoErrors('FunctionWithSeeTag');
    }

    /**
     * Verify that a function with only a see tag does not report an error even if there is no description
     *
     * @return void
     */
    public function testFunctionWithOnlySeeTag()
    {
        $this->_phpcs->processFile('FunctionWithOnlySeeTag', $this->_functionWithOnlySeeTag);

        $this->assertNoErrors('FunctionWithOnlySeeTag');
    }
}
