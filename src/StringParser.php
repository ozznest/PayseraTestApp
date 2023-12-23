<?php

namespace Ozznest\Testapp;

use JMS\Serializer\Serializer;

class StringParser
{
    public function __construct(private Serializer $serializer)
    {

    }

    public function parse(string $json): InputRow
    {
       return $this->serializer->deserialize($json, InputRow::class,'json');
    }
}