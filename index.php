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

$client = new Client([
    'base_uri'  => 'https://lookup.binlist.net'
]);

foreach (explode("\n", file_get_contents($argv[1])) as $row) {
    if (empty($row)) break;
    $InputRow = $parser->parse($row);
    try{
        $response  = $client->get($InputRow->getBin())->getBody();
        $deserialized = $serializer->deserialize($response, BillingRow::class, 'json');
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
    $object = $serializer->deserialize($jsonData, \MyNamespace\MyObject::class, 'json');
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

function isEu($c) {
    $result = false;
    switch($c) {
        case 'AT':
        case 'BE':
        case 'BG':
        case 'CY':
        case 'CZ':
        case 'DE':
        case 'DK':
        case 'EE':
        case 'ES':
        case 'FI':
        case 'FR':
        case 'GR':
        case 'HR':
        case 'HU':
        case 'IE':
        case 'IT':
        case 'LT':
        case 'LU':
        case 'LV':
        case 'MT':
        case 'NL':
        case 'PO':
        case 'PT':
        case 'RO':
        case 'SE':
        case 'SI':
        case 'SK':
            $result = 'yes';
            return $result;
        default:
            $result = 'no';
    }
    return $result;
}