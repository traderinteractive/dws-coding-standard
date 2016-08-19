<?php
final class DWS_Sniffs_WhiteSpace_ControlStructureInteriorSpacingSniffTest extends AbstractSniffUnitTest
{
    public function getErrorList()
    {
        return [
            2 => 1,
            7 => 1,
            12 => 1,
            17 => 1,
            22 => 1,
            30 => 1,
            37 => 1,
            44 => 1,
            49 => 1,
            58 => 1,
            65 => 1,
            70 => 1,
            75 => 1,
            80 => 1,
            88 => 1,
            93 => 1,
            100 => 1,
            107 => 1,
            112 => 1,
            121 => 1,
        ];
    }

    public function getWarningList()
    {
        return [];
    }

    protected function _getSniffName()
    {
        return 'DWS.WhiteSpace.ControlStructureInteriorSpacing';
    }
}
