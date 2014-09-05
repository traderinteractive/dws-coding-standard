<?php
final class DWS_Sniffs_WhiteSpace_OperatorSpacingSniffTest extends AbstractSniffUnitTest
{
    public function getErrorList()
    {
        return [
            3 => 2,
            4 => 2,
            7 => 2,
            8 => 2,
            12 => 2,
            21 => 1,
            28 => 2,
            29 => 2,
            32 => 1,
            38 => 1,
            41 => 4,
            42 => 4,
            45 => 2,
            46 => 2,
            49 => 2,
            50 => 1,
        ];
    }

    public function getWarningList()
    {
        return [];
    }

    protected function _getSniffName()
    {
        return 'DWS_Sniffs_WhiteSpace_OperatorSpacingSniff';
    }
}
