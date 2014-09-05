<?php
final class DWS_Sniffs_Strings_UnnecessaryStringConcatSniffTest extends AbstractSniffUnitTest
{
    public function getErrorList()
    {
        return [4 => 1, 34 => 1, 36 => 1, 38 => 1, 40 => 1, 43 => 1, 47 => 1, 54 => 1];
    }

    public function getWarningList()
    {
        return [];
    }

    protected function _getSniffName()
    {
        return 'DWS_Sniffs_Strings_UnnecessaryStringConcatSniff';
    }
}
