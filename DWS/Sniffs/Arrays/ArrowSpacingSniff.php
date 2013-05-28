<?php
/**
 * A test to ensure that arrows in arrays are set with proper whitespace.
 *
 * @package DWS
 * @subpackage Sniffs
 */

/**
 * A test to ensure that arrows in arrays are set with proper whitespace.
 *
 * @package DWS
 * @subpackage Sniffs
 */
final class DWS_Sniffs_Arrays_ArrowSpacingSniff implements PHP_CodeSniffer_Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return array(T_DOUBLE_ARROW);
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

        $beforeToken = $tokens[$stackPtr - 1];
        if ($beforeToken['code'] !== T_WHITESPACE) {
            $phpcsFile->addError('Expected 1 space before =>, 0 found', $stackPtr, 'SpaceBeforeArrow');
        } elseif ($beforeToken['content'] !== ' ') {
            $phpcsFile->addError('Expected 1 space before =>, %s found', $stackPtr, 'SpaceBeforeArrow', array(strlen($beforeToken['content'])));
        }

        $afterToken = $tokens[$stackPtr + 1];
        if ($afterToken['code'] !== T_WHITESPACE) {
            $phpcsFile->addError('Expected 1 space after =>, 0 found', $stackPtr, 'SpaceAfterArrow');
        } elseif ($afterToken['content'] !== ' ') {
            $phpcsFile->addError('Expected 1 space after =>, %s found', $stackPtr, 'SpaceAfterArrow', array(strlen($afterToken['content'])));
        }
    }
}
