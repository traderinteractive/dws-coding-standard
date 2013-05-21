<?php
$world = 'World';
$foo = "Hello, $world";
$foo = "Hello, {$world}";

$world = array('place' => 'World');
$foo = "Hello, $world['place']";
$foo = "Hello, {$world['place']}";

class Foo
{
    public $place = 'World';
}

$world = new Foo();
$foo = "Hello, $world->place";
$foo = "Hello, {$world->place}";

$world = 'World';
$foo = "Hello,
$world";
$foo = "Hello,
{$world}";
