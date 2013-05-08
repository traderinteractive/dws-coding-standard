<?php
require_once dirname(dirname(dirname(__DIR__))) . '/AbstractSniffUnitTest.php';

class DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniffGoodBeginningTest extends AbstractSniffUnitTest
{
    public function getErrorList()
    {
        return array(6 => 1);
    }

    public function getWarningList()
    {
        return array();
    }

    protected function _getSniffName()
    {
        return 'DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniff';
    }
}
