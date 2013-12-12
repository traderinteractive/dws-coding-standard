<?php
/**
 * Checks that two strings are not concatenated together; suggests
 * using one string instead.
 *
 * @package DWS
 * @subpackage Sniffs
 */

/**
 * Checks that two strings are not concatenated together; suggests
 * using one string instead.
 *
 * @package DWS
 * @subpackage Sniffs
 */
final class DWS_Sniffs_Strings_UnnecessaryStringConcatSniff implements PHP_CodeSniffer_Sniff
{
    /**
     * The limit that the length of a line should not exceed.
     *
     * @var int
     */
    public $stringLimit = 144;

    /**
     * A list of tokenizers this sniff supports.
     *
     * @var array
     */
    public $supportedTokenizers = array('PHP', 'JS');

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return array(T_STRING_CONCAT, T_PLUS);
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
        // Work out which type of file this is for.
        $tokens = $phpcsFile->getTokens();
        if ($tokens[$stackPtr]['code'] === T_STRING_CONCAT XOR $phpcsFile->tokenizerType === 'PHP') {
            return;
        }

        //Find the surrounding non-whitespace characters
        $prev = $phpcsFile->findPrevious(T_WHITESPACE, $stackPtr - 1, null, true);
        $next = $phpcsFile->findNext(T_WHITESPACE, $stackPtr + 1, null, true);

        $stringTokens = PHP_CodeSniffer_Tokens::$stringTokens;
        //See if the characters before and after the concatenation are quotes
        if (
            in_array($tokens[$prev]['code'], $stringTokens) !== true ||
            in_array($tokens[$next]['code'], $stringTokens) !== true
        ) {
            return;
        }

        //Make sure the combined string would not be too long for one line.
        if (strlen($tokens[$prev]['content']) + strlen($tokens[$next]['content']) + $tokens[$prev]['column'] > $this->stringLimit) {
            return;
        }

        $error = 'String concat is not required here; use a single string instead';
        $phpcsFile->addError($error, $stackPtr, 'Found');
    }
}
