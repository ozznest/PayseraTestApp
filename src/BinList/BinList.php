<?php

declare(strict_types=1);

namespace Ozznest\Testapp\BinList;

interface BinList
{
    public function getById(int $binId): string;
}
