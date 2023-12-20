<?php

namespace Ozznest\Testapp\tests;

use Ozznest\Testapp\InputRow;
use PHPUnit\Framework\TestCase;

class TestInputRow extends TestCase
{

    public function testTest(): void
    {
        $arr = new InputRow([
            'bin'       => '4745030',
            'amount'    => '2000.00',
            'currency'  => 'GBP'
        ]);

        $this->assertEquals(4745030, $arr->getBin());
        $this->assertEquals(2000.00, $arr->getAmount());
        $this->assertEquals('GBP', $arr->getCurrency());
    }
}
