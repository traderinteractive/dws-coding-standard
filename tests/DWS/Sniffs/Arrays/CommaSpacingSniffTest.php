<?php
require_once dirname(dirname(dirname(__DIR__))) . '/AbstractSniffUnitTest.php';

final class DWS_Sniffs_Arrays_CommaSpacingSniffTest extends AbstractSniffUnitTest
{
    public function getErrorList()
    {
        return array(16 => 1, 17 => 1, 18 => 1, 19 => 1, 20 => 1, 21 => 1, 24 => 1, 29 => 2);
    }

    public function getWarningList()
    {
        return array();
    }

    protected function _getSniffName()
    {
        return 'DWS_Sniffs_Arrays_CommaSpacingSniff';
    }
}
