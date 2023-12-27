<?php

declare(strict_types=1);

namespace Ozznest\Testapp\Rates;

class RatesClientFactory
{
    public const STUB = 'stub';

    public static function create(string $name)
    {
        if ($name === static::STUB) {
            return new StubRatesResolver();
        }
        return new HttpRatesResolver();
    }
}
