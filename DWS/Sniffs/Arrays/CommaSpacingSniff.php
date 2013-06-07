<?php
/**
 * A test to ensure that commas in arrays are set with proper whitespace.
 *
 * @package DWS
 * @subpackage Sniffs
 */

/**
 * A test to ensure that commas in arrays are set with proper whitespace.
 *
 * @package DWS
 * @subpackage Sniffs
 */
final class DWS_Sniffs_Arrays_CommaSpacingSniff implements PHP_CodeSniffer_Sniff
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
        $arrayStart = DWS_Helpers_Bracket::bracketStart($phpcsFile, $stackPtr);
        $arrayEnd = DWS_Helpers_Bracket::bracketEnd($phpcsFile, $stackPtr);

        $isSingleLine = $tokens[$arrayStart]['line'] === $tokens[$arrayEnd]['line'];

        foreach (DWS_Helpers_Array::commaPositions($phpcsFile, $arrayStart) as $comma) {
            if ($tokens[$comma - 1]['code'] === T_WHITESPACE) {
                $phpcsFile->addError('No whitespace allowed before commas in an array', $comma, 'SpaceBeforeComma');
            }

            if ($isSingleLine) {
                if ($tokens[$comma + 1]['content'] !== ' ') {
                    $phpcsFile->addError('Expected 1 space after comma in single-line array', $comma, 'SingleLineSpaceAfterComma');
                }
            } elseif ($tokens[$comma + 1]['content'][0] !== "\n") {
                $nextMember = $phpcsFile->findNext(array(T_WHITESPACE, T_COMMENT), $comma + 1, $arrayEnd, true);
                if ($nextMember !== false && $tokens[$nextMember]['line'] === $tokens[$comma]['line']) {
                    $phpcsFile->addError('Comma in multi-line array was not last token on line', $comma, 'MultiLineNewlineAfterComma');
                }
            }
        }
    }
}
