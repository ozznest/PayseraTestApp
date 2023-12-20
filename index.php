<?php
require_once 'vendor/autoload.php';

use Ozznest\Testapp\EuroCurrencyDetector;


foreach (explode("\n", file_get_contents($argv[1])) as $row) {

    if (empty($row)) break;

    $parsed = (new \Ozznest\Testapp\StringParser())->parse($row);

    $binResults = file_get_contents('https://lookup.binlist.net/' . $parsed->getBin());
    if (!$binResults)
        die('error!');
    $r = json_decode($binResults);
    $isEu = EuroCurrencyDetector::isEuro($r->country->alpha2);


    $rate = @json_decode(file_get_contents('https://api.exchangeratesapi.io/latest'), true)['rates'][$value[2]];
    if ($parsed->isEuro() || $rate == 0) {
        $amntFixed = $parsed->getAmount();
    }
    if (!$parsed->isEuro() || $rate > 0) {
        $amntFixed = $parsed->getAmount() / $rate;
    }

    echo $amntFixed * ($isEu ? 0.01 : 0.02);
    print "\n";
}