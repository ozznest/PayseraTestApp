<?php

declare(strict_types=1);

namespace Ozznest\Testapp;

use JMS\Serializer\Serializer;
use Ozznest\Testapp\Commision\CommisionResolver;
use Ozznest\Testapp\Rates\RatesResolver;

class AmountCalculator
{
    public function __construct(
        private AlphaResolver $alphaResolver,
        private RatesResolver $ratesResolver,
        private StringParser $stringParser
    ) {
    }

    public function calculate(string $row): float
    {
        $inputRow  = $this->stringParser->parse($row);
        try {
            $alpha = $this->alphaResolver->resolveAlphaName((int)$inputRow->getBin());
        } catch (\Exception) {
            $alpha = 'LT';
        }
        $rate = $this->ratesResolver->getRateByAlpha($inputRow->getCurrency());
        if ($inputRow->isEuro() || $rate == 0) {
            $amntFixed = $inputRow->getAmount();
        }
        if (!$inputRow->isEuro() || $rate > 0) {
            $amntFixed = $inputRow->getAmount() / $rate;
        }
        $commision = CommisionResolver::getComission($alpha);
        return $amntFixed * $commision;
    }
}
