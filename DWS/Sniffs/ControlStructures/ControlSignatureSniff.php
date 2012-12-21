<?php
/**
 * Verifies that control statements conform to their coding standards.
 *
 * @package DWS
 * @subpackage Sniffs
 */

/**
 * Verifies that control statements conform to their coding standards.
 *
 * @package DWS
 * @subpackage Sniffs
 */
class DWS_Sniffs_ControlStructures_ControlSignatureSniff extends PHP_CodeSniffer_Standards_AbstractPatternSniff
{
    /**
     * Initialze the parent AbstractPatternSniff to ignore comments
     */
    public function __construct()
    {
        parent::__construct(true);
    }

    /**
     * Returns the patterns that this test wishes to verify.
     *
     * @return array(string)
     */
    protected function getPatterns()
    {
        return array(
            'do {EOL...} while (...);EOL',
            'while (...) {EOL',
            'for (...) {EOL',
            'if (...) {EOL',
            'foreach (...) {EOL',
            '} elseif (...) {EOL',
            '} else {EOL',
            'try {EOL...} catch (...) {EOL',
        );
    }
}
