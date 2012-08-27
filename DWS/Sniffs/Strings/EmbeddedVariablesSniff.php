<?php
/**
 * Makes sure that all variables embedded in strings are enclosed in braces.
 *
 * @package DWS
 * @subpackage Sniffs
 */

/**
 * Makes sure that all variables embedded in strings are enclosed in braces.
 *
 * @package DWS
 * @subpackage Sniffs
 */
class DWS_Sniffs_Strings_EmbeddedVariablesSniff implements PHP_CodeSniffer_Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return array(T_CONSTANT_ENCAPSED_STRING, T_DOUBLE_QUOTED_STRING);
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

        // Make sure it's not a part of a string started in a previous line.
        // If it is, then we have already checked it.
        if ($workingString[0] !== '"') {
            return;
        }

        // The use of variables in double quoted strings is allowed.
        if ($tokens[$stackPtr]['code'] === T_DOUBLE_QUOTED_STRING) {
            $openBraces = 0;
            foreach (token_get_all("<?php {$workingString}") as $token) {
                if (is_array($token) === true) {
                    if ($token[0] == T_CURLY_OPEN) {
                        ++$openBraces;
                    } elseif ($token[0] == T_VARIABLE && $openBraces < 1) {
                        $phpcsFile->addError(
                            "String {$workingString} has a variable embedded without being delimited by braces",
                            $stackPtr,
                            'ContainsNonDelimitedVariable',
                            array($token[1])
                        );
                    }
                } elseif ($token == '}') {
                    --$openBraces;
                }
            }
        }
    }
}
