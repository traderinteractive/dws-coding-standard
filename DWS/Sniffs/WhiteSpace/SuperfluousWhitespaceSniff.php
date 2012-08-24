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
class DWS_Sniffs_WhiteSpace_SuperfluousWhitespaceSniff implements PHP_CodeSniffer_Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        $tokens = PHP_CodeSniffer_Tokens::$scopeOpeners;
        $tokens[] = T_OPEN_TAG;
        $tokens[] = T_WHITESPACE;
        $tokens[] = T_COMMENT;
        return $tokens;
    }

    /**
     * Processes this sniff, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int $stackPtr The position of the current token in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $tokenContent = null;
        if ($tokens[$stackPtr]['code'] === T_OPEN_TAG) {
            //Check for start of file whitespace.
            // If its the first token, then there is no space.
            if ($stackPtr === 0) {
                return;
            }

            for ($i = $stackPtr - 1; $i >= 0; --$i) {
                // If we find something that isn't inline html then there is something previous in the file.
                // If we have ended up with inline html make sure it isn't just whitespace.
                if ($tokens[$i]['type'] !== 'T_INLINE_HTML' || trim($tokens[$i]['content']) !== '') {
                    return;
                }
            }

            $phpcsFile->addError('Additional whitespace found at start of file', $stackPtr, 'StartFile');
        } elseif (in_array($tokens[$stackPtr]['code'], PHP_CodeSniffer_Tokens::$scopeOpeners)
                && array_key_exists('scope_opener', $tokens[$stackPtr])
            ) {
            $classOpen = $tokens[$stackPtr]['scope_opener'];
            $classClose = $tokens[$stackPtr]['scope_closer'];
            $structureType = strtolower(str_replace('T_', '', $tokens[$stackPtr]['type']));
            if ($tokens[$classOpen + 1]['content'] === $phpcsFile->eolChar && $tokens[$classOpen + 2]['content'] === $phpcsFile->eolChar) {
                $phpcsFile->addError("Blank line at beginning of {$structureType}", $classOpen + 2, 'EmptyLines');
            }

            if ($tokens[$classClose - 1]['content'] === $phpcsFile->eolChar && $tokens[$classClose - 2]['content'] === $phpcsFile->eolChar) {
                $phpcsFile->addError("Blank line at end of {$structureType}", $classClose - 1, 'EmptyLines');
            }
        } else {
            //Check for end of line whitespace.
            if (strpos($tokens[$stackPtr]['content'], $phpcsFile->eolChar) === false) {
                return;
            }

            $tokenContent = rtrim($tokens[$stackPtr]['content'], $phpcsFile->eolChar);
            if (empty($tokenContent) === false && preg_match('|^.*\s+$|', $tokenContent) !== 0) {
                $phpcsFile->addError('Whitespace found at end of line', $stackPtr, 'EndLine');
            }

            //Check for multiple blanks lines in a file.
            if ($stackPtr < 2
                || ($tokens[$stackPtr - 1]['line'] < $tokens[$stackPtr]['line'] && $tokens[$stackPtr - 2]['code'] !== T_WHITESPACE)) {
                // This is an empty line and the line before this one is not
                //  empty, so this could be the start of a multiple empty
                // line block.
                $next  = $phpcsFile->findNext(T_WHITESPACE, $stackPtr, null, true);
                if ($next === false) {
                    //The rest of the file is whitespace
                    $lines = $tokens[count($tokens) - 1]['line'] - $tokens[$stackPtr - 1]['line'];
                    if ($lines > 0) {
                        $phpcsFile->addError('Empty lines at end of file', $stackPtr, 'EmptyLines');
                    }
                } else {
                    $lines = $tokens[$next]['line'] - $tokens[$stackPtr]['line'];
                    if ($lines > 1) {
                        $phpcsFile->addError("Multiple empty lines in a row; found {$lines} empty lines", $stackPtr, 'EmptyLines');
                    }
                }
            }
        }
    }
}
