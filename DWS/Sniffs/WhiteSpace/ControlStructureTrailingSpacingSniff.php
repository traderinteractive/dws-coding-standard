<?php
/**
 * Verifies that no whitespace proceeds the first content of the file, that there is
 * no whitespace at the end of a line, that there are no extra new lines before or after
 * a function or class or control structure, and that there are no two empty lines in a row.
 *
 * @package DWS
 * @subpackage Sniffs
 */

/**
 * Verifies that no whitespace proceeds the first content of the file, that there is
 * no whitespace at the end of a line, that there are no extra new lines before or after
 * a function or class or control structure, and that there are no two empty lines in a row.
 *
 * @package DWS
 * @subpackage Sniffs
 */
final class DWS_Sniffs_WhiteSpace_ControlStructureTrailingSpacingSniff implements PHP_CodeSniffer_Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return array(
            T_IF,
            T_WHILE,
            T_FOREACH,
            T_FOR,
            T_SWITCH,
            T_DO,
            T_ELSE,
            T_ELSEIF,
            T_TRY,
            T_CATCH,
        );
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
        $token = $tokens[$stackPtr];

        if (!array_key_exists('scope_closer', $token)) {
            return;
        }

        $scopeCloser = $token['scope_closer'];
        $trailingContent = $phpcsFile->findNext(T_WHITESPACE, $scopeCloser + 1, null, true);

        if ($tokens[$trailingContent]['code'] === T_ELSE && $token['code'] === T_IF) {
            return;
        }

        if ($tokens[$trailingContent]['code'] === T_CLOSE_TAG) {
            return;
        }

        if ($tokens[$trailingContent]['code'] === T_CLOSE_CURLY_BRACKET) {
            if (array_key_exists('scope_condition', $tokens[$trailingContent])) {
                $owner = $tokens[$trailingContent]['scope_condition'];
                if ($tokens[$owner]['code'] === T_FUNCTION) {
                    return;
                }
            }

            if ($tokens[$trailingContent]['line'] !== $tokens[$scopeCloser]['line'] + 1) {
                $phpcsFile->addError('Blank line found after control structure', $scopeCloser, 'LineAfterClose');
            }
        } elseif ($tokens[$trailingContent]['line'] === $tokens[$scopeCloser]['line'] + 1) {
            $phpcsFile->addError('No blank line found after control structure', $scopeCloser, 'NoLineAfterClose');
        }
    }
}
