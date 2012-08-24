<?php
/**
 * Makes sure that any control structures that can be inline don't use braces.
 *
 * @package DWS
 * @subpackage Sniffs
 */

/**
 * Makes sure that any control structures that can be inline don't use braces.
 *
 * @package DWS
 * @subpackage Sniffs
 */
class DWS_Sniffs_ControlStructures_OneLineBracesSniff implements PHP_CodeSniffer_Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return array(T_IF, T_WHILE, T_ELSE, T_ELSEIF, T_FOR, T_FOREACH, T_DO);
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int $stackPtr The position of the current token in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if (array_key_exists('scope_closer', $tokens[$stackPtr]) === false)
            $phpcsFile->addError('Braces should be used for this control structure.', $stackPtr, 'NotRequired');
    }
}
