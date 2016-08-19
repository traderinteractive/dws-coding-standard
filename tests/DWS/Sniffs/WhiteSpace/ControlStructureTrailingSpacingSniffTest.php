<?php
final class DWS_Sniffs_WhiteSpace_ControlStructureTrailingSpacingSniffTest extends AbstractSniffUnitTest
{
    public function getErrorList()
    {
        return [28 => 1, 32 => 1];
    }

    public function getWarningList()
    {
        return [];
    }

    protected function _getSniffName()
    {
        return 'DWS.WhiteSpace.ControlStructureTrailingSpacing';
    }
}
