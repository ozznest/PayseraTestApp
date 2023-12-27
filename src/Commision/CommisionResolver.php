<?php

declare(strict_types=1);

namespace Ozznest\Testapp\Commision;

use Ozznest\Testapp\EuroCurrencyDetector;

class CommisionResolver
{
    public static function getComission(string $alpha): float
    {
        return EuroCurrencyDetector::isEuro($alpha) ? 0.01 : 0.02;
    }
}
