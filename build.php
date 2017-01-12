#!/usr/bin/env php
<?php
chdir(__DIR__);

$returnStatus = null;
passthru('composer install', $returnStatus);
if ($returnStatus !== 0) {
    exit(1);
}

require 'vendor/autoload.php';

passthru('./vendor/bin/phpcs --standard=' . __DIR__ . '/DWS --extensions=php -n tests DWS *.php', $returnStatus);
if ($returnStatus !== 0) {
    exit(1);
}

$phpunitConfiguration = PHPUnit_Util_Configuration::getInstance(__DIR__ . '/phpunit.xml');
$phpunitArguments = ['coverageHtml' => __DIR__ . '/coverage', 'configuration' => $phpunitConfiguration];
$testRunner = new PHPUnit_TextUI_TestRunner();
$result = $testRunner->doRun($phpunitConfiguration->getTestSuiteConfiguration(), $phpunitArguments, false);
if (!$result->wasSuccessful() || !$result->getCodeCoverage()) {
    exit(1);
}

$cloverCoverage = new \SebastianBergmann\CodeCoverage\Report\Clover();
file_put_contents('clover.xml', $cloverCoverage->process($result->getCodeCoverage()));

$coverageBuilder = new \SebastianBergmann\CodeCoverage\Node\Builder();
$coverageReport = $coverageBuilder->build($result->getCodeCoverage());
if ($coverageReport->getNumExecutedLines() !== $coverageReport->getNumExecutableLines()) {
    file_put_contents('php://stderr', "Code coverage was NOT 100%\n");
    exit(1);
}

echo "Code coverage was 100%\n";
