<?php
final class DWS_Sniffs_Strings_DoubleQuoteUsageSniffTest extends AbstractSniffUnitTest
{
    public function getErrorList()
    {
        return [2 => 1, 9 => 1];
    }

    public function getWarningList()
    {
        return [];
    }

    protected function _getSniffName()
    {
        return 'DWS.Strings.DoubleQuoteUsage';
    }
}
