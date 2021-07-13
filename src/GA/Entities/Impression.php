<?php


namespace Crochetfeve0251\GoogleAnalyticsPhp\GA\Entities;


class Impression
{
    protected $name;
    protected $productsList = [];

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    public function addProduct(Product $product) {
        $this->productsList[] = $product;
    }

    public function removeProduct(int $index) {
        if(count($this->productsList) > $index) {
            unset($this->productsList[$index]);
            $this->productsList = array_filter($this->productsList);
        }
    }
}