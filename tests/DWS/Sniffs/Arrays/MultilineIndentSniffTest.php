<?php
require_once dirname(dirname(dirname(__DIR__))) . '/AbstractSniffUnitTest.php';

final class DWS_Sniffs_Arrays_MultilineIndentSniffTest extends AbstractSniffUnitTest
{
    public function getErrorList()
    {
        return array(14 => 1, 15 => 1, 16 => 1, 19 => 1, 20 => 1, 21 => 1, 22 => 1);
    }

    public function getWarningList()
    {
        return array();
    }

    protected function _getSniffName()
    {
        return 'DWS_Sniffs_Arrays_MultilineIndentSniff';
    }
}
