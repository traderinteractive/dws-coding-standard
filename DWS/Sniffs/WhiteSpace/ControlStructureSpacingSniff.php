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
class DWS_Sniffs_WhiteSpace_ControlStructureSpacingSniff extends Squiz_Sniffs_WhiteSpace_ControlStructureSpacingSniff
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
}
