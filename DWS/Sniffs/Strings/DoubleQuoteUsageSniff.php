<?php
/**
 * Makes sure that any use of Double Quotes are warranted.
 *
 * @package DWS
 * @subpackage Sniffs
 */

/**
 * Makes sure that any use of Double Quotes are warranted.
 *
 * @package DWS
 * @subpackage Sniffs
 */
final class DWS_Sniffs_Strings_DoubleQuoteUsageSniff implements PHP_CodeSniffer_Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return array(T_CONSTANT_ENCAPSED_STRING);
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

        // We are only interested in the first token in a multi-line string.
        if ($tokens[$stackPtr]['code'] === $tokens[$stackPtr - 1]['code']) {
            return;
        }

        $workingString = $tokens[$stackPtr]['content'];
        for ($i = $stackPtr + 1; $tokens[$i]['code'] === $tokens[$stackPtr]['code']; ++$i) {
            $workingString .= $tokens[$i]['content'];
        }

        // Check if it's a double quoted string.
        if (strpos($workingString, '"') === false) {
            return;
        }

        $allowedStrings = array('\0', '\n', '\r', '\f', '\t', '\v', '\x', '\'');

        foreach ($allowedStrings as $testChar) {
            if (strpos($workingString, $testChar) !== false) {
                return;
            }
        }

        $phpcsFile->addError("String {$workingString} does not require double quotes; use single quotes instead", $stackPtr, 'NotRequired');
    }
}
