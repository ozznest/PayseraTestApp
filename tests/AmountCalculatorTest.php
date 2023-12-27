<?php

use PHPUnit\Framework\TestCase;
use Ozznest\Testapp\AmountCalculator;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\MockObject\MockType;
use Ozznest\Testapp\AlphaResolver;
use Ozznest\Testapp\Rates\RatesResolver;
use Ozznest\Testapp\StringParser;
use Ozznest\Testapp\InputRow;

class AmountCalculatorTest extends TestCase
{
    protected SerializerInterface | MockType $serializerMock;
    protected AlphaResolver | MockType $alphaResolverMock;
    protected RatesResolver | MockType $ratesResolverMock;

    protected StringParser | MockType $stringParser;
    protected function setUp(): void
    {
        $this->serializerMock = $this->createMock(SerializerInterface::class);
        $this->alphaResolverMock  = $this->createMock(AlphaResolver::class);
        $this->ratesResolverMock = $this->createMock(RatesResolver::class);
        $this->stringParser = $this->createMock(StringParser::class);
        parent::setUp();
    }

    public function testSimple()
    {
        $this->alphaResolverMock->expects(self::once())->method('resolveAlphaName')->willReturn('USD');
        $this->ratesResolverMock->expects(self::once())->method('getRateByAlpha')->with('USD')->willReturn(1.12);

        $amountCalculator = new AmountCalculator(
            $this->alphaResolverMock,
            $this->ratesResolverMock,
            $this->stringParser
        );
        $inputRow = new InputRow(['bin' => 41417360, 'currency' => 'USD', 'amount' => 130.00 ]);
        $this->stringParser->expects(self::once())->method('parse')->willReturn($inputRow);
        $result = $amountCalculator->calculate('{"bin":"41417360","amount":"130.00","currency":"USD"}');
        $expected = 130 / 1.12 * 0.02;
        $this->assertEquals($expected, $result);
    }
}
