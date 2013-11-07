<?php
if ($foo === 3) {
    foreach ($bar as $thing) {
        $reallyLongVariableName = 'This is an error. We shoule not ' . 'concatenate if the string is not tooi long.';
    }
}

if ($foo === 3) {
    foreach ($bar as $thing) {
        $reallyLongVariableName = 'This is an error because it is a line tha' . 't is over 144 characers.  We really should never do this!!!!!!!!!!!!!!';
    }
}

if ($foo === 3) {
    foreach ($bar as $thing) {
        $reallyLongVariableName = 'This is ok.  The string is very long such' .
        ' that if we kept it on one line it would be over 144 characters.  So there is no problem concatenating here.';
    }
}

if ($foo === 3) {
    foreach ($bar as $thing) {
        $reallyLongVariableName = 3 . 'We can still concatenate with numbers.';
    }
}

if ($foo === 3) {
    foreach ($bar as $thing) {
        $reallyLongVariableName = 'We should have no reason to add ' +
        'strings in PHP, but since this is possible in javascript, it is a good idea yo test how PHPCS handles it.  It should do fine!';
    }
}

$foo = 'abc' . "{$foo}bar";

$foo = "{$foo}bar" . 'abc';

$foo = 'abc' . "{$foo}bar";

$foo = "{$foo}bar" .
'abc and a bunch more characters to make this take up >144 when concatenated to the previous line';

$foo = 'abc and a bunch more characters to make this take up >144 when concatenated to the next line' .
"{$foo}bar";

$foo = 'First line
Second line' . 'additional';

$foo = 'First line
Second line a bunch of characters to make this line take up <144 characters but enough that when concatenated with the previous line it is >144' .
'additional';

$foo = 'First line
Second line a bunch of characters to make this line take up >144 characters' .
'additional';
