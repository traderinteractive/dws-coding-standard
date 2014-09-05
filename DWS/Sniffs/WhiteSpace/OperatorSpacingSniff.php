<?php
/**
 * Verifies that there is one space around operators.
 *
 * @package DWS
 * @subpackage Sniffs
 */

/**
 * Verifies that there is one space around operators.
 *
 * @package DWS
 * @subpackage Sniffs
 */
final class DWS_Sniffs_WhiteSpace_OperatorSpacingSniff implements PHP_CodeSniffer_Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return array_unique(
            array_merge(
                PHP_CodeSniffer_Tokens::$comparisonTokens,
                PHP_CodeSniffer_Tokens::$operators,
                PHP_CodeSniffer_Tokens::$assignmentTokens,
                PHP_CodeSniffer_Tokens::$booleanOperators,
                [T_INLINE_THEN, T_INLINE_ELSE, T_BOOLEAN_NOT, T_STRING_CONCAT]
            )
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
        $operator = $tokens[$stackPtr]['content'];
        $previousToken = $tokens[$stackPtr - 1];
        $nextToken = $tokens[$stackPtr + 1];

        $previousSpaces = $previousToken['code'] === T_WHITESPACE ? strlen($previousToken['content']) : 0;
        $nextSpaces = $nextToken['code'] === T_WHITESPACE ? strlen($nextToken['content']) : 0;

        $previousNonEmpty = $phpcsFile->findPrevious(T_WHITESPACE, $stackPtr - 1, null, true);
        $previousSplitsLine = $tokens[$previousNonEmpty]['line'] !== $tokens[$stackPtr]['line'];

        $nextNonEmpty = $phpcsFile->findNext(T_WHITESPACE, $stackPtr + 1, null, true);
        $nextSplitsLine = $tokens[$nextNonEmpty]['line'] !== $tokens[$stackPtr]['line'];

        if (DWS_Helpers_Operator::isUnary($phpcsFile, $stackPtr)) {
            if (
                !$previousSplitsLine &&
                $previousSpaces !== 1 &&
                !in_array($tokens[$previousNonEmpty]['code'], [T_OPEN_PARENTHESIS, T_OPEN_SQUARE_BRACKET, T_OPEN_SHORT_ARRAY])
            ) {
                $phpcsFile->addError('Expected 1 space before "%s"; %s found', $stackPtr, 'SpacingBefore', [$operator, $previousSpaces]);
            }

            if ($nextSpaces !== 0) {
                $phpcsFile->addError('Expected 0 spaces after "%s"; %s found', $stackPtr, 'SpacingAfterUnary', [$operator, $nextSpaces]);
            }
        } else {
            if ($tokens[$stackPtr]['code'] === T_INLINE_ELSE && $tokens[$previousNonEmpty]['code'] === T_INLINE_THEN) {
                if ($previousSpaces !== 0) {
                    $phpcsFile->addError('Expected 0 spaces inside "?:"; %s found', $stackPtr, 'SpacingInTernary', [$previousSpaces]);
                }
            } elseif (!$previousSplitsLine && $previousSpaces !== 1) {
                $phpcsFile->addError('Expected 1 space before "%s"; %s found', $stackPtr, 'SpacingBefore', [$operator, $previousSpaces]);
            }

            $isTernaryShortcut = $tokens[$stackPtr]['code'] === T_INLINE_THEN && $tokens[$nextNonEmpty]['code'] === T_INLINE_ELSE;
            if (!$isTernaryShortcut && !$nextSplitsLine && $nextSpaces !== 1) {
                $phpcsFile->addError('Expected 1 space after "%s"; %s found', $stackPtr, 'SpacingAfter', [$operator, $nextSpaces]);
            }
        }
    }
}
