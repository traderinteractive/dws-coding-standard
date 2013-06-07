<?php
/**
 * A collection of helper methods for arrays.
 *
 * @package DWS
 * @subpackage Helpers
 */

/**
 * A collection of helper methods for arrays.
 *
 * @package DWS
 * @subpackage Helpers
 */
final class DWS_Helpers_Array
{
    /**
     * Given a pointer to an array element (such as T_ARRAY or T_OPEN_SHORT_ARRAY), returns the stack pointer for the opening parenthesis or
     * bracket.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file where the array is declared.
     * @param int $stackPtr The position of the array element in the stack in $phpcsFile.
     *
     * @return int The position of the opening parenthesis or bracket, or if not found, the given $stackPtr.
     */
    public static function arrayStart(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
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
     * Given a pointer to an array element (such as T_ARRAY or T_OPEN_SHORT_ARRAY), returns the stack pointer for the ending parenthesis or
     * bracket.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file where the array is declared.
     * @param int $stackPtr The position of the array element in the stack in $phpcsFile.
     *
     * @return int The position of the ending parenthesis or bracket, or if not found, the given $stackPtr.
     */
    public static function arrayEnd(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
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

    /**
     * Returns the positions of all of the commas that belong to the array beginning at $arrayStart.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file where the array is declared.
     * @param int $arrayStart The position of the opening parenthesis or bracket for the array in the file.
     *
     * @return array The stack pointers for all of the commas in the array (excluding commas in nested arrays, functions, etc.).
     */
    public static function commaPositions(PHP_CodeSniffer_File $phpcsFile, $arrayStart)
    {
        $tokens = $phpcsFile->getTokens();
        $arrayEnd = self::arrayEnd($phpcsFile, $arrayStart);

        $commas = array();
        for ($i = $arrayStart + 1; $i <= $arrayEnd; $i++) {
            if (array_key_exists('parenthesis_closer', $tokens[$i])) {
                $i = $tokens[$i]['parenthesis_closer'];
            } elseif (array_key_exists('bracket_closer', $tokens[$i])) {
                $i = $tokens[$i]['bracket_closer'];
            } elseif ($tokens[$i]['code'] === T_COMMA) {
                $commas[] = $i;
            }
        }

        return $commas;
    }
}
