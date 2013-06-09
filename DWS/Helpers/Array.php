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
        $arrayEnd = DWS_Helpers_Bracket::bracketEnd($phpcsFile, $arrayStart);

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
