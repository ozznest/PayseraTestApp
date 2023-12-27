<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Ozznest\Testapp\Commision\CommisionResolver;

class CommisionResolverTest extends TestCase
{
    public function testCommisionPercent()
    {
        $this->assertEquals(0.02, CommisionResolver::getComission('USD'));
        $this->assertEquals(0.01, CommisionResolver::getComission('PT'));
        $this->assertEquals(0.01, CommisionResolver::getComission('FR'));
    }
}
