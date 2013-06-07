<?php
require_once dirname(dirname(dirname(__DIR__))) . '/AbstractSniffUnitTest.php';

final class DWS_Sniffs_Formatting_MultilineBracketedExpressionIndentSniffTest extends AbstractSniffUnitTest
{
    public function getErrorList()
    {
        return array(7 => 1, 8 => 1, 16 => 1, 17 => 1, 18 => 1, 28 => 1, 31 => 1, 32 => 1, 39 => 1, 57 => 1, 58 => 1, 59 => 1, 65 => 1);
    }

    public function getWarningList()
    {
        return array();
    }

    protected function _getSniffName()
    {
        return 'DWS_Sniffs_Formatting_MultilineBracketedExpressionIndentSniff';
    }
}
