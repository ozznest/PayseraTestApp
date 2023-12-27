<?php

declare(strict_types=1);

namespace Ozznest\Testapp\BinList;

class BinClientFactory
{
    public const STUB = 'stub';
    public static function create(string $name): BinList
    {
        if ($name === static::STUB) {
            return new BinListStub();
        }
        return new HttpBinList();
    }
}
