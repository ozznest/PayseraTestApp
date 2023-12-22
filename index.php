<?php
require_once 'vendor/autoload.php';
use Ozznest\Testapp\StringParser;
use Ozznest\Testapp\EuroCurrencyDetector;
use Ozznest\Testapp\Dto\BillingRow;
use GuzzleHttp\Client;
$parser = new StringParser();
$serializer = JMS\Serializer\SerializerBuilder::create()->build();

//$billingData = '{"number":{},"scheme":"visa","type":"debit","brand":"Visa Classic","country":{"numeric":"208","alpha2":"DK","name":"Denmark","emoji":"🇩🇰","currency":"DKK","latitude":56,"longitude":10},"bank":{"name":"Jyske Bank A/S"}}';

/* @var $deserialized BillingRow */
//var_dump($deserialized->getCountry()->getAlpha2());

$clientBilling = new Client([
    'base_uri'  => 'https://lookup.binlist.net/'
]);

$clientExchange = new Client([
    'base_uri'  => 'https://developers.paysera.com/tasks/api/currency-exchange-rates'
]);
//api key: m5xzHIhwCAdqulm4KNs3Pq9ham3LnpOd
foreach (explode("\n", file_get_contents($argv[1])) as $row) {
    if (empty($row)) break;
    $InputRow = $parser->parse($row);
    try{
        $response  = $clientBilling->get($InputRow->getBin())->getBody();
        $deserialized = $serializer->deserialize($response, BillingRow::class, 'json');
        echo "\n" . $deserialized->getCountry()->getAlpha2() . "\n";
        $isEU =  EuroCurrencyDetector::isEuro($deserialized->getCountry()->getAlpha2());
        echo $deserialized->getCountry()->getAlpha2();
    }catch (\GuzzleHttp\Exception\ClientException $e){
        echo $e->getMessage() . "\n";
    }
}
exit();
echo (string)$response->getBody();
exit();
foreach (explode("\n", file_get_contents($argv[1])) as $row) {

    if (empty($row)) break;
    $InputRow = $parser->parse($row);
    $binResults = file_get_contents('https://lookup.binlist.net/' . $InputRow->getBin());
    if (!$binResults)
        die('error!');
    $r = json_decode($binResults);
    $isEu = EuroCurrencyDetector::isEuro($r->country->alpha2);

    $content = @json_decode(file_get_contents('https://api.exchangeratesapi.io/latest'), true);
    $rate = @json_decode(file_get_contents('https://api.exchangeratesapi.io/latest'), true)['rates'][$InputRow->getCurrency()];
    if ($InputRow->isEuro() or $rate == 0) {
        $amntFixed = $InputRow->getAmount();

    }
    if (!$InputRow->isEuro() or $rate > 0) {
        $amntFixed = $InputRow->getAmount() / $rate;
    }

    echo $amntFixed * ($isEu == 'yes' ? 0.01 : 0.02);
    print "\n";
}