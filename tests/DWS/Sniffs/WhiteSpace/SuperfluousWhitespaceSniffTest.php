<?php
class DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniffTest extends AbstractSniffUnitTest
{
    public function getErrorList()
    {
        return array(2 => 1, 3 => 1, 4 => 1, 9 => 1, 13 => 1, 17 => 1, 20 => 1, 23 => 1, 29 => 1);
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
