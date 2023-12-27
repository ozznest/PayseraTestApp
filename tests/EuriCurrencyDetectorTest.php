<?php

declare(strict_types=1);

use Ozznest\Testapp\EuroCurrencyDetector;
use PHPUnit\Framework\TestCase;

class EuriCurrencyDetectorTest extends TestCase
{
    public function testCurrencyDetection()
    {
        $this->assertEquals(EuroCurrencyDetector::isEuro('LT'), true);
        $this->assertEquals(EuroCurrencyDetector::isEuro('HR'), true);
        $this->assertEquals(EuroCurrencyDetector::isEuro('PO'), true);
        $this->assertEquals(EuroCurrencyDetector::isEuro('USD'), false);
    }
}
