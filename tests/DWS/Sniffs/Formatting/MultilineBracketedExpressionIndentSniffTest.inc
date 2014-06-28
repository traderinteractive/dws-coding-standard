<?php
$foo = array(
    'a' => 1,
    'b' => 2,
);
$foo = array(
  'a' => 1,
  'b' => 2,
);

$foo = [
    'a' => 1,
    'b' => 2,
];
$foo = [
      'a' => 1,
      'b' => 2,
  ];

$foo = [
    'a' => [
        1,
        2,
        3,
    ],
];
$foo = [
        'a' => [
            1,
            2,
                3,
    ],
];

$foo = array(
    'a',
    'b',
);
$foo = array('a',
    'b',
);

if (
    $test1 &&
    (
        $test2 ||
        $test3
    )
) {
    $foo = array(
        1,
        2,
    );
}

if (
        $test1 &&
        (
                $test2 ||
            $test3
        )
) {
    $foo = array(
        1,
       2,
    );
}
$foo = array('a' => 1, 'b' => 2);
