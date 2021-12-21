# DWS Coding Standard

These are the coding "sniffs" enforced by this standard.

## Table Of Contents
* [Arrays](#arrays)
    * [Array Declarations](#array-declarations)
    * [Arrow Spacing](#arrow-spacing)
    * [Bracket Spacing](#bracket-spacing)
    * [Comma Spacing](#comma-spacing)
    * [Multiline Array Indentation](#multiline-array-indentation)
    * [Trailing Commas](#trailing-commas)
* [Classes](#classes)
    * [Lowercase Keywords](#lowercase-keywords)
    * [Self Member Reference](#self-member-reference)
* [Code Analysis](#code-analysis)
    * [Empty Statements](#empty-statements)
    * [Condition-Only For Loops](#condition-only-for-loops)
    * [Unconditional If Statements](#unconditional-if-statements)
    * [Unnecessary Final Modifiers](#unnecessary-final-modifiers)
    * [Useless Overriding Methods](#useless-overriding-methods)
* [Commenting](#commenting)
    * [Doc Comment Formatting](#doc-comment-formatting)
    * [Doc Comment Alignment](#doc-comment-alignment)
    * [Doc Comment Throws Tag](#doc-comment-throws-tag)
    * [Inline Comments](#inline-comments)
    * [Todos](#todos)
* [Control Structures](#control-structures)
    * [Control Signatures](#control-signatures)
    * [Foreach Loop Declarations](#foreach-loop-declarations)
    * [For Loop Declarations](#for-loop-declarations)
    * [Lowercase Declarations](#lowercase-declarations)
    * [One Line Control Structures](#one-line-control-structures)
* [Files](#files)
    * [Closing Tags](#closing-tags)
    * [Including Files](#including-files)
    * [Line Length](#line-length)
    * [Line Endings](#line-endings)
* [Formatting](#formatting)
    * [Multiple Statements](#multiple-statements)
    * [Space After Casts](#space-after-casts)
* [Functions](#functions)
    * [Call-Time Pass-By-Reference](#call-time-pass-by-reference)
    * [Argument Spacing](#argument-spacing)
    * [Function Signatures](#function-signatures)
    * [Duplicate Arguments](#duplicate-arguments)
    * [Lowercase Keywords](#lowercase-keywords-1)
    * [Opening Braces](#opening-braces)
    * [Valid Default Values](#valid-default-values)
* [Metrics](#metrics)
    * [Nesting Level](#nesting-level)
* [Naming Conventions](#naming-conventions)
    * [Constructors](#constructors)
    * [Uppercase Constants](#uppercase-constants)
    * [Valid Class Names](#valid-class-names)
    * [Valid Variable Names](#valid-variable-names)
* [PHP](#php)
    * [Deprecated Functions](#deprecated-functions)
    * [Short Open Tag](#short-open-tag)
    * [Forbidden Functions](#forbidden-functions)
    * [Lowercase Constants](#lowercase-constants)
    * [Lowercase Functions](#lowercase-functions)
    * [Silenced Errors](#silenced-errors)
* [Scope](#scope)
    * [Static This](#static-this)
    * [Consistent Variable Scoping](#consistent-variable-scoping)
* [Strings](#strings)
    * [Echos](#echos)
    * [Embedded Variables](#embedded-variables)
    * [Unnecessary Concatenation](#unnecessary-concatenation)
    * [Double Quote Usage](#double-quote-usage)
* [Whitespace](#whitespace)
    * [Casts](#casts)
    * [Control Structures](#control-structures-1)
    * [Indentation](#indentation)
    * [Opening and Closing Braces](#opening-and-closing-braces)
    * [Language Constructs](#language-constructs)
    * [Logical Operators](#logical-operators)
    * [Object Operators](#object-operators)
    * [Operators](#operators)
    * [Closing Braces](#closing-braces)
    * [Scope Indentation](#scope-indentation)
    * [Scope Keywords](#scope-keywords)
    * [Semicolons](#semicolons)
    * [Superfluous Whitespace](#superfluous-whitespace)

## Arrays

### Array Declarations
Array declarations should not have a space between the array keyword and the opening parenthesis.  Empty arrays should not have spaces between brackets/parentheses.

Valid:
```php
<?php
$foo = array();
```

Invalid:
```php
<?php
$foo = array ( );
```

### Arrow Spacing
Double arrows in arrays should be surrounded by 1 space on each side.

Valid:
```php
<?php
$foo = array('x' => 'y');
```

Invalid:
```php
<?php
$foo = array('x'=>  'y');
```

### Bracket Spacing
When referencing arrays you should not use spaces before or after the opening bracket or before the closing bracket.

Valid:
```php
<?php
$var = $foo['bar'];
```

Invalid:
```php
<?php
$var = $foo [ 'bar' ];
```

### Comma Spacing
Commas in arrays should be spaced correctly with no whitespace before the comma.  Single-line arrays should have exactly 1 space after the comma and multi-line arrays should have nothing but an optional comment on the line after the comma.

Valid:
```php
<?php
$foo = array(1, 2);
```

Invalid:
```php
<?php
$foo = array(1 ,2);
```

### Multiline Array Indentation
Multi-line arrays should have each line inside the array indented 4 spaces.

Valid:
```php
<?php
$foo = array(
    1,
    2,
);
```

Invalid:
```php
<?php
$foo = array(
  1,
        2,
    );
```

### Trailing Commas
Single-line arrays should not have trailing commas and multi-line arrays should.

Valid:
```php
<?php
$foo = array(1, 2);
$foo = array(
    1,
    2,
);
```

Invalid:
```php
<?php
$foo = array(1, 2,);
$foo = array(
    1,
    2
);
```

## Classes

### Lowercase Keywords
The php keywords `class`, `interface`, `extends`, `implements`, `abstract`, `final`, `var`, and `const` should be lowercase.

Valid:
```php
<?php
class Foo
{
}
```

Invalid:
```php
<?php
Class Foo
{
}
```

### Self Member Reference
The `self` keyword should be used instead of the current class name, should be lowercase, and should not have spaces before or after it.

Valid:
```php
<?php
self::foo();
```

Invalid:
```php
<?php
Self :: foo();
```

## Code Analysis

### Empty Statements
Control Structures with empty bodies are not allowed.

Valid:
```php
<?php
if ($test) {
    $var = 1;
}
```

Invalid:
```php
<?php
if ($test) {
    // do nothing
}
```

### Condition-Only For Loops
For loops that only have a second expression are not allowed as they should be converted to while loops.

Valid:
```php
<?php
while ($test) {
    echo "Hello\n";
}
```

Invalid:
```php
<?php
for (;$test;) {
    echo "Hello\n";
}
```

### Unconditional If Statements
If statements that always evaluate to true or false should not be used.

Valid:
```php
<?php
if ($test) {
    $var = 1;
}
```

Invalid:
```php
<?php
if (true) {
    $var = 1;
}
```

### Unnecessary Final Modifiers
Methods should not be declared final inside of classes that are declared final.

Valid:
```php
<?php
final class Foo
{
    public function bar()
    {
    }
}
```

Invalid:
```php
<?php
final class Foo
{
    public final function bar()
    {
    }
}
```

### Useless Overriding Methods
Methods should not be defined that only call the parent method.

Valid:
```php
<?php
public function foo()
{
    return parent::foo() + 1;
}
```

Invalid:
```php
<?php
public function foo()
{
    return parent::foo();
}
```

## Commenting

### Doc Comment Formatting
There should be a way to describe about code and tell what our code does, we use documentation for this purpose.

Functions:
```php
/**
* Does something interesting
* 
* @param Place   $where  Where something interesting takes place
* @param integer $repeat How many times something interesting should happen
* 
* @throws Some_Exception_Class If something interesting cannot happen
* @author Byte Coder <byte@coder.com>
* @return Status
  */
  ````
  Classes:
```php
  /**
* Short description for class
* 
* Long description for class (if any)...
* 
* @copyright  2021 Zend Technologies
* @license    http://www.zend.com/license/3_0.txt   PHP License 3.0
* @version    Release: @package_version@
* @link       http://dev.zend.com/package/PackageName
* @since      Class available since Release 1.2.0
  */
````

  Sample File:
```php
<?php

/**
 * Short description for file
 *
 * Long description for file (if any)...
 *
 * PHP version 7.0
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   CategoryName
 * @package    PackageName
 * @author     Original Author <author@example.com>
 * @author     Another Author <another@example.com>
 * @copyright  1997-2005 The PHP Group
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    SVN: $Id$
 * @link       http://pear.php.net/package/PackageName
 * @see        NetOther, Net_Sample::Net_Sample()
 * @since      File available since Release 1.2.0
 * @deprecated File deprecated in Release 2.0.0
 */

/**
 * This is a "Docblock Comment," also known as a "docblock."  The class'
 * docblock, below, contains a complete description of how to write these.
 */
require_once 'PEAR.php';

// {{{ constants

/**
 * Methods return this if they succeed
 */
define('NET_SAMPLE_OK', 1);

// }}}
// {{{ GLOBALS

/**
 * The number of objects created
 * @global int $GLOBALS['_NET_SAMPLE_Count']
 */
$GLOBALS['_NET_SAMPLE_Count'] = 0;

// }}}
// {{{ Net_Sample

/**
 * An example of how to write code to PEAR's standards
 *
 * Docblock comments start with "/**" at the top.  Notice how the "/"
 * lines up with the normal indenting and the asterisks on subsequent rows
 * are in line with the first asterisk.  The last line of comment text
 * should be immediately followed on the next line by the closing asterisk
 * and slash and then the item you are commenting on should be on the next
 * line below that.  Don't add extra lines.  Please put a blank line
 * between paragraphs as well as between the end of the description and
 * the start of the @tags.  Wrap comments before 80 columns in order to
 * ease readability for a wide variety of users.
 *
 * Docblocks can only be used for programming constructs which allow them
 * (classes, properties, methods, defines, includes, globals).  See the
 * phpDocumentor documentation for more information.
 * http://phpdoc.org/tutorial_phpDocumentor.howto.pkg.html
 *
 * The Javadoc Style Guide is an excellent resource for figuring out
 * how to say what needs to be said in docblock comments.  Much of what is
 * written here is a summary of what is found there, though there are some
 * cases where what's said here overrides what is said there.
 * http://java.sun.com/j2se/javadoc/writingdoccomments/index.html#styleguide
 *
 * The first line of any docblock is the summary.  Make them one short
 * sentence, without a period at the end.  Summaries for classes, properties
 * and constants should omit the subject and simply state the object,
 * because they are describing things rather than actions or behaviors.
 *
 * Below are the tags commonly used for classes. @category through @version
 * are required.  The remainder should only be used when necessary.
 * Please use them in the order they appear here.  phpDocumentor has
 * several other tags available, feel free to use them.
 *
 * @category   CategoryName
 * @package    PackageName
 * @author     Original Author <author@example.com>
 * @author     Another Author <another@example.com>
 * @copyright  1997-2005 The PHP Group
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/PackageName
 * @see        NetOther, Net_Sample::Net_Sample()
 * @since      Class available since Release 1.2.0
 * @deprecated Class deprecated in Release 2.0.0
 */
class Net_Sample
{
    // {{{ properties

    /**
     * The status of foo's universe
     * Potential values are 'good', 'fair', 'poor' and 'unknown'.
     * @var string $foo
     */
    public $foo = 'unknown';

    /**
     * The status of life
     * Note that names of private properties or methods must be
     * preceeded by an underscore.
     * @var bool $_good
     */
    private $_good = true;

    // }}}
    // {{{ setFoo()

    /**
     * Registers the status of foo's universe
     *
     * Summaries for methods should use 3rd person declarative rather
     * than 2nd person imperative, beginning with a verb phrase.
     *
     * Summaries should add description beyond the method's name. The
     * best method names are "self-documenting", meaning they tell you
     * basically what the method does.  If the summary merely repeats
     * the method name in sentence form, it is not providing more
     * information.
     *
     * Summary Examples:
     *   + Sets the label              (preferred)
     *   + Set the label               (avoid)
     *   + This method sets the label  (avoid)
     *
     * Below are the tags commonly used for methods.  A @param tag is
     * required for each parameter the method has.  The @return
     * and @access tags are mandatory.  The @throws tag is required if
     * the method uses exceptions.  @static is required if the method can
     * be called statically.  The remainder should only be used when
     * necessary.  Please use them in the order they appear here.
     * phpDocumentor has several other tags available, feel free to use
     * them.
     *
     * The @param tag contains the data type, then the parameter's
     * name, followed by a description.  By convention, the first noun in
     * the description is the data type of the parameter.  Articles like
     * "a", "an", and  "the" can precede the noun.  The descriptions
     * should start with a phrase.  If further description is necessary,
     * follow with sentences.  Having two spaces between the name and the
     * description aids readability.
     *
     * When writing a phrase, do not capitalize and do not end with a
     * period:
     *   + the string to be tested
     *
     * When writing a phrase followed by a sentence, do not capitalize the
     * phrase, but end it with a period to distinguish it from the start
     * of the next sentence:
     *   + the string to be tested. Must use UTF-8 encoding.
     *
     * Return tags should contain the data type then a description of
     * the data returned.  The data type can be any of PHP's data types
     * (int, float, bool, string, array, object, resource, mixed)
     * and should contain the type primarily returned.  For example, if
     * a method returns an object when things work correctly but false
     * when an error happens, say 'object' rather than 'mixed.'  Use
     * 'void' if nothing is returned.
     *
     * Here's an example of how to format examples:
     * <code>
     * require_once 'Net/Sample.php';
     *
     * $s = new Net_Sample();
     * if (PEAR::isError($s)) {
     *     echo $s->getMessage() . "\n";
     * }
     * </code>
     *
     * Here is an example for non-php example or sample:
     * <samp>
     * pear install net_sample
     * </samp>
     *
     * @param string $arg1 the string to quote
     * @param int    $arg2 an integer of how many problems happened.
     *                     Indent to the description's starting point
     *                     for long ones.
     *
     * @return int the integer of the set mode used. FALSE if foo
     *             foo could not be set.
     * @throws exceptionclass [description]
     *
     * @access public
     * @static
     * @see Net_Sample::$foo, Net_Other::someMethod()
     * @since Method available since Release 1.2.0
     * @deprecated Method deprecated in Release 2.0.0
     */
    function setFoo($arg1, $arg2 = 0)
    {
        /*
         * This is a "Block Comment."  The format is the same as
         * Docblock Comments except there is only one asterisk at the
         * top.  phpDocumentor doesn't parse these.
         */
        if ($arg1 == 'good' || $arg1 == 'fair') {
            $this->foo = $arg1;
            return 1;
        } elseif ($arg1 == 'poor' && $arg2 > 1) {
            $this->foo = 'poor';
            return 2;
        } else {
            return false;
        }
    }

    // }}}
}

// }}}

/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * c-hanging-comment-ender-p: nil
 * End:
 */

?>
````
Source: [PEAR Docblock Comment standards](http://pear.php.net/manual/en/standards.sample.php)

### Doc Comment Alignment
The asterisks in a phpdoc comment should align.

Valid:
```php
<?php
/**
 * Foobar.
 *
 * @return array baz
 */
function foo()
{
    return array();
}
```

Invalid:
```php
<?php
/**
  * Foobar.
  *
  * @return array baz
 */
function foo()
{
    return array();
}
```

### Doc Comment Throws Tag
If a function throws any exceptions, it should be documented in a `@throws` tag.

Valid:
```php
<?php
/**
 * @throws Exception all the time
 */
function foo()
{
    throw new Exception('Danger!');
}
```

Invalid:
```php
<?php
/**
 * @return void
 */
function foo()
{
    throw new Exception('Danger!');
}
```

### Inline Comments
Perl style `#` comments are not allowed.

Valid:
```php
<?php
// A comment.
```

Invalid:
```php
<?php
# A comment.
```

### Todos
Todos should be resolved.

Invalid:
```php
<?php
// TODO: Fix this!
```

## Control Structures

### Control Signatures
Control structures should use a space before the opening parenthesis and brace and the opening brace should be on the same line.

Valid:
```php
<?php
if ($test) {
    $var = 1;
    echo "Hello\n";
}
```

Invalid:
```php
<?php
if($test)
{
    $var = 1;
    echo "Hello\n";
}
```

### Foreach Loop Declarations
There should be a space between each element of a foreach loop.

Valid:
```php
<?php
foreach ($ar['nested'] as $key => $value) {
    echo "{$key}: {$value}\n";
}
```

Invalid:
```php
<?php
foreach ( $ar['nested']as$key=>$value ) {
    echo "{$key}: {$value}\n";
}
```

### For Loop Declarations
There should be a space between each condition of a for loop.

Valid:
```php
<?php
for ($i = 0; $i < 5; $i++) {
    echo "Hello\n";
}
```

Invalid:
```php
<?php
for ( $i = 0 ;$i < 5 ;$i++ ) {
    echo "Hello\n";
}
```

### Lowercase Declarations
The php keywords `if`, `else`, `elseif`, `foreach`, `for`, `do`, `switch`, `while`, `try` and `catch` should be lowercase.

Valid:
```php
<?php
if ($test) {
    $var = 1;
}
```

Invalid:
```php
<?php
If ($test) {
    $var = 1;
}
```

### One Line Control Structures
One Line Control structures should use braces.

Valid:
```php
<?php
if ($value === true) {
    echo 3;
}
```

Invalid:
```php
<?php
if ($value === true)
    echo 3;
```

## Files

### Closing Tags
Files should not have closing php tags.

Valid:
```php
<?php
$var = 1;
```

Invalid:
```php
<?php
$var = 1;
?>
```

### Including Files
The `include` and `require` statements should not have parentheses.

Valid:
```php
<?php
require_once 'foo.php';
```

Invalid:
```php
<?php
require_once('foo.php');
```

### Line Length
Lines should be no longer than 144 characters.

Valid:
```php
<?php
$foobarbazfoobarbazfoobarbaz =
    $arr['foobarbazfoobarbaz']['foobarbazfoobarbaz']['foobarbazfoobarbaz']['foobarbazfoobarbaz']['foobarbazfoobarbaz']['foobarbazfoobarbaz'];
```

Invalid:
```php
<?php
$foobarbazfoobarbazfoobarbaz = $arr['foobarbazfoobarbaz']['foobarbazfoobarbaz']['foobarbazfoobarbaz']['foobarbazfoobarbaz']['foobarbazfoobarbaz']['foobarbazfoobarbaz'];
```

### Line Endings
Lines should end with `"\n"` not `"\r\n"`.

## Formatting

### Multiple Statements
Multiple statements are not allowed on a single line.

Valid:
```php
<?php
$foo = 1;
$bar = 2;
```

Invalid:
```php
<?php
$foo = 1; $bar = 2;
```

### Space After Casts
Spaces are not allowed after casting operators.

Valid:
```php
<?php
$foo = (string)1;
```

Invalid:
```php
<?php
$foo = (string) 1;
```

## Functions

### Call-Time Pass-By-Reference
Call-time pass-by-reference is not allowed.  It should be declared in the function definition.

Valid:
```php
<?php
function foo(&$bar)
{
    $bar++;
}

$baz = 1;
foo($baz);
```

Invalid:
```php
<?php
function foo($bar)
{
    $bar++;
}

$baz = 1;
foo(&$baz);
```

### Argument Spacing
Function arguments should have one space after a comma, and single spaces surrounding the equals sign for default values.

Valid:
```php
<?php
function foo($a, $b = null)
{
}
```

Invalid:
```php
<?php
function foo($a ,$b=  null)
{
}
```

### Function Signatures
Function calls should not have spaces before the opening or closing parenthesis.  The opening parenthesis in a multi-line function call should be the last thing on its line, and the closing parenthesis should be the first non-whitespace character on its line.  Multi-line function calls should be indented one level.

Valid:
```php
<?php
$var = foo(
    $bar,
    $baz
);
```

Invalid:
```php
<?php
$var = foo ($bar,
            $baz
           );
```

### Duplicate Arguments
Duplicate arguments are not allowed to be declared for functions.

Valid:
```php
<?php
function foo($bar, $baz)
{
}
```

Invalid:
```php
<?php
function foo($bar, $bar)
{
}
```

### Lowercase Keywords
The php keywords `function`, `public`, `private`, `protected`, and `static` should be lowercase.

Valid:
```php
<?php
function foo()
{
}
```

Invalid:
```php
<?php
Function foo()
{
}
```

### Opening Braces
The opening brace of a function definition should be on the line following the declaration.

Valid:
```php
<?php
function foo()
{
}
```

Invalid:
```php
<?php
function foo() {
}
```

### Valid Default Values
Parameters with default values should be last in the function declaration.

Valid:
```php
<?php
function foo($bar, $baz = null)
{
}
```

Invalid:
```php
<?php
function foo($baz = null, $bar)
{
}
```

## Metrics

### Nesting Level
Nesting levels inside functions should not exceed 5.

Invalid:
```php
<?php
function foo($bar, $baz)
{
    if ($bar) {
        if ($baz) {
            if ($bar != $baz) {
                if ($bar < $baz) {
                    if ($bar > 0) {
                        if ($bar % 2) {
                            echo "Hello";
                        }
                    }
                }
            }
        }
    }
}
```

## Naming Conventions

### Constructors
A constructor should be named `__construct`.

Valid:
```php
<?php
class Foo
{
    public function __construct()
    {
    }
}
```

Invalid:
```php
<?php
class Foo
{
    public function Foo()
    {
    }
}
```

### Uppercase Constants
Any defined constants should be uppercase.

Valid:
```php
<?php
define('MY_CONST', 1);
```

Invalid:
```php
<?php
define('My_Const', 1);
```

### Valid Class Names
Classes should begin with capital letters.

Valid:
```php
<?php
class Foo
{
}
```

Invalid:
```php
<?php
class foo
{
}
```
Classes under Helper or Plugin directory should be prepended Helper/Plugin with class names:

Valid:
```php
<?php
// Helper/Foo.php
class Helper_Foo
{

```
```php
<?php
// Plugin/Foo.php
class Plugin_Foo
{
}
```

### Valid Variable Names
Variables should be camelCased with the first letter lowercase.  Private and protected member variables should begin with an underscore.

Valid:
```php
<?php
$fooBar = 1;
```

Invalid:
```php
<?php
$Foobar = 1;
```

## PHP

### Deprecated Functions
Deprecated functions should not be used.

Invalid:
```php
<?php
$foo = split('a', $bar);
```

### Short Open Tag
The short open tag is not allowed.

Valid:
```php
<?php
$var = 1;
```

Invalid:
```php
<?
$var = 1;
```

### Forbidden Functions
The functions `sizeof` and `delete` should not be used.

Valid:
```php
<?php
$foo = count($bar);
```

Invalid:
```php
<?php
$foo = sizeof($bar);
```

### Lowercase Constants
The php constants `true`, `false`, and `null` should be used lowercase.

Valid:
```php
<?php
$foo = true;
```

Invalid:
```php
<?php
$foo = TRUE;
```

### Lowercase Functions
All php builtin functions should be called lowercase.

Valid:
```php
<?php
if (isset($foo)) {
    echo "Hello\n";
}
```

Invalid:
```php
<?php
if (IsSet($foo)) {
    echo "Hello\n";
}
```

### Silenced Errors
Suppressing errors is not allowed.

Valid:
```php
<?php
if (isset($foo) && $foo) {
    echo "Hello\n";
}
```

Invalid:
```php
<?php
if (@$foo) {
    echo "Hello\n";
}
```

## Scope

### Static This
Static methods should not use `$this`.

Valid:
```php
<?php
class Foo
{
    static function bar()
    {
        return self::$staticMember;
    }
}
```

Invalid:
```php
<?php
class Foo
{
    static function bar()
    {
        return $this->staticMember;
    }
}
```

### Consistent Variable Scoping
A variable must be declared first in the highest scope that it will be used.

Valid:
```php
<?php
$value = null;
if ($i < 3) {
    $value = 3;
}
echo $value;
```

Invalid:
```php
<?php
if ($i < 3) {
    $value = 3;
}
echo $value;
```

## Strings

### Echos
Simple strings should not be enclosed in parentheses when being echoed.

Valid:
```php
<?php
echo "Hello\n";
```

Invalid:
```php
<?php
echo("Hello\n");
```

### Embedded Variables
Embedded variables in strings should be delimited by braces.

Valid:
```php
<?php
$world = 'World';
echo "Hello, {$world}\n";
```

Invalid:
```php
<?php
echo("Hello, $world\n");
```

### Unnecessary Concatenation
Strings should not be concatenated to other plain strings.

Valid:
```php
<?php
$foo = "Hello, World\n";
```

Invalid:
```php
<?php
$foo = 'Hello,' . ' ' . "World\n";
```

### Double Quote Usage
Use of double quotes should be warranted.

Valid:
```php
<?php
$world = 'World';
$foo = "Hello, {$world}";
```

Invalid:
```php
<?php
$foo = "Hello, World";
```

## Whitespace

### Casts
Casts should not have whitespace.

Valid:
```php
<?php
$foo = (string)1;
```

Invalid:
```php
<?php
$foo = ( string )1;
```

### Control Structures
Control structures should not have spaces just inside the parentheses or blank lines inside the block.

Valid:
```php
<?php
if ($test) {
    $foo = 1;
    $bar = 2;
}
```

Invalid:
```php
<?php
if ( $test ) {

    $foo = 1;
    $bar = 2;

}
```

### Indentation
4 spaces should be used for indentation, not tabs.

### Opening and Closing Braces
There should be no empty line after the opening brace or before the closing brace of a function, class, or control structure.

Valid:
```php
<?php
function foo()
{
    echo "Hello\n";
}
```

Invalid:
```php
<?php
function foo()
{

    echo "Hello\n";
}
```

Invalid:
```php
<?php
class Foo()
{
    public function bar()
    {
        echo 3;
    }

}
```

### Language Constructs
The php constructs `echo`, `print`, `return`, `include`, `include_once`, `require`, `require_once`, and `new` should have one space after them.

Valid:
```php
<?php
echo "Hello\n";
```

Invalid:
```php
<?php
echo"Hello\n";
```

### Logical Operators
Logical operators should have one space before and after them.

Valid:
```php
<?php
if ($foo && $bar) {
    echo "Hello\n";
}
```

Invalid:
```php
<?php
if ($foo&&$bar) {
    echo "Hello\n";
}
```

### Object Operators
The object operator should not have any space around it.

Valid:
```php
<?php
$foo->bar();
```

Invalid:
```php
<?php
$foo -> bar();
```

### Operators
Arithmetic operators should have one space before and after them.

Valid:
```php
<?php
$foo = $bar + 1;
```

Invalid:
```php
<?php
$foo = $bar+1;
```

### Closing Braces
Closing braces should be indented at the same level as the beginning of the scope.

Valid:
```php
<?php
if ($test) {
    $foo = 1;
    $bar = 2;
}
```

Invalid:
```php
<?php
if ($test) {
    $foo = 1;
    $bar = 2;
    }
```

### Scope Indentation
Blocks should be indented 4 spaces.

Valid:
```php
<?php
if ($test) {
    $foo = 1;
    $bar = 2;
}
```

Invalid:
```php
<?php
if ($test) {
        $foo = 1;
        $bar = 2;
}
```

### Scope Keywords
The php keywords `static`, `public`, `private`, and `protected` should have one space after them.

Valid:
```php
<?php
static public function foo()
{
}
```

Invalid:
```php
<?php
static  public  function foo()
{
}
```

### Semicolons
Semicolons should not have spaces before them.

Valid:
```php
<?php
$foo = 1;
```

Invalid:
```php
<?php
$foo = 1 ;
```

### Superfluous Whitespace
There should be no whitespace at the beginning or end of files or at the end of lines.  There should also never be 2 blank lines in a row.

Valid:
```php
<?php
$foo = 1;
$bar = 2;
```

Invalid:
```php

<?php
$foo = 1;


$bar = 2;

```
