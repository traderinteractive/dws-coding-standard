<?php
require_once dirname(dirname(dirname(__DIR__))) . '/AbstractSniffUnitTest.php';

class DWS_Sniffs_ControlStructures_ControlSignatureSniffTest extends AbstractSniffUnitTest
{
    public function getErrorList()
    {
        return array(2 => 1, 14 => 1);
    }

    public function getWarningList()
    {
        return array();
    }

    protected function _getSniffName()
    {
        return 'DWS_Sniffs_ControlStructures_ControlSignatureSniff';
    }
}
