<?php


namespace Crochetfeve0251\GoogleAnalyticsPhp\GA\Entities;


class Impression
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var Product[]
     */
    protected $productsList = [];

    /**
     * Impression constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function addProduct(Product $product): void {
        $this->productsList[] = $product;
    }

    public function removeProduct(int $index): void {
        if(count($this->productsList) > $index) {
            unset($this->productsList[$index]);
            $this->productsList = array_filter($this->productsList);
        }
    }



    public function render(int $index = 1): array {
        $i = 0;
        return array_reduce(/**
         * @param $carry
         * @param Product $product
         * @return string
         */ $this->productsList, function ($carry, $product) use (&$i, $index) {
            $product->setIndexList($index);
            $i ++;
            return array_merge($carry, $product->render($i));
        }, ["il{$index}nm" => $this->name]);
    }
}