<?php
/**
 * A collection of helper methods for bracketed expressions.
 *
 * @package DWS
 * @subpackage Helpers
 */

/**
 * A collection of helper methods for bracketed expressions.
 *
 * @package DWS
 * @subpackage Helpers
 */
final class DWS_Helpers_Bracket
{
    /**
     * Given a pointer to a bracketed expression (such as T_ARRAY or T_OPEN_SHORT_ARRAY), returns the stack pointer for the opening bracket.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file where the bracketed expression is declared.
     * @param int $stackPtr The position of the expression element in the stack in $phpcsFile.
     *
     * @return int The position of the opening bracket, or if not found, the given $stackPtr.
     */
    public static function bracketStart(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        if (array_key_exists('parenthesis_opener', $tokens[$stackPtr])) {
            return $tokens[$stackPtr]['parenthesis_opener'];
        } elseif (array_key_exists('bracket_opener', $tokens[$stackPtr])) {
            return $tokens[$stackPtr]['bracket_opener'];
        } else {
            return $stackPtr;
        }
    }

    /**
     * Given a pointer to a bracketed expression (such as T_ARRAY or T_OPEN_SHORT_ARRAY), returns the stack pointer for the ending bracket.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file where the bracketed expression is declared.
     * @param int $stackPtr The position of the expression element in the stack in $phpcsFile.
     *
     * @return int The position of the ending bracket, or if not found, the given $stackPtr.
     */
    public static function bracketEnd(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        if (array_key_exists('parenthesis_closer', $tokens[$stackPtr])) {
            return $tokens[$stackPtr]['parenthesis_closer'];
        } elseif (array_key_exists('bracket_closer', $tokens[$stackPtr])) {
            return $tokens[$stackPtr]['bracket_closer'];
        } else {
            return $stackPtr;
        }
    }
}
