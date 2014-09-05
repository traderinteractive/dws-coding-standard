<?php
/**
 * A test to ensure that multi-line bracketed expressions (arrays, function definitions, function calls, control structure conditions, etc.) are
 * indented correctly.
 *
 * @package DWS
 * @subpackage Sniffs
 */

/**
 * A test to ensure that multi-line bracketed expressions (arrays, function definitions, function calls, control structure conditions, etc.) are
 * indented correctly.
 *
 * @package DWS
 * @subpackage Sniffs
 */
final class DWS_Sniffs_Formatting_MultilineBracketedExpressionIndentSniff implements PHP_CodeSniffer_Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_OPEN_SQUARE_BRACKET, T_OPEN_SHORT_ARRAY, T_OPEN_PARENTHESIS];
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
        $bracketStart = DWS_Helpers_Bracket::bracketStart($phpcsFile, $stackPtr);
        $bracketEnd = DWS_Helpers_Bracket::bracketEnd($phpcsFile, $stackPtr);

        if ($tokens[$bracketStart]['line'] === $tokens[$bracketEnd]['line']) {
            return; // Single-line expressions don't have indentation to worry about.
        }

        $beginningIndent = DWS_Helpers_WhiteSpace::indentOfLine($phpcsFile, $bracketStart);

        if ($tokens[$bracketEnd]['column'] !== $beginningIndent) {
            $data = [$beginningIndent - 1, $tokens[$bracketEnd]['column'] - 1, $tokens[$bracketEnd]['content']];
            $phpcsFile->addError('Expected indentation of %s spaces, %s found for ending bracket "%s"', $bracketEnd, 'EndIndent', $data);
        }

        $nextToken = $phpcsFile->findNext(PHP_CodeSniffer_Tokens::$emptyTokens, $bracketStart + 1, $bracketEnd, true);
        if ($nextToken !== false && $tokens[$nextToken]['line'] === $tokens[$bracketStart]['line']) {
            $data = [$tokens[$bracketStart]['content']];
            $phpcsFile->addError('Expected first item after opening "%s" to be indented on a new line', $nextToken, 'OpeningIndent', $data);
        }

        $firstOnLine = $bracketStart + 1;
        for ($line = $tokens[$bracketStart]['line'] + 1; $line < $tokens[$bracketEnd]['line']; $line++) {
            while ($tokens[$firstOnLine]['line'] < $line || in_array($tokens[$firstOnLine]['code'], PHP_CodeSniffer_Tokens::$emptyTokens)) {
                if (array_key_exists('parenthesis_closer', $tokens[$firstOnLine])) {
                    $firstOnLine = $tokens[$firstOnLine]['parenthesis_closer'] + 1;
                    $line = $tokens[$firstOnLine]['line'];
                    continue 2;
                } elseif (array_key_exists('bracket_closer', $tokens[$firstOnLine])) {
                    $firstOnLine = $tokens[$firstOnLine]['bracket_closer'] + 1;
                    $line = $tokens[$firstOnLine]['line'];
                    continue 2;
                }

                $firstOnLine++;
            }

            if ($tokens[$firstOnLine]['line'] === $line && $tokens[$firstOnLine]['column'] !== $beginningIndent + 4) {
                $data = [$beginningIndent + 3, $tokens[$firstOnLine]['column'] - 1];
                $phpcsFile->addError('Expected indentation of %s spaces, %s found', $firstOnLine, 'MultiLineIndent', $data);
            }
        }
    }
}
