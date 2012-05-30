<?php
/**
 * Verifies that all variables are declared in the proper scope.
 *
 * PHP version 5
 *
 * @package DWS
 * @subpackage Sniffs
 */

/**
 * Verifies that all variables are declared in the proper scope.
 *
 * PHP version 5
 *
 * @package DWS
 * @subpackage Sniffs
 */
class DWS_Sniffs_Scope_VarScopeSniff extends PHP_CodeSniffer_Standards_AbstractVariableSniff
{
    private $_variableScopes;

    protected function processVariable(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $variableName = $tokens[$stackPtr]['content'];
        $scopeIdentifier = $phpcsFile->getFilename() . $variableName;
        $level = $tokens[$stackPtr]['level'];
        $functionToken = false;
        $functionIndex = $phpcsFile->findPrevious(T_FUNCTION, $stackPtr);
        $lastScopeOpen = $phpcsFile->findPrevious(PHP_CodeSniffer_Tokens::$scopeOpeners, $stackPtr);
        $isInFunction = $functionIndex !== false && $tokens[$functionIndex]['scope_closer'] > $stackPtr;

        //Inline scope openers do not increment the level value
        $scopeOpenDistance = $tokens[$stackPtr]['line'] - $tokens[$lastScopeOpen]['line'];
        if (
            in_array($tokens[$lastScopeOpen]['code'], PHP_CodeSniffer_Tokens::$scopeOpeners) &&
            (
                $tokens[$stackPtr]['line'] - $tokens[$lastScopeOpen]['line'] === 1 ||
                $tokens[$stackPtr]['line'] - $tokens[$lastScopeOpen]['line'] === 0//Include the variables in the condition
            ) &&
            $tokens[$stackPtr]['level'] === $tokens[$lastScopeOpen]['level']
           )
            $level++;
        $error;
        if ($isInFunction) {
            //Member variables are always ok
            if ($variableName === '$this')
                return;

            $scopeIdentifier .= $tokens[$functionIndex]['scope_condition'];

            //If this variable is well scoped store it
            if ($level <= $tokens[$functionIndex]['level'] + 1)
                $this->_variableScopes[$scopeIdentifier] = true;
            elseif (!isset($this->_variableScopes[$scopeIdentifier])) {
                $error = "Variable \"$variableName\" is in the wrong scope.";
                $phpcsFile->addError($error, $stackPtr, 'Found');
            }
        } else {
            //If this is the first time we've seen this variable in this file store the scope depth.
            if (!isset($this->_variableScopes[$scopeIdentifier]))
              $this->_variableScopes[$scopeIdentifier] = $level;
            //Verify that the variables we've seen are not appearing in higher scopes.
            elseif ($this->_variableScopes[$scopeIdentifier] > $level) {
                $error = "Variable \"$variableName\" is in the wrong scope.";
                $phpcsFile->addError($error, $stackPtr, 'Found');
            }
        }
    }

    protected function processMemberVar(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        //Do Nothing
    }

    protected function processVariableInString(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        //Do Nothing
    }
}
