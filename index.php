<?php
require_once 'vendor/autoload.php';
use Ozznest\Testapp\StringParser;
use Ozznest\Testapp\EuroCurrencyDetector;
use Ozznest\Testapp\Dto\BillingRow;
use GuzzleHttp\Client;

$serializer = JMS\Serializer\SerializerBuilder::create()->build();
$parser = new StringParser($serializer);

foreach (explode("\n", file_get_contents($argv[1])) as $row) {
    if (empty($row)) break;
    $inputRow  = $parser->parse($row);
    $alpha = getAlpha($inputRow->getBin());
    $isEu = EuroCurrencyDetector::isEuro($alpha);

    $rates = getRates();
    $rate = $rates[$inputRow->getCurrency()];

    if ($inputRow->isEuro() || $rate == 0) {
        $amntFixed = $inputRow->getAmount();
    }
    if (!$inputRow->isEuro() || $rate > 0) {
        $amntFixed = $inputRow->getAmount() / $rate;
    }
    echo $amntFixed * ($inputRow->getComission());
    print "\n";
}

function getRates(): array
{
    $client = new Client(['base_uri' => 'https://developers.paysera.com/tasks/api/currency-exchange-rates']);
    $curresncyJson = (string)$client->get('')->getBody();
    return @json_decode($curresncyJson, true)['rates'];
}

function getAlpha(int $binId): string
{
//    $binResults = file_get_contents('https://lookup.binlist.net/' . $binId);
//    $client =  new Client(['base_uri' => 'https://lookup.binlist.net/']);
//    $binResults = (string)$client->get($binId)->getBody();
    $binResults = '{"number":{},"scheme":"visa","type":"debit","brand":"Visa Classic","country":{"numeric":"440","alpha2":"LT","name":"Lithuania","emoji":"🇱🇹","currency":"EUR","latitude":56,"longitude":24},"bank":{"name":"Uab Finansines Paslaugos Contis"}}';
    if (!$binResults)
        die('error!');
    $serializer = JMS\Serializer\SerializerBuilder::create()->build();
    $r = $serializer->deserialize($binResults,BillingRow::class, 'json');
    return $r->getCountry()->getAlpha2();
}