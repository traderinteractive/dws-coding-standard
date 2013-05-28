<?php
require_once dirname(dirname(dirname(__DIR__))) . '/AbstractSniffUnitTest.php';

final class DWS_Sniffs_Arrays_TrailingCommaSniffTest extends AbstractSniffUnitTest
{
    public function getErrorList()
    {
        return array(17 => 1, 18 => 1, 19 => 1, 20 => 1, 24 => 1, 29 => 1);
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
