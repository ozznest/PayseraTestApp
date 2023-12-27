<?php

declare(strict_types=1);

namespace Ozznest\Testapp\BinList;

use GuzzleHttp\Client;

class HttpBinList implements BinList
{
    private Client $binHttpClient;
    public function __construct()
    {
        $this->binHttpClient = new Client(['base_uri' => 'https://lookup.binlist.net/']);
    }

    public function getById(int $binId): string
    {
        return  (string) $this->binHttpClient->get($binId)?->getBody();
    }
}
