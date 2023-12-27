<?php

declare(strict_types=1);

namespace Ozznest\Testapp\Rates;

use GuzzleHttp\Client;

class HttpRatesResolver implements RatesResolver
{
    private array $rates = [];
    public function __construct()
    {
        $client = new Client(['base_uri' => 'https://developers.paysera.com/tasks/api/currency-exchange-rates']);
        $currencyRates = (string)$client->get('')->getBody();
        $this->rates = @json_decode($currencyRates, true)['rates'];
    }

    public function getRates(): array
    {
        return $this->rates;
    }

    public function getRateByAlpha(string $alpha): float
    {
        return $this->rates[$alpha];
    }
}
