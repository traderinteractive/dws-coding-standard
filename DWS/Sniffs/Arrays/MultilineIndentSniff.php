<?php
/**
 * A test to ensure that multi-line arrays are indented correctly.
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
final class DWS_Sniffs_Arrays_MultilineIndentSniff implements PHP_CodeSniffer_Sniff
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

        if ($tokens[$arrayStart]['line'] === $tokens[$arrayEnd]['line']) {
            return; // Single-line arrays don't have indentation to worry about.
        }

        $beginningIndent = DWS_Helpers_WhiteSpace::indentOfLine($phpcsFile, $arrayStart);

        if ($tokens[$arrayEnd]['column'] !== $beginningIndent) {
            $phpcsFile->addError('Closing bracket for array not at same indentation as beginning line of array.', $arrayEnd, 'EndIndent');
        }

        $lastLine = $tokens[$arrayStart]['line'];

        $commas = DWS_Helpers_Array::commaPositions($phpcsFile, $arrayStart);
        $commas[] = $arrayStart;
        foreach ($commas as $comma) {
            $nextMember = $phpcsFile->findNext(array(T_WHITESPACE, T_COMMENT), $comma + 1, $arrayEnd, true);
            if (in_array($nextMember, array(false, $arrayEnd))) {
                continue; // Already checked the end of the array above, and false shouldn't happen (except in invalid code).
            }

            $indent = DWS_Helpers_WhiteSpace::indentOfLine($phpcsFile, $nextMember);
            if ($indent !== $beginningIndent + 4) {
                $data = array($beginningIndent + 3, $indent - 1);
                $phpcsFile->addError('Expected indentation of %s spaces, %s found', $nextMember, 'MultiLineIndent', $data);
            }
        }
    }
}
