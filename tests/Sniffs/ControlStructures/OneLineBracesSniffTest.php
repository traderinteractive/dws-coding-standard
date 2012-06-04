<?php
require_once 'PHP/CodeSniffer.php';
require_once __DIR__ . '/../../SniffTestCase.php';

class DWS_Sniffs_ControlStructures_OneLineBracesSniff_Test extends SniffTestCase
{
    private $_singleLineIfBraces;

    private $_singleLineIfNoBraces;

    public function setUp()
    {
        parent::setUp(array('DWS_Sniffs_ControlStructures_OneLineBracesSniff'));
        $this->_singleLineIfBraces = <<< 'NOWDOC'
<?php
if ($value === true) {
    echo 3;
}
NOWDOC;
        $this->_singleLineIfNoBraces = <<< 'NOWDOC'
<?php
if ($value === true)
    echo 3;
NOWDOC;
    }

    public function testSingleLineIfBraces()
    {
        $this->_phpcs->processFile('SingleLineIfBraces', $this->_singleLineIfBraces);

        $this->assertErrorMessages('Braces should not be used for this control structure.');
    }

    public function testSingleLineIfNoBraces()
    {
        $this->_phpcs->processFile('SingleLineIfNoBraces', $this->_singleLineIfNoBraces);

        $this->assertNoErrors('SingleLineIfNoBraces');
    }
}
