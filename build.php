#!/usr/bin/env php
<?php
chdir(__DIR__);

$returnStatus = null;
passthru('composer install --dev', $returnStatus);
if ($returnStatus !== 0) {
    exit(1);
}

passthru('./vendor/bin/phpcs --standard=' . __DIR__ . '/DWS --extensions=php -n tests DWS *.php', $returnStatus);
if ($returnStatus !== 0) {
    exit(1);
}

passthru('./vendor/bin/phpunit --coverage-clover clover.xml tests/DWS', $returnStatus);
if ($returnStatus !== 0) {
    exit(1);
}

$xml = new SimpleXMLElement(file_get_contents('clover.xml'));
foreach ($xml->xpath('//file/metrics') as $metric) {
    if ((int)$metric['elements'] !== (int)$metric['coveredelements']) {
        file_put_contents('php://stderr', "Code coverage was NOT 100% but we need to get there ASAP\n");
        exit(0);
    }
}

echo "Code coverage was 100%\n";
