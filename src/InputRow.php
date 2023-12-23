<?php

namespace Ozznest\Testapp;

class InputRow
{
    private string $bin;

    private float $amount;

    private string $currency;

    public function __construct(array $arr)
    {
        $this->bin = (int)$arr['bin'];
        $this->currency = (string)$arr['currency'];
        $this->amount = (double)$arr['amount'];
    }

    public function getBin(): string
    {
        return $this->bin;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function isEuro(): bool
    {
        return $this->currency === 'EUR';
    }

    public function getComission(): float
    {
        return $this->isEuro() ? 0.01 : 0.02;
    }

}
