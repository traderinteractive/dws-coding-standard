<?php
/**
 * Verifies that all functions are properly commented.
 *
 * @package DWS
 * @subpackage Sniffs
 */

/**
 * Verifies that all functions are properly commented.
 *
 * @package DWS
 * @subpackage Sniffs
 */
class DWS_Sniffs_Commenting_FunctionCommentSniff implements PHP_CodeSniffer_Sniff
{
    /**
     * The name of the method that we are currently processing.
     *
     * @var string
     */
    private $_methodName = '';

    /**
     * The position in the stack where the fucntion token was found.
     *
     * @var int
     */
    private $_functionToken = null;

    /**
     * The position in the stack where the class token was found.
     *
     * @var int
     */
    private $_classToken = null;

    /**
     * The function comment parser for the current method.
     *
     * @var PHP_CodeSniffer_Comment_Parser_FunctionCommentParser
     */
    protected $_commentParser = null;

    /**
     * The current PHP_CodeSniffer_File object we are processing.
     *
     * @var PHP_CodeSniffer_File
     */
    protected $_currentFile = null;

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return array(T_FUNCTION);
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token
     *                                        in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $find = array(
                 T_COMMENT,
                 T_DOC_COMMENT,
                 T_CLASS,
                 T_FUNCTION,
                 T_OPEN_TAG,
                );

        $commentEnd = $phpcsFile->findPrevious($find, ($stackPtr - 1));

        if ($commentEnd === false) {
            return;
        }

        $this->_currentFile = $phpcsFile;
        $tokens            = $phpcsFile->getTokens();

        // If the token that we found was a class or a function, then this
        // function has no doc comment.
        $code = $tokens[$commentEnd]['code'];

        if ($code === T_COMMENT) {
            $error = 'You must use "/**" style comments for a function comment';
            $phpcsFile->addError($error, $stackPtr, 'WrongStyle');
            return;
        } elseif ($code !== T_DOC_COMMENT) {
            $phpcsFile->addError('Missing function doc comment', $stackPtr, 'Missing');
            return;
        }

        // If there is any code between the function keyword and the doc block
        // then the doc block is not for us.
        $ignore    = PHP_CodeSniffer_Tokens::$scopeModifiers;
        $ignore[]  = T_STATIC;
        $ignore[]  = T_WHITESPACE;
        $ignore[]  = T_ABSTRACT;
        $ignore[]  = T_FINAL;
        $prevToken = $phpcsFile->findPrevious($ignore, ($stackPtr - 1), null, true);
        if ($prevToken !== $commentEnd) {
            $phpcsFile->addError('Missing function doc comment', $stackPtr, 'Missing');
            return;
        }

        $this->_functionToken = $stackPtr;

        $this->_classToken = null;
        foreach ($tokens[$stackPtr]['conditions'] as $condPtr => $condition) {
            if ($condition === T_CLASS || $condition === T_INTERFACE) {
                $this->_classToken = $condPtr;
                break;
            }
        }

        // If the first T_OPEN_TAG is right before the comment, it is probably
        // a file comment.
        $commentStart = ($phpcsFile->findPrevious(T_DOC_COMMENT, ($commentEnd - 1), null, true) + 1);
        $comment           = $phpcsFile->getTokensAsString($commentStart, ($commentEnd - $commentStart + 1));
        $this->_methodName = $phpcsFile->getDeclarationName($stackPtr);

        try {
            $this->_commentParser = new PHP_CodeSniffer_CommentParser_FunctionCommentParser($comment, $phpcsFile);
            $this->_commentParser->parse();
        } catch (PHP_CodeSniffer_CommentParser_ParserException $e) {
            $line = ($e->getLineWithinComment() + $commentStart);
            $phpcsFile->addError($e->getMessage(), $line, 'FailedParse');
            return;
        }

        $comment = $this->_commentParser->getComment();
        if (is_null($comment) === true) {
            $error = 'Function doc comment is empty';
            $phpcsFile->addError($error, $commentStart, 'Empty');
            return;
        }

        $this->processParams($commentStart);
        $this->processReturn($commentStart, $commentEnd);
        $this->processThrows($commentStart);

        // No extra newline before short description.
        $short        = $comment->getShortComment();
        $newlineCount = 0;
        $newlineSpan  = strspn($short, $phpcsFile->eolChar);
        if ($short !== '' && $newlineSpan > 0) {
            $error = 'Extra newline(s) found before function comment short description';
            $phpcsFile->addError($error, ($commentStart + 1), 'SpacingBeforeShort');
        }

        $newlineCount = (substr_count($short, $phpcsFile->eolChar) + 1);

        // Exactly one blank line between short and long description.
        $long = $comment->getLongComment();
        if (empty($long) === false) {
            $between        = $comment->getWhiteSpaceBetween();
            $newlineBetween = substr_count($between, $phpcsFile->eolChar);
            if ($newlineBetween !== 2) {
                $error = 'There must be exactly one blank line between descriptions in function comment';
                $phpcsFile->addError($error, ($commentStart + $newlineCount + 1), 'SpacingAfterShort');
            }

            $newlineCount += $newlineBetween;
        }

        // Exactly one blank line before tags.
        $params = $this->_commentParser->getTagOrders();
        if (count($params) > 1) {
            $newlineSpan = $comment->getNewlineAfter();
            if ($newlineSpan !== 2 && !in_array('see', $params)) {
                $error = 'There must be exactly one blank line before the tags in function comment';
                if ($long !== '') {
                    $newlineCount += (substr_count($long, $phpcsFile->eolChar) - $newlineSpan + 1);
                }

                $phpcsFile->addError($error, ($commentStart + $newlineCount), 'SpacingBeforeTags');
                $short = rtrim($short, $phpcsFile->eolChar.' ');
            }
        }

    }

    /**
     * Process any throw tags that this function comment has.
     *
     * @param int $commentStart The position in the stack where the
     *                          comment started.
     *
     * @return void
     */
    protected function processThrows($commentStart)
    {
        if (count($this->_commentParser->getThrows()) === 0) {
            return;
        }

        foreach ($this->_commentParser->getThrows() as $throw) {
            $exception = $throw->getValue();
            $errorPos  = ($commentStart + $throw->getLine());

            if ($exception === '') {
                $error = '@throws tag must contain the exception class name';
                $this->_currentFile->addError($error, $errorPos, 'EmptyThrows');
            }
        }

    }

    /**
     * Process the return comment of this function comment.
     *
     * @param int $commentStart The position in the stack where the comment started.
     * @param int $commentEnd   The position in the stack where the comment ended.
     *
     * @return void
     */
    protected function processReturn($commentStart, $commentEnd)
    {
        // Skip constructor and destructor.
        $className = '';
        if ($this->_classToken !== null) {
            $className = $this->_currentFile->getDeclarationName($this->_classToken);
            $className = strtolower(ltrim($className, '_'));
        }

        $methodName      = strtolower(ltrim($this->_methodName, '_'));
        $isSpecialMethod = ($this->_methodName === '__construct' || $this->_methodName === '__destruct');

        if ($isSpecialMethod === false && $methodName !== $className) {
            // Report missing return tag.
            if (in_array('see', $this->_commentParser->getTagOrders())) {
                return;
            } elseif ($this->_commentParser->getReturn() === null) {
                $error = 'Missing @return tag in function comment';
                $this->_currentFile->addError($error, $commentEnd, 'MissingReturn');
            } elseif (trim($this->_commentParser->getReturn()->getRawContent()) === '') {
                $error    = '@return tag is empty in function comment';
                $errorPos = ($commentStart + $this->_commentParser->getReturn()->getLine());
                $this->_currentFile->addError($error, $errorPos, 'EmptyReturn');
            }
        }

    }

    /**
     * Process the function parameter comments.
     *
     * @param int $commentStart The position in the stack where
     *                          the comment started.
     *
     * @return void
     */
    protected function processParams($commentStart)
    {
        $realParams = $this->_currentFile->getMethodParameters($this->_functionToken);

        $params      = $this->_commentParser->getParams();
        $foundParams = array();

        if (empty($params) === false) {
            $lastParm = (count($params) - 1);
            if (substr_count($params[$lastParm]->getWhitespaceAfter(), $this->_currentFile->eolChar) !== 2) {
                $error    = 'Last parameter comment requires a blank newline after it';
                $errorPos = ($params[$lastParm]->getLine() + $commentStart);
                $this->_currentFile->addError($error, $errorPos, 'SpacingAfterParams');
            }

            // Parameters must appear immediately after the comment.
            if ($params[0]->getOrder() !== 2) {
                $error    = 'Parameters must appear immediately after the comment';
                $errorPos = ($params[0]->getLine() + $commentStart);
                $this->_currentFile->addError($error, $errorPos, 'SpacingBeforeParams');
            }

            $previousParam      = null;
            $spaceBeforeVar     = 10000;
            $spaceBeforeComment = 10000;
            $longestType        = 0;
            $longestVar         = 0;

            foreach ($params as $param) {
                $paramComment = trim($param->getComment());
                $errorPos     = ($param->getLine() + $commentStart);

                // Make sure that there is only one space before the var type.
                if ($param->getWhitespaceBeforeType() !== ' ') {
                    $error = 'Expected 1 space before variable type';
                    $this->_currentFile->addError($error, $errorPos, 'SpacingBeforeParamType');
                }

                $spaceCount = substr_count($param->getWhitespaceBeforeVarName(), ' ');
                if ($spaceCount < $spaceBeforeVar) {
                    $spaceBeforeVar = $spaceCount;
                    $longestType    = $errorPos;
                }

                $spaceCount = substr_count($param->getWhitespaceBeforeComment(), ' ');

                if ($spaceCount < $spaceBeforeComment && $paramComment !== '') {
                    $spaceBeforeComment = $spaceCount;
                    $longestVar         = $errorPos;
                }

                // Make sure they are in the correct order,
                // and have the correct name.
                $pos = $param->getPosition();

                $paramName = ($param->getVarName() !== '') ? $param->getVarName() : '[ UNKNOWN ]';

                // Make sure the names of the parameter comment matches the
                // actual parameter.
                if (isset($realParams[($pos - 1)]) === true) {
                    $realName      = $realParams[($pos - 1)]['name'];
                    $foundParams[] = $realName;

                    // Append ampersand to name if passing by reference.
                    if ($realParams[($pos - 1)]['pass_by_reference'] === true) {
                        $realName = '&'.$realName;
                    }

                    if ($realName !== $paramName) {
                        $code = 'ParamNameNoMatch';
                        $data = array(
                                    $paramName,
                                    $realName,
                                    $pos,
                                );

                        $error  = 'Doc comment for var %s does not match ';
                        if (strtolower($paramName) === strtolower($realName)) {
                            $error .= 'case of ';
                            $code   = 'ParamNameNoCaseMatch';
                        }

                        $error .= 'actual variable name %s at position %s';

                        $this->_currentFile->addError($error, $errorPos, $code, $data);
                    }
                } else {
                    // We must have an extra parameter comment.
                    $error = 'Superfluous doc comment at position '.$pos;
                    $this->_currentFile->addError($error, $errorPos, 'ExtraParamComment');
                }

                if ($param->getVarName() === '') {
                    $error = 'Missing parameter name at position '.$pos;
                     $this->_currentFile->addError($error, $errorPos, 'MissingParamName');
                }

                if ($param->getType() === '') {
                    $error = 'Missing type at position '.$pos;
                    $this->_currentFile->addError($error, $errorPos, 'MissingParamType');
                }

                if ($paramComment === '') {
                    $error = 'Missing comment for param "%s" at position %s';
                    $data  = array(
                              $paramName,
                              $pos,
                             );
                    $this->_currentFile->addError($error, $errorPos, 'MissingParamComment', $data);
                }

                $previousParam = $param;
            }

            if ($spaceBeforeVar !== 1 && $spaceBeforeVar !== 10000 && $spaceBeforeComment !== 10000) {
                $error = 'Expected 1 space after the longest type';
                $this->_currentFile->addError($error, $longestType, 'SpacingAfterLongType');
            }

            if ($spaceBeforeComment !== 1 && $spaceBeforeComment !== 10000) {
                $error = 'Expected 1 space after the longest variable name';
                $this->_currentFile->addError($error, $longestVar, 'SpacingAfterLongName');
            }
        }

        $realNames = array();
        foreach ($realParams as $realParam) {
            $realNames[] = $realParam['name'];
        }

        // Report and missing comments.
        $diff = array_diff($realNames, $foundParams);
        if (!in_array('see', $this->_commentParser->getTagOrders())) {
            foreach ($diff as $neededParam) {
                if (count($params) !== 0) {
                    $errorPos = ($params[(count($params) - 1)]->getLine() + $commentStart);
                } else {
                    $errorPos = $commentStart;
                }

                $error = 'Doc comment for "%s" missing';
                $data  = array($neededParam);
                $this->_currentFile->addError($error, $errorPos, 'MissingParamTag', $data);
            }
        }
    }
}