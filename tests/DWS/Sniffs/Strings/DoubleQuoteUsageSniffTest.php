<?php
require_once dirname(dirname(dirname(__DIR__))) . '/AbstractSniffUnitTest.php';

class DWS_Sniffs_Strings_DoubleQuoteUsageSniffTest extends AbstractSniffUnitTest
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
