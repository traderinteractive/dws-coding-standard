<?php
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

    protected function _getSniffName()
    {
        return 'DWS_Sniffs_Strings_DoubleQuoteUsageSniff';
    }
}
