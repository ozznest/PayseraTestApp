<?php

namespace Ozznest\Testapp;

class EuroCurrencyDetector
{
    private static array $euroCurrencies = ['AT',
        'BE',
         'BG',
         'CY',
         'CZ',
         'DE',
         'DK',
         'EE',
        'ES',
        'FI',
        'FR',
        'GR',
        'HR',
        'HU',
        'IE',
        'IT',
        'LT',
        'LU',
        'LV',
        'MT',
        'NL',
        'PO',
        'PT',
        'RO',
        'SE',
        'SI',
        'SK'];

    public static function isEuro(string $currency): bool
    {
        if(in_array($currency, static::$euroCurrencies, true)){
            return true;
        }
        return false;
    }
}