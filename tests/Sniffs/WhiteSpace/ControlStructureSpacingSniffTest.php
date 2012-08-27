<?php
require_once 'PHP/CodeSniffer.php';
require_once __DIR__ . '/../../SniffTestCase.php';

class DWS_Sniffs_WhiteSpace_ControlStructureSpacingSniff_Test extends SniffTestCase
{
    private $_spaceAtBeginningOfIf;
    private $_spaceAtBeginningOfWhile;
    private $_spaceAtBeginningOfFor;
    private $_spaceAtBeginningOfForeach;
    private $_spaceAtBeginningOfSwitch;
    private $_spaceAtBeginningOfDo;
    private $_spaceAtBeginningOfElse;
    private $_spaceAtBeginningOfElseif;
    private $_spaceAtBeginningOfTry;
    private $_spaceAtBeginningOfCatch;
    private $_spaceAtEndOfIf;
    private $_spaceAtEndOfWhile;
    private $_spaceAtEndOfFor;
    private $_spaceAtEndOfForeach;
    private $_spaceAtEndOfSwitch;
    private $_spaceAtEndOfDo;
    private $_spaceAtEndOfElse;
    private $_spaceAtEndOfElseif;
    private $_spaceAtEndOfTry;
    private $_spaceAtEndOfCatch;

    public function setUp()
    {
        parent::setUp(array('DWS_Sniffs_WhiteSpace_ControlStructureSpacingSniff'));
        $this->_spaceAtBeginningOfIf = <<< 'NOWDOC'
<?php
if (true) {

    echo 'hi';
}
NOWDOC;
        $this->_spaceAtBeginningOfWhile = <<< 'NOWDOC'
<?php
while (true) {

    echo 'hi';
}
NOWDOC;
        $this->_spaceAtBeginningOfFor = <<< 'NOWDOC'
<?php
for ($i = 0; $i < 3; $i++) {

    echo 'hi';
}
NOWDOC;
        $this->_spaceAtBeginningOfForeach = <<< 'NOWDOC'
<?php
foreach ($thing in $things) {

    echo 'hi';
}
NOWDOC;
        $this->_spaceAtBeginningOfSwitch = <<< 'NOWDOC'
<?php
switch ($a)
{

    case 0:
        break;
    case 1:
        break;
}
NOWDOC;
        $this->_spaceAtBeginningOfDo = <<< 'NOWDOC'
<?php
do {

    echo 'hi';
} while (true);
NOWDOC;
        $this->_spaceAtBeginningOfElse = <<< 'NOWDOC'
<?php
if (true) {
    echo 'yes';
} else {

    echo 'no';
}
NOWDOC;
        $this->_spaceAtBeginningOfElseif = <<< 'NOWDOC'
<?php
if (true) {
    echo 'yes';
} elseif (false) {

    echo 'no';
}
NOWDOC;
        $this->_spaceAtBeginningOfTry = <<< 'NOWDOC'
<?php
try {

    echo 'hi';
} catch (Exception $e) {
    echo $e->getMessage();
}
NOWDOC;
        $this->_spaceAtBeginningOfCatch = <<< 'NOWDOC'
<?php
try {
    echo 'hi';
} catch (Exception $e) {

    echo $e->getMessage();
}
NOWDOC;
        $this->_spaceAtEndOfIf = <<< 'NOWDOC'
<?php
if (true) {
    echo 'hi';

}
NOWDOC;
        $this->_spaceAtEndOfWhile = <<< 'NOWDOC'
<?php
while (true) {
    echo 'hi';

}
NOWDOC;
        $this->_spaceAtEndOfFor = <<< 'NOWDOC'
<?php
for ($i = 0; $i < 3; $i++) {
    echo 'hi';

}
NOWDOC;
        $this->_spaceAtEndOfForeach = <<< 'NOWDOC'
<?php
foreach ($thing in $things) {
    echo 'hi';

}
NOWDOC;
        $this->_spaceAtEndOfSwitch = <<< 'NOWDOC'
<?php
switch ($a)
{
    case 0:
        break;
    case 1:
        break;

}
NOWDOC;
        $this->_spaceAtEndOfDo = <<< 'NOWDOC'
<?php
do {
    echo 'hi';

} while (true);
NOWDOC;
        $this->_spaceAtEndOfElse = <<< 'NOWDOC'
<?php
if (true) {
    echo 'yes';
} else {
    echo 'no';

}
NOWDOC;
        $this->_spaceAtEndOfElseif = <<< 'NOWDOC'
<?php
if (true) {
    echo 'yes';
} elseif (false) {
    echo 'no';

}
NOWDOC;
        $this->_spaceAtEndOfTry = <<< 'NOWDOC'
<?php
try {
    echo 'hi';

} catch (Exception $e) {
    echo $e->getMessage();
}
NOWDOC;
        $this->_spaceAtEndOfCatch = <<< 'NOWDOC'
<?php
try {
    echo 'hi';
} catch (Exception $e) {
    echo $e->getMessage();

}
NOWDOC;
    }

    public function testSpaceAtBeginningOfIf()
    {
        $this->_phpcs->process(
            array(),
            $this->_standard,
            array('DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('SpaceAtBeginningOfIf', $this->_spaceAtBeginningOfIf);

        $this->assertErrorMessages('Blank line at beginning of if');
    }

    public function testSpaceAtBeginningOfWhile()
    {
        $this->_phpcs->process(
            array(),
            $this->_standard,
            array('DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('SpaceAtBeginningOfWhile', $this->_spaceAtBeginningOfWhile);

        $this->assertErrorMessages('Blank line at beginning of while');
    }

    public function testSpaceAtBeginningOfFor()
    {
        $this->_phpcs->process(
            array(),
            $this->_standard,
            array('DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('SpaceAtBeginningOfFor', $this->_spaceAtBeginningOfFor);

        $this->assertErrorMessages('Blank line at beginning of for');
    }

    public function testSpaceAtBeginningOfForeach()
    {
        $this->_phpcs->process(
            array(),
            $this->_standard,
            array('DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('SpaceAtBeginningOfForeach', $this->_spaceAtBeginningOfForeach);

        $this->assertErrorMessages('Blank line at beginning of foreach');
    }

    public function testSpaceAtBeginningOfElse()
    {
        $this->_phpcs->process(
            array(),
            $this->_standard,
            array('DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('SpaceAtBeginningOfElse', $this->_spaceAtBeginningOfElse);

        $this->assertErrorMessages('Blank line at beginning of else');
    }

    public function testSpaceAtBeginningOfElseif()
    {
        $this->_phpcs->process(
            array(),
            $this->_standard,
            array('DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('SpaceAtBeginningOfElseif', $this->_spaceAtBeginningOfElseif);

        $this->assertErrorMessages('Blank line at beginning of elseif');
    }

    public function testSpaceAtBeginningOfTry()
    {
        $this->_phpcs->process(
            array(),
            $this->_standard,
            array('DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('SpaceAtBeginningOfTry', $this->_spaceAtBeginningOfTry);

        $this->assertErrorMessages('Blank line at beginning of try');
    }

    public function testSpaceAtBeginningOfCatch()
    {
        $this->_phpcs->process(
            array(),
            $this->_standard,
            array('DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('SpaceAtBeginningOfCatch', $this->_spaceAtBeginningOfCatch);

        $this->assertErrorMessages('Blank line at beginning of catch');
    }

    public function testSpaceAtEndOfIf()
    {
        $this->_phpcs->process(
            array(),
            $this->_standard,
            array('DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('SpaceAtEndOfIf', $this->_spaceAtEndOfIf);

        $this->assertErrorMessages('Blank line at end of if');
    }

    public function testSpaceAtEndOfWhile()
    {
        $this->_phpcs->process(
            array(),
            $this->_standard,
            array('DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('SpaceAtEndOfWhile', $this->_spaceAtEndOfWhile);

        $this->assertErrorMessages('Blank line at end of while');
    }

    public function testSpaceAtEndOfFor()
    {
        $this->_phpcs->process(
            array(),
            $this->_standard,
            array('DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('SpaceAtEndOfFor', $this->_spaceAtEndOfFor);

        $this->assertErrorMessages('Blank line at end of for');
    }

    public function testSpaceAtEndOfForeach()
    {
        $this->_phpcs->process(
            array(),
            $this->_standard,
            array('DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('SpaceAtEndOfForeach', $this->_spaceAtEndOfForeach);

        $this->assertErrorMessages('Blank line at end of foreach');
    }

    public function testSpaceAtEndOfElse()
    {
        $this->_phpcs->process(
            array(),
            $this->_standard,
            array('DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('SpaceAtEndOfElse', $this->_spaceAtEndOfElse);

        $this->assertErrorMessages('Blank line at end of else');
    }

    public function testSpaceAtEndOfElseif()
    {
        $this->_phpcs->process(
            array(),
            $this->_standard,
            array('DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('SpaceAtEndOfElseif', $this->_spaceAtEndOfElseif);

        $this->assertErrorMessages('Blank line at end of elseif');
    }

    public function testSpaceAtEndOfTry()
    {
        $this->_phpcs->process(
            array(),
            $this->_standard,
            array('DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('SpaceAtEndOfTry', $this->_spaceAtEndOfTry);

        $this->assertErrorMessages('Blank line at end of try');
    }

    public function testSpaceAtEndOfCatch()
    {
        $this->_phpcs->process(
            array(),
            $this->_standard,
            array('DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniff'), //Sniff
            null
        );

        $this->_phpcs->processFile('SpaceAtEndOfCatch', $this->_spaceAtEndOfCatch);

        $this->assertErrorMessages('Blank line at end of catch');
    }
}
