<?php
/**
 * A collection of helper methods for operators.
 *
 * @package DWS
 * @subpackage Helpers
 */

/**
 * A collection of helper methods for operators.
 *
 * @package DWS
 * @subpackage Helpers
 */
final class DWS_Helpers_Operator
{
    /**
     * Given a pointer to a bracketed expression (such as T_ARRAY or T_OPEN_SHORT_ARRAY), returns the stack pointer for the opening bracket.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file where the bracketed expression is declared.
     * @param int $stackPtr The position of the expression element in the stack in $phpcsFile.
     *
     * @return int The position of the opening bracket, or if not found, the given $stackPtr.
     */
    public static function isUnary(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if ($tokens[$stackPtr]['code'] === T_BOOLEAN_NOT) {
            return true;
        }

        if ($tokens[$stackPtr]['code'] === T_BITWISE_AND && $phpcsFile->isReference($stackPtr)) {
            return true;
        }

        if ($tokens[$stackPtr]['code'] === T_MINUS) {
            $prev = $phpcsFile->findPrevious(T_WHITESPACE, $stackPtr - 1, null, true);
            $unaryHints = array_unique(
                array_merge(
                    PHP_CodeSniffer_Tokens::$comparisonTokens,
                    PHP_CodeSniffer_Tokens::$operators,
                    PHP_CodeSniffer_Tokens::$assignmentTokens,
                    [
                        T_RETURN,
                        T_COMMA,
                        T_OPEN_PARENTHESIS,
                        T_OPEN_SQUARE_BRACKET,
                        T_DOUBLE_ARROW,
                        T_COLON,
                        T_INLINE_THEN,
                        T_INLINE_ELSE,
                        T_CASE,
                    ]
                )
            );

            if (in_array($tokens[$prev]['code'], $unaryHints)) {
                return true;
            }
        }

        return false;
    }
}
