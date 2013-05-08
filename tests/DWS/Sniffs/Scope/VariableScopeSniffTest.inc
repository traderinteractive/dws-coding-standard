<?php
if ($value === true)
    $valueTwo = 3;

echo $valueTwo;

$valueThree;
if ($value === true)
    $valueThree = 3;

echo $valueThree;

if ($value === true) {
    $valueFour = 3;
}

echo $valueFour;

$valueFive;
if ($value === true) {
    $valueFive = 3;
}

echo $valueFive;

class penguin
{
    private function _move()
    {
        if ($isCold === false)
            $value = 'swim';

        echo $value;
    }
}

class penguinTwo
{
    private function _move()
    {
        $value;
        if ($isCold === false) {
            $value = 'swim';
        }

        echo $value;
    }
}

class penguinThree
{
    private $value;

    private function _move()
    {
        if ($isCold === false) {
            $this->value = 42;
        }

        echo $this->value;
    }
}

class penguinFour
{
    private function _move()
    {
        if ($isCold === false) {
            $value = 42;
        }
    }

    private function _move2()
    {
        $value = 48;
    }
}

class penguinFive
{
    private function _move($value)
    {
        if ($isCold === false) {
            $value = 'swim';
        }

        echo $value;
    }
}

function foo()
{
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

function foo2()
{
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

function foo3()
{
    try {
        $do = 'something';
    } catch(Exception $e) {
        var_dump($e);
    }
}

function foo4()
{
    try {
        $do = 'something';
    } catch(Exception $e) {
        var_dump($e);
    }

    var_dump($e);
}

class StaticVariableAccess
{
    function foo()
    {
        if ($value === true) {
            self::$value2 = 42;
        }

        echo self::$value2;
    }
}

if ($value === true)
    $valueUseInQuotes = 3;

echo "{$valueUseInQuotes}";
