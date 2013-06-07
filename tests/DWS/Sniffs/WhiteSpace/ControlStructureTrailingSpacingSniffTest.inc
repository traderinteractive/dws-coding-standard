<?php
if (true) {
    $foo = 'bah';
} else {
    $foo = 'gah';
}

do {
    if (true) {
        $foo = 'test';
    }
} while (true);

function f($foo) {
    if ($foo) {
        echo $foo;
    }
}

foreach ($baz as $bar) {
    echo $bar;
}
?>
dummy
<?php
if (true) {
    $foo = 'bah';
}
do {
    if (true) {
        $foo = 'test';
    }

} while (true); while (true);

function f($foo) {
    if ($foo) {
        echo $foo;
    }

}
