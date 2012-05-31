<?php

require_once 'PHP/CodeSniffer.php';

class DWS_Sniffs_Scope_VarScopeSniff_Test extends PHPUnit_Framework_TestCase
{
    private $_phpcs;

    private $_globalInlineIfScope;

    private $_globalInlineIfScopePredeclared;

    private $_globalStructuredIfScope;

    private $_globalStructuredIfScopePredeclared;

    private $_memberFunctionIfScope;

    private $_memberFunctionIfScopePredeclared;

    private $_memberVariableScope;

    private $_memberVariableScopePredeclared;

    private $_memberFunctionParameterScope;

    private $_memberFunctionParameterScopePredeclared;

    public function setUp()
    {
        $this->_phpcs = new PHP_CodeSniffer();
        $this->_globalInlineIfScope = <<< 'GIS'
<?php
if ($value === true)
    $valueTwo = 3;

echo $valueTwo;
GIS;
        $this->_globalInlineIfScopePredeclared = <<< 'GISP'
<?php
$valueTwo = 1;
if ($value === true)
    $valueTwo = 3;

echo $valueTwo;
GISP;
        $this->_globalStructuredIfScope = <<< 'GSS'
<?php
if ($value === true) {
    $valueTwo = 3;
}

echo $valueTwo;
GSS;
        $this->_globalStructuredIfScopePredeclared = <<< 'GSSP'
<?php
$valueTwo = 1;
if ($value === true) {
    $valueTwo = 3;
}

echo $valueTwo;
GSSP;
        $this->_memberFunctionIfScope = <<< 'MFS'
<?php
class penguin {
    private function _move() {
        if ($isCold === false)
            $valueTwo = "swim";

        echo $valueTwo;
    }
}
MFS;
        $this->_memberFunctionIfScopePredeclared = <<< 'MFSP'
<?php
class penguin {
    private function _move() {
        $valueTwo;
        $isCold;
        if ($isCold === false)
            $valueTwo = "swim";

        echo $valueTwo;
    }
}
MFSP;
        $this->_memberVariableScope = <<< 'MVS'
<?php
class penguin {
    private $valueTwo;

    private function _move() {
        if ($isCold === false) {
            $this->valueTwo = "swim";
            $valueThree = 42;
        }

        echo $this->valueTwo;
    }

    private function _move2() {
        if ($isCold === false)
            $this->valueTwo = "swim";

        $valueThree = 48;

        echo $this->valueTwo;
    }
}
MVS;
        $this->_memberVariableScopePredeclared = <<< 'MVSP'
<?php
class penguin {
    private $valueTwo;

    private function _move() {
        $isCold;
        $valueThree;
        if ($isCold === false) {
            $this->valueTwo = "swim";
            $valueThree = 42;
        }

        echo $this->valueTwo;
    }

    private function _move2() {
        $isCold;
        if ($isCold === false)
            $this->valueTwo = "swim";

        $valueThree = 48;

        echo $this->valueTwo;
    }
}
MVSP;
        $this->_memberFunctionParameterScope = <<< 'MVPS'
<?php
class penguin {
    private function _move($valueTwo) {
        if ($isCold === false)
            $valueTwo = "swim";

        echo $valueTwo;
    }
}
MVPS;
        $this->_memberFunctionParameterScopePredeclared = <<< 'MVPSP'
<?php
class penguin {
    private function _move($valueTwo) {
        $isCold;
        if ($isCold === false)
            $valueTwo = "swim";

        echo $valueTwo;
    }
}
MVPSP;
        $this->_subFunctionScope = <<< 'SFS'
<?php
function foo() {
    if ($value === true) {
        if ($valueThree < 7)
            $do = 'something';
        $valueTwo = 3;
    }
}
SFS;
        $this->_subFunctionScopePredeclared = <<< 'SFSP'
<?php
function foo() {
    $value;
    $valueTwo;
    $valueThree;
    $do;
    if ($value === true) {
        if ($valueThree < 7)
            $do = 'something';
        $valueTwo = 3;
    }
}
SFSP;
    }

    public function testGlobalInlineIfScope()
    {
        $this->_phpcs->process(
            array(),
            'DWS', //Standard
            array('DWS_Sniffs_Scope_VarScopeSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('GlobalInlineIfScope', $this->_globalInlineIfScope);

        $this->assertErrorMessages('Variable "$valueTwo" is in the wrong scope.');
    }

    public function testGlobalInlineIfScopePredeclared()
    {
        $this->_phpcs->process(
            array(),
            'DWS', //Standard
            array('DWS_Sniffs_Scope_VarScopeSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('GlobalInlineIfScopePredeclared', $this->_globalInlineIfScopePredeclared);

        $this->assertNoErrors('GlobalInlineIfScopePredeclared');
    }

    public function testGlobalStructuredIfScope()
    {
        $this->_phpcs->process(
            array(),
            'DWS', //Standard
            array('DWS_Sniffs_Scope_VarScopeSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('GlobalStructuredIfScope', $this->_globalStructuredIfScope);

        $this->assertErrorMessages('Variable "$valueTwo" is in the wrong scope.');
    }

    public function testGlobalStructuredIfScopePredeclared()
    {
        $this->_phpcs->process(
            array(),
            'DWS', //Standard
            array('DWS_Sniffs_Scope_VarScopeSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('GlobalStructuredIfScopePredeclared', $this->_globalStructuredIfScopePredeclared);

        $this->assertNoErrors('GlobalStructuredIfScopePredeclared');
    }

    public function testMemberFunctionIfScope()
    {
        $this->_phpcs->process(
            array(),
            'DWS', //Standard
            array('DWS_Sniffs_Scope_VarScopeSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('MemberFunctionIfScope', $this->_memberFunctionIfScope);

        $this->assertErrorMessages('Variable "$valueTwo" is in the wrong scope.');
    }

    public function testMemberFunctionIfScopePredeclared()
    {
        $this->_phpcs->process(
            array(),
            'DWS', //Standard
            array('DWS_Sniffs_Scope_VarScopeSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('MemberFunctionIfScopePredeclared', $this->_memberFunctionIfScopePredeclared);

        $this->assertNoErrors('MemberFunctionIfScopePredeclared');
    }

    public function testMemberVariableScope()
    {
        $this->_phpcs->process(
            array(),
            'DWS', //Standard
            array('DWS_Sniffs_Scope_VarScopeSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('MemberVariableScope', $this->_memberVariableScope);

        $this->assertErrorMessages(
            array(
                'Variable "$valueThree" is in the wrong scope.',
                'Variable "$isCold" is in the wrong scope.'
            )
        );
    }

    public function testMemberVariableScopePredeclared()
    {
        $this->_phpcs->process(
            array(),
            'DWS', //Standard
            array('DWS_Sniffs_Scope_VarScopeSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('MemberVariableScopePredeclared', $this->_memberVariableScopePredeclared);

        $this->assertNoErrors('MemberVariableScopePredeclared');
    }

    public function testMemberFunctionParameterScope()
    {
        $this->_phpcs->process(
            array(),
            'DWS', //Standard
            array('DWS_Sniffs_Scope_VarScopeSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('MemberFunctionParameterScope', $this->_memberFunctionParameterScope);

        $errors = $this->_phpcs->getFilesErrors();
        $errorsText = print_r($this->_phpcs->getFilesErrors(), true);

        $this->assertErrorMessages('Variable "$isCold" is in the wrong scope.');
    }

    public function testMemberFunctionParameterScopePredeclared()
    {
        $this->_phpcs->process(
            array(),
            'DWS', //Standard
            array('DWS_Sniffs_Scope_VarScopeSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('MemberFunctionParameterScopePredeclared', $this->_memberFunctionParameterScopePredeclared);

        $this->assertNoErrors('MemberFunctionParameterScopePredeclared');
    }

    public function testSubFunctionScope()
    {
        $this->_phpcs->process(
            array(),
            'DWS', //Standard
            array('DWS_Sniffs_Scope_VarScopeSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('SubFunctionScope', $this->_subFunctionScope);

        $this->assertErrorMessages(
            array(
                'Variable "$value" is in the wrong scope.',
                'Variable "$valueTwo" is in the wrong scope.',
                'Variable "$valueThree" is in the wrong scope.',
                'Variable "$do" is in the wrong scope.'
            )
        );
    }

    public function testSubFunctionScopePredeclared()
    {
        $this->_phpcs->process(
            array(),
            'DWS', //Standard
            array('DWS_Sniffs_Scope_VarScopeSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('SubFunctionScopePredeclared', $this->_subFunctionScopePredeclared);

        $this->assertNoErrors('SubFunctionScopePredeclared');
    }

    public function testMultipleFiles()
    {
        $this->_phpcs->process(
            array(),
            'DWS', //Standard
            array('DWS_Sniffs_Scope_VarScopeSniff'), //Sniff
            null
        );

        $brokenFiles = array(
            'MemberFunctionIfScope' => $this->_memberFunctionIfScope,
            'GlobalInlineIfScope' => $this->_globalInlineIfScope,
            'GlobalStructuredIfScope' => $this->_globalStructuredIfScope,
            'MemberVariableScope' => $this->_memberVariableScope,
            'MemberFunctionParameterScope' => $this->_memberFunctionParameterScope,
            'SubFunctionScope' => $this->_subFunctionScope,
        );

        $validFiles = array(
            'MemberFunctionIfScopePredeclared' => $this->_memberFunctionIfScopePredeclared,
            'GlobalInlineIfScopePredeclared' => $this->_globalInlineIfScopePredeclared,
            'GlobalStructuredIfScopePredeclared' => $this->_globalStructuredIfScopePredeclared,
            'MemberVariableScopePredeclared' => $this->_memberVariableScopePredeclared,
            'MemberFunctionParameterScopePredeclared' => $this->_memberFunctionParameterScopePredeclared,
            'SubFunctionScopePredeclared' => $this->_subFunctionScopePredeclared,
        );

        $fileName;
        $fileContents;
        foreach ($brokenFiles as $fileName => $fileContents)
            $this->_phpcs->processFile($fileName, $fileContents);

        foreach ($validFiles as $fileName => $fileContents)
            $this->_phpcs->processFile($fileName, $fileContents);

        $errors = $this->_phpcs->getFilesErrors();
        $errorsText = print_r($this->_phpcs->getFilesErrors(), true);

        foreach ($validFiles as $fileName => $fileContents) {
            $this->assertNoErrors($fileName);
        }
    }

    private function assertErrorMessages($expectedErrorMessages)
    {
        if (is_string($expectedErrorMessages))
            $expectedErrorMessages = array($expectedErrorMessages);

        $errors = print_r($this->_phpcs->getFilesErrors(), true);

        $expectedMessage;
        $messageFound;
        foreach ($expectedErrorMessages as $expectedMessage) {
            $messageFound = strstr($errors, $expectedMessage);
            $this->assertTrue($messageFound !== false, "PHPCS errors didn't contain $expectedMessage the errors were: $errors");
        }
    }

    private function assertNoErrors($fileName)
    {
        $errors = $this->_phpcs->getFilesErrors();
        $errorsText = print_r($errors, true);

        $this->assertSame(
            0,
            $errors[$fileName]['numWarnings'], "PHPCS warnings wasn't empty in file $fileName.  The errors were: $errorsText"
        );
        $this->assertSame(
            0,
            $errors[$fileName]['numErrors'], "PHPCS errors wasn't empty in file $fileName.  The errors were: $errorsText"
        );
    }
}
