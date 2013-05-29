<?php
require_once dirname(dirname(dirname(__DIR__))) . '/AbstractSniffUnitTest.php';

final class DWS_Sniffs_Arrays_TrailingCommaSniffTest extends AbstractSniffUnitTest
{
    public function getErrorList()
    {
        return array(25 => 1, 26 => 1, 27 => 1, 28 => 1, 32 => 1, 37 => 1, 42 => 1, 45 => 1);
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
