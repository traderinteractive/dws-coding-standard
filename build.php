#!/usr/bin/env php
<?php
$returnStatus = null;
passthru('composer install --dev', $returnStatus);
if ($returnStatus !== 0) {
    exit(1);
}

passthru('./vendor/bin/phpcs --standard=' . __DIR__ . '/DWS --extensions=php -n tests DWS', $returnStatus);
if ($returnStatus !== 0) {
    exit(1);
}

passthru('./vendor/bin/phpunit --coverage-clover clover.xml --configuration phpunit.xml tests/DWS', $returnStatus);
if ($returnStatus !== 0) {
    exit(1);
}

$xml = new SimpleXMLElement(file_get_contents('clover.xml'));
foreach ($xml->xpath('//metrics') as $metric) {
    if ((int)$metric['elements'] !== (int)$metric['coveredelements']) {
        file_put_contents('php://stderr', "Code coverage was NOT 100%\n");
        // exit(1); TODO: Get code coverage to 100%
    }
}

echo "Code coverage was 100%\n";
