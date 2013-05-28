<?php
/**
 * A test to ensure that trailing commas are included for multi-line arrays only.
 *
 * @package DWS
 * @subpackage Sniffs
 */

/**
 * A test to ensure that trailing commas are included for multi-line arrays only.
 *
 * @package DWS
 * @subpackage Sniffs
 */
final class DWS_Sniffs_Arrays_TrailingCommaSniff implements PHP_CodeSniffer_Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return array(T_ARRAY, T_OPEN_SHORT_ARRAY);
    }

    /**
     * Processes this sniff, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The current file being checked.
     * @param int $stackPtr The position of the current token in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $arrayStart = DWS_Helpers_Array::arrayStart($phpcsFile, $stackPtr);
        $arrayEnd = DWS_Helpers_Array::arrayEnd($phpcsFile, $stackPtr);

        $isSingleLine = $tokens[$arrayStart]['line'] === $tokens[$arrayEnd]['line'];

        $commas = DWS_Helpers_Array::commaPositions($phpcsFile, $arrayStart);
        if (count($commas) === 0) {
            return;
        }

        $lastComma = array_pop($commas);
        $trailingComma = $phpcsFile->findNext(PHP_CodeSniffer_Tokens::$emptyTokens, $lastComma + 1, $arrayEnd, true) === false;

        if ($isSingleLine) {
            if ($trailingComma) {
                $phpcsFile->addError('No trailing comma allowed on single-line arrays', $lastComma, 'SingleLineTrailingComma');
            }
        } elseif (!$trailingComma) {
            $previousItem = $phpcsFile->findPrevious(PHP_CodeSniffer_Tokens::$emptyTokens, $arrayEnd - 1, $arrayStart, true);
            $phpcsFile->addError('Trailing comma required for multi-line arrays', $previousItem, 'MultiLineTrailingComma');
        }
    }
}
