<?php
/**
 * A test to ensure that arrays conform to the array coding standard.
 *
 * @package DWS
 * @subpackage Sniffs
 */

/**
 * A test to ensure that arrays conform to the array coding standard.
 *
 * @package DWS
 * @subpackage Sniffs
 */
final class DWS_Sniffs_Arrays_ArrayDeclarationSniff implements PHP_CodeSniffer_Sniff
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

        if (!in_array($arrayStart, array($stackPtr, $stackPtr + 1))) {
            $phpcsFile->addError('No whitespace allowed between the array keyword and the opening parenthesis', $stackPtr, 'SpaceAfterKeyword');
        }

        $firstMember = $phpcsFile->findNext(T_WHITESPACE, $arrayStart + 1, $arrayEnd, true);
        if ($firstMember === false && $arrayEnd - $arrayStart !== 1) {
            $phpcsFile->addError('Empty array declaration must have no space between the brackets', $stackPtr, 'SpaceInEmptyArray');
        }
    }
}
