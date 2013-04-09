<?php
require_once dirname(dirname(__DIR__)) . '/AbstractSniffUnitTest.php';

class DWS_Tests_Strings_EmbeddedVariablesSniffTest extends AbstractSniffUnitTest
{
    public function getErrorList()
    {
        return array(3 => 1, 7 => 1, 16 => 1, 20 => 1);
    }

    public function getWarningList()
    {
        return array();
    }
}
