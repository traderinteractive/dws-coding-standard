<?php
final class DWS_Sniffs_Scope_VariableScopeSniffTest extends AbstractSniffUnitTest
{
    public function getErrorList()
    {
        return array();
    }

    public function getWarningList()
    {
        return array(5 => 1, 17 => 1, 33 => 1, 99 => 1, 100 => 1, 101 => 1, 102 => 1, 140 => 1);
    }

    protected function _getSniffName()
    {
        return 'DWS_Sniffs_Scope_VariableScopeSniff';
    }
}
