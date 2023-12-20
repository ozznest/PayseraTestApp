<?php

namespace Ozznest\Testapp;

class InputRow
{
    private int $bin;

    private float $amount;

    private string $currency;

    public function __construct(array $arr)
    {
        $this->bin = (int)$arr['bin'];
        $this->currency = (string)$arr['currency'];
        $this->amount = (double)$arr['amount'];
    }

    public function getBin(): int
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

}
