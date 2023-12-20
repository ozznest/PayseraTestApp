<?php

namespace Ozznest\Testapp;

class StringParser
{
    public function parse(string $json): InputRow
    {
        $array = \json_decode($json, true);
        return new InputRow($array);
    }
}