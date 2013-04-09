<?php
require_once dirname(dirname(__DIR__)) . '/AbstractSniffUnitTest.php';

class DWS_Tests_Scope_VariableScopeSniffTest extends AbstractSniffUnitTest
{
    public function getErrorList()
    {
        return array();
    }

    public function getWarningList()
    {
        return array(5 => 1, 17 => 1, 33 => 1, 99 => 1, 100 => 1, 101 => 1, 102 => 1, 140 => 1);
    }
}
