<?php

namespace Ozznest\Testapp\Dto;

class BillingRow
{

    private Country $country;

    public function getCountry(): Country
    {
        return $this->country;
    }


}