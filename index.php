<?php
require_once 'vendor/autoload.php';

use Ozznest\Testapp\AlphaResolver;
use Ozznest\Testapp\AmountCalculator;
use JMS\Serializer\SerializerBuilder;
use Ozznest\Testapp\Rates\RatesClientFactory;
use Ozznest\Testapp\StringParser;

$serializer = SerializerBuilder::create()->build();
$alphaResolver = new AlphaResolver();
$ratesResolver = RatesClientFactory::create('stub');
$stringParser = new StringParser($serializer);
$amntCalculator = new AmountCalculator($alphaResolver, $ratesResolver, $stringParser);

foreach (explode("\n", file_get_contents($argv[1])) as $row) {
    if (empty($row)) {
        break;
    }
    echo $amntCalculator->calculate($row);
    print "\n";
}