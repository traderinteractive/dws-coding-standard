<?php
require_once dirname(dirname(__DIR__)) . '/AbstractSniffUnitTest.php';

class DWS_Tests_Strings_DoubleQuoteUsageSniffTest extends AbstractSniffUnitTest
{
    public function getErrorList()
    {
        return array(2 => 1, 9 => 1);
    }

    public function getWarningList()
    {
        return array();
    }
}
