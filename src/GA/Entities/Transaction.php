<?php


namespace Crochetfeve0251\GoogleAnalyticsPhp\GA\Entities;


class Transaction
{
    protected $type;
    protected $id;
    protected $affiliation;
    protected $revenue;
    protected $shipping;
    protected $tax;
    protected $currency;


    protected function render(int $index = 0): string {
        $params = [
          't' => $this->type,
          'ti' => $this->id,
          'ta' => $this->affiliation,
          'tr' => $this->revenue,
          'ts' => $this->shipping,
          'tt' => $this->tax,
          'tc' => $this->currency,
        ];

        return array_reduce(array_keys($params), function ($carry, $key) use ($params) {
            return ($carry === '' ? '' : "$carry&") . "$key={$params[$key]}";
        }, '');
    }
}