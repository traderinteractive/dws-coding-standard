<?php
require_once 'PHP/CodeSniffer.php';
require_once __DIR__ . '/../../SniffTestCase.php';

class DWS_Sniffs_Strings_EmbeddedVariablesSniff_Test extends SniffTestCase
{
    private $_undelimitedPlainVariable;

    private $_undelimitedArrayAccess;

    private $_undelimitedObjectAccess;

    private $_undelimitedMultilineString;

    private $_delimitedPlainVariable;

    private $_delimitedArrayAccess;

    private $_delimitedObjectAccess;

    private $_delimitedMultilineString;

    public function setUp()
    {
        parent::setUp(array('DWS_Sniffs_Strings_EmbeddedVariablesSniff'));

        $this->_undelimitedPlainVariable = <<< 'NOWDOC'
<?php
$world = 'World';
$foo = "Hello, $world";
NOWDOC;

        $this->_undelimitedArrayAccess = <<< 'NOWDOC'
<?php
$world = array('place' => 'World');
$foo = "Hello, $world[place]";
NOWDOC;

        $this->_undelimitedObjectAccess = <<< 'NOWDOC'
<?php
class Foo
{
    public $place = 'World';
}
$world = new Foo();
$foo = "Hello, $world->place";
NOWDOC;

        $this->_undelimitedMultilineString = <<< 'NOWDOC'
<?php
$world = 'World';
$foo = "Hello,
$world";
NOWDOC;

        $this->_delimitedPlainVariable = <<< 'NOWDOC'
<?php
$world = 'World';
$foo = "Hello, {$world}";
NOWDOC;

        $this->_delimitedArrayAccess = <<< 'NOWDOC'
<?php
$world = array('place' => 'World');
$foo = "Hello, {$world[place]}";
NOWDOC;

        $this->_delimitedObjectAccess = <<< 'NOWDOC'
<?php
class Foo
{
    public $place = 'World';
}
$world = new Foo();
$foo = "Hello, {$world->place}";
NOWDOC;

        $this->_delimitedMultilineString = <<< 'NOWDOC'
<?php
$world = 'World';
$foo = "Hello,
{$world}";
NOWDOC;
    }

    public function testUndelimitedPlainVariable()
    {
        $this->_phpcs->processFile('UndelimitedPlainVariable', $this->_undelimitedPlainVariable);

        $this->assertErrorMessages('String "Hello, $world" has a variable embedded without being delimited by braces');
    }

    public function testUndelimitedArrayAccess()
    {
        $this->_phpcs->processFile('UndelimitedArrayAccess', $this->_undelimitedArrayAccess);

        $this->assertErrorMessages('String "Hello, $world[place]" has a variable embedded without being delimited by braces');
    }

    public function testUndelimitedObjectAccess()
    {
        $this->_phpcs->processFile('UndelimitedObjectAccess', $this->_undelimitedObjectAccess);

        $this->assertErrorMessages('String "Hello, $world->place" has a variable embedded without being delimited by braces');
    }

    public function testUndelimitedMultilineString()
    {
        $this->_phpcs->processFile('UndelimitedMultilineString', $this->_undelimitedMultilineString);

        $this->assertErrorMessages("String \"Hello,\n\$world\" has a variable embedded without being delimited by braces");
    }

    public function testDelimitedPlainVariable()
    {
        $this->_phpcs->processFile('delimitedPlainVariable', $this->_delimitedPlainVariable);

        $this->assertNoErrors('delimitedPlainVariable');
    }

    public function testDelimitedArrayAccess()
    {
        $this->_phpcs->processFile('delimitedArrayAccess', $this->_delimitedArrayAccess);

        $this->assertNoErrors('delimitedArrayAccess');
    }

    public function testDelimitedObjectAccess()
    {
        $this->_phpcs->processFile('delimitedObjectAccess', $this->_delimitedObjectAccess);

        $this->assertNoErrors('delimitedObjectAccess');
    }

    public function testDelimitedMultilineString()
    {
        $this->_phpcs->processFile('delimitedMultilineString', $this->_delimitedMultilineString);

        $this->assertNoErrors('delimitedMultilineString');
    }
}
