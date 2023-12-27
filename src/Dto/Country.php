<?php

namespace Ozznest\Testapp\Dto;

class Country
{
    private ?string $alpha2 = null;

    public function getAlpha2(): ?string
    {
        return $this->alpha2;
    }
}
