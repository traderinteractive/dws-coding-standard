<?php
final class DWS_Sniffs_WhiteSpace_ControlStructureTrailingSpacingSniffTest extends AbstractSniffUnitTest
{
    public function getErrorList()
    {
        return array(28 => 1, 32 => 1);
    }

    public function getWarningList()
    {
        return array();
    }

    protected function _getSniffName()
    {
        return 'DWS_Sniffs_WhiteSpace_ControlStructureTrailingSpacingSniff';
    }
}
