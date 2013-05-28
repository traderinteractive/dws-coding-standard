<?php
require_once dirname(dirname(dirname(__DIR__))) . '/AbstractSniffUnitTest.php';

final class DWS_Sniffs_Arrays_TrailingCommaSniffTest extends AbstractSniffUnitTest
{
    public function getErrorList()
    {
        return array(22 => 1, 23 => 1, 24 => 1, 25 => 1, 29 => 1, 34 => 1, 39 => 1);
    }

    public function getWarningList()
    {
        return array();
    }

    protected function _getSniffName()
    {
        return 'DWS_Sniffs_Arrays_TrailingCommaSniff';
    }
}
