<?php
final class DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniffGoodBeginningTest extends AbstractSniffUnitTest
{
    public function getErrorList()
    {
        return [6 => 1];
    }

    public function getWarningList()
    {
        return [];
    }

    protected function _getSniffName()
    {
        return 'DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniff';
    }
}
