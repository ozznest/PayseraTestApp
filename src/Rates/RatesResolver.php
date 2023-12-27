<?php

declare(strict_types=1);

namespace Ozznest\Testapp\Rates;

interface RatesResolver
{
    public function getRates(): array;

    public function getRateByAlpha(string $alpha): float;
}
