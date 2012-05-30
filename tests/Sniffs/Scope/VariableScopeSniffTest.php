<?php
require_once 'PHP/CodeSniffer.php';
require_once __DIR__ . '/../../SniffTestCase.php';

class DWS_Sniffs_Scope_VariableScopeSniff_Test extends SniffTestCase
{
    private $_globalInlineIfScope;

    private $_globalInlineIfScopePredeclared;

    private $_globalStructuredIfScope;

    private $_globalStructuredIfScopePredeclared;

    private $_memberFunctionIfScope;

    private $_memberFunctionIfScopePredeclared;

    private $_memberVariableScope;

    private $_sameVariableNameDifferentFunctionScope;

    private $_memberFunctionParameterScope;

    private $_tryCatchScope;

    private $_tryCatchBrokenScope;

    public function setUp()
    {
        parent::setUp(array('DWS_Sniffs_Scope_VariableScopeSniff'));
        $this->_globalInlineIfScope = <<< 'NOWDOC'
<?php
if ($value === true)
    $valueTwo = 3;

echo $valueTwo;
NOWDOC;
        $this->_globalInlineIfScopePredeclared = <<< 'NOWDOC'
<?php
$valueTwo;
if ($value === true)
    $valueTwo = 3;

echo $valueTwo;
NOWDOC;
        $this->_globalStructuredIfScope = <<< 'NOWDOC'
<?php
if ($value === true) {
    $valueTwo = 3;
}

echo $valueTwo;
NOWDOC;
        $this->_globalStructuredIfScopePredeclared = <<< 'NOWDOC'
<?php
$valueTwo;
if ($value === true) {
    $valueTwo = 3;
}

echo $valueTwo;
NOWDOC;
        $this->_memberFunctionIfScope = <<< 'NOWDOC'
<?php
class penguin {
    private function _move() {
        if ($isCold === false)
            $valueTwo = "swim";

        echo $valueTwo;
    }
}
NOWDOC;
        $this->_memberFunctionIfScopePredeclared = <<< 'NOWDOC'
<?php
class penguin {
    private function _move() {
        $valueTwo;
        if ($isCold === false)
            $valueTwo = "swim";

        echo $valueTwo;
    }
}
NOWDOC;
        $this->_memberVariableScope = <<< 'NOWDOC'
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
}
NOWDOC;
        $this->_sameVariableNameDifferentFunctionScope = <<< 'NOWDOC'
<?php
class penguin {
    private function _move() {
        if ($isCold === false) {
            $valueThree = 42;
        }
    }

    private function _move2() {
        $valueThree = 48;
    }
}
NOWDOC;
        $this->_memberFunctionParameterScope = <<< 'NOWDOC'
<?php
class penguin {
    private function _move($valueTwo) {
        if ($isCold === false)
            $valueTwo = "swim";

        echo $valueTwo;
    }
}
NOWDOC;
        $this->_subFunctionScope = <<< 'NOWDOC'
<?php
function foo() {
    if ($value === true) {
        if ($valueThree < 7)
            $do = 'something';
        $valueTwo = 3;
    }
    echo $value;
    echo $valueTwo;
    echo $valueThree;
    echo $do;
}
NOWDOC;
        $this->_subFunctionScopePredeclared = <<< 'NOWDOC'
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
    echo $value;
    echo $valueTwo;
    echo $valueThree;
    echo $do;
}
NOWDOC;
        $this->_tryCatchScope = <<< 'NOWDOC'
<?php
function foo() {
    try{
        $do = 'something';
    } catch(Exception $e) {
        var_dump($e);
    }
}
NOWDOC;
        $this->_tryCatchBrokenScope = <<< 'NOWDOC'
<?php
function foo() {
    try{
        $do = 'something';
    } catch(Exception $e) {
        var_dump($e);
    }
    var_dump($e);
}
NOWDOC;
    }

    public function testGlobalInlineIfScope()
    {
        $this->_phpcs->processFile('GlobalInlineIfScope', $this->_globalInlineIfScope);

        $this->assertErrorMessages("Variable '\$valueTwo' is in the wrong scope.");
    }

    public function testGlobalInlineIfScopePredeclared()
    {
        $this->_phpcs->processFile('GlobalInlineIfScopePredeclared', $this->_globalInlineIfScopePredeclared);

        $this->assertNoErrors('GlobalInlineIfScopePredeclared');
    }

    public function testGlobalStructuredIfScope()
    {
        $this->_phpcs->processFile('GlobalStructuredIfScope', $this->_globalStructuredIfScope);

        $this->assertErrorMessages("Variable '\$valueTwo' is in the wrong scope.");
    }

    public function testGlobalStructuredIfScopePredeclared()
    {
        $this->_phpcs->processFile('GlobalStructuredIfScopePredeclared', $this->_globalStructuredIfScopePredeclared);

        $this->assertNoErrors('GlobalStructuredIfScopePredeclared');
    }

    public function testMemberFunctionIfScope()
    {
        $this->_phpcs->processFile('MemberFunctionIfScope', $this->_memberFunctionIfScope);

        $this->assertErrorMessages("Variable '\$valueTwo' is in the wrong scope.");
    }

    public function testMemberFunctionIfScopePredeclared()
    {
        $this->_phpcs->processFile('MemberFunctionIfScopePredeclared', $this->_memberFunctionIfScopePredeclared);

        $this->assertNoErrors('MemberFunctionIfScopePredeclared');
    }

    public function testMemberVariableScope()
    {
        $this->_phpcs->processFile('MemberVariableScope', $this->_memberVariableScope);

        $this->assertNoErrors('MemberVariableScope');
    }

    public function testSameVariableNameDifferentFunctionScope()
    {
        $this->_phpcs->processFile('SameVariableNameDifferentFunctionScope', $this->_sameVariableNameDifferentFunctionScope);

        $this->assertNoErrors('SameVariableNameDifferentFunctionScope');
    }

    public function testMemberFunctionParameterScope()
    {
        $this->_phpcs->processFile('MemberFunctionParameterScope', $this->_memberFunctionParameterScope);

        $this->assertNoErrors('MemberFunctionParameterScope');
    }

    public function testSubFunctionScope()
    {
        $this->_phpcs->processFile('SubFunctionScope', $this->_subFunctionScope);

        $this->assertErrorMessages(
            array(
                "Variable '\$value' is in the wrong scope.",
                "Variable '\$valueTwo' is in the wrong scope.",
                "Variable '\$valueThree' is in the wrong scope.",
                "Variable '\$do' is in the wrong scope."
            )
        );
    }

    public function testSubFunctionScopePredeclared()
    {
        $this->_phpcs->processFile('SubFunctionScopePredeclared', $this->_subFunctionScopePredeclared);

        $this->assertNoErrors('SubFunctionScopePredeclared');
    }

    public function testTryCatchScope()
    {
        $this->_phpcs->processFile('TryCatchScope', $this->_tryCatchScope);

        $this->assertNoErrors('TryCatchScope');
    }

    public function testTryCatchBrokenScope()
    {
        $this->_phpcs->processFile('TryCatchBrokenScope', $this->_tryCatchBrokenScope);

        $this->assertErrorMessages("Variable '\$e' is in the wrong scope.");
    }

    public function testMultipleFiles()
    {
        $brokenFiles = array(
            'MemberFunctionIfScope' => $this->_memberFunctionIfScope,
            'GlobalInlineIfScope' => $this->_globalInlineIfScope,
            'GlobalStructuredIfScope' => $this->_globalStructuredIfScope,
            'SubFunctionScope' => $this->_subFunctionScope,
            'TryCatchBrokenScope' => $this->_tryCatchBrokenScope,
        );

        $validFiles = array(
            'MemberFunctionIfScopePredeclared' => $this->_memberFunctionIfScopePredeclared,
            'GlobalInlineIfScopePredeclared' => $this->_globalInlineIfScopePredeclared,
            'GlobalStructuredIfScopePredeclared' => $this->_globalStructuredIfScopePredeclared,
            'MemberVariableScope' => $this->_memberVariableScope,
            'MemberFunctionParameterScope' => $this->_memberFunctionParameterScope,
            'SubFunctionScopePredeclared' => $this->_subFunctionScopePredeclared,
            'SameVariableNameDifferentFunctionScope' => $this->_sameVariableNameDifferentFunctionScope,
            'TryCatchScope' => $this->_tryCatchScope,
        );

        foreach ($brokenFiles as $fileName => $fileContents)
            $this->_phpcs->processFile($fileName, $fileContents);

        foreach ($validFiles as $fileName => $fileContents)
            $this->_phpcs->processFile($fileName, $fileContents);

        $errors = $this->_phpcs->getFilesErrors();
        $errorsText = print_r($this->_phpcs->getFilesErrors(), true);

        foreach ($validFiles as $fileName => $fileContents)
            $this->assertNoErrors($fileName);
    }
}
