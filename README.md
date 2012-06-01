# DWS Coding Standard

## Table Of Contents
* [Arrays](#arrays)
    * [Bracket Spacing](#bracket-spacing)
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
    * [Doc Comment Alignment](#doc-comment-alignment)
    * [Doc Comment Throws Tag](#doc-comment-throws-tag)
    * [Inline Comments](#inline-comments)
    * [Todos](#todos)
* [Control Structures](#control-structures)
    * [Control Signatures](#control-signatures)
    * [Foreach Loop Declarations](#foreach-loop-declarations)
    * [For Loop Declarations](#for-loop-declarations)
    * [Lowercase Declarations](#lowercase-declarations)
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
    * [Unnecessary Concatenation](#unnecessary-concatenation)
* [Whitespace](#whitespace)
    * [Casts](#casts)
    * [Control Structures](#control-structures-1)
    * [Indentation](#indentation)
    * [Function Opening Braces](#function-opening-braces)
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
if ($test)
    $var = 1;
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
while ($test)
    echo "Hello\n";
```

Invalid:
```php
<?php
for (;$test;)
    echo "Hello\n";
```

### Unconditional If Statements
If statements that always evaluate to true or false should not be used.

Valid:
```php
<?php
if ($test)
    $var = 1;
```

Invalid:
```php
<?php
if (true)
    $var = 1;
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
    echo "$key: $value\n";
}
```

Invalid:
```php
<?php
foreach ( $ar['nested']as$key=>$value ) {
    echo "$key: $value\n";
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
if ($test)
    $var = 1;
```

Invalid:
```php
<?php
If ($test)
    $var = 1;
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
if (isset($foo))
    echo "Hello\n";
```

Invalid:
```php
<?php
if (IsSet($foo))
    echo "Hello\n";
```

### Silenced Errors
Suppressing errors is not allowed.

Valid:
```php
<?php
if (isset($foo) && $foo)
    echo "Hello\n";
```

Invalid:
```php
<?php
if (@$foo)
    echo "Hello\n";
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
if ($i < 3)
    $value = 3;
echo $value;
```

Invalid:
```php
<?php
if ($i < 3)
    $value = 3;
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

### Function Opening Braces
There should be no empty line after the opening brace of a function.

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
if ($foo && $bar)
    echo "Hello\n";
```

Invalid:
```php
<?php
if ($foo&&$bar)
    echo "Hello\n";
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
