<?php
$foo = 5;
$foo=5;
$foo  =  5;

$foo = 1 + 2;
$foo = 1+2;
$foo = 1  +  2;

if ($foo && $bar) {
}
if ($foo&&$bar) {
}

if (
    $foo &&
    $bar
) {
}
if (
    $foo&&
    $bar
) {
}

$foo = -1;
$foo = 5 - -1;
$foo = 5 +-1;
$foo = 5 +  -1;

$foo = $bar && !$baz;
$foo = $bar && ! $baz;

if (!$foo) {
}

testfunc(&$foo);
testfunc(& $foo);

$foo ? $bar : $baz;
$foo?$bar:$baz;
$foo  ?  $bar  :  $baz;

$foo . $bar;
$foo.$bar;
$foo  .  $bar;
