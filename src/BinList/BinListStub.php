<?php

declare(strict_types=1);

namespace Ozznest\Testapp\BinList;

class BinListStub implements BinList
{
    private array $data = [
        '41417360' => '{"number":null,"country":{},"bank":{}}',
        '4745030' => '{"number":{},"scheme":"visa","type":"debit","brand":"Visa Classic","country":{"numeric":"440","alpha2":"LT","name":"Lithuania","emoji":"🇱🇹","currency":"EUR","latitude":56,"longitude":24},"bank":{"name":"Uab Finansines Paslaugos Contis"}}',
        '45717360' => '{"number":{},"scheme":"visa","type":"debit","brand":"Visa Classic","country":{"numeric":"208","alpha2":"DK","name":"Denmark","emoji":"🇩🇰","currency":"DKK","latitude":56,"longitude":10},"bank":{"name":"Jyske Bank A/S"}}',
        '516793' => '{"number":{},"scheme":"mastercard","type":"debit","brand":"Debit Mastercard Card","country":{"numeric":"440","alpha2":"LT","name":"Lithuania","emoji":"🇱🇹","currency":"EUR","latitude":56,"longitude":24},"bank":{"name":"Swedbank AB"}}',
        '45417360' => '{"number":{},"scheme":"visa","type":"credit","brand":"Visa Classic","country":{"numeric":"392","alpha2":"JP","name":"Japan","emoji":"🇯🇵","currency":"JPY","latitude":36,"longitude":138},"bank":{"name":"Credit Saison Co., Ltd."}}',
    ];
    public function getById(int $binId): string
    {
        if (isset($this->data[$binId])) {
            return $this->data[$binId];
        }
    }
}
