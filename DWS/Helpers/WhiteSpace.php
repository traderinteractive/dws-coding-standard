<?php
/**
 * A collection of helper methods for whitespace.
 *
 * @package DWS
 * @subpackage Helpers
 */

/**
 * A collection of helper methods for whitespace.
 *
 * @package DWS
 * @subpackage Helpers
 */
final class DWS_Helpers_Whitespace
{
    /**
     * Returns the indentation level of the requested line.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file in question.
     * @param int $stackPtr The stack pointer to the element on the line in question.
     *
     * @return int The normalized column number for the initial non-whitespace token on the line. 
     */
    public static function indentOfLine(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $beginningElement = $stackPtr;
        $previousElement = $phpcsFile->findPrevious(T_WHITESPACE, $beginningElement - 1, null, true);
        while ($previousElement !== false && $tokens[$previousElement]['line'] === $tokens[$stackPtr]['line']) {
            $beginningElement = $previousElement;
            $previousElement = $phpcsFile->findPrevious(T_WHITESPACE, $beginningElement - 1, null, true);
        }

        return $tokens[$beginningElement]['column'];
    }
}
