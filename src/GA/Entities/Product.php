<?php


namespace Crochetfeve0251\GoogleAnalyticsPhp\GA\Entities;


class Product
{
    protected $id;
    protected $name;
    protected $category;
    protected $brand;
    protected $variant;
    protected $position;
    protected $indexList;
    protected $customDimension;

    /**
     * Product constructor.
     * @param $id
     * @param $name
     * @param $category
     * @param $brand
     * @param $variant
     * @param $position
     */
    public function __construct($id, $name, $category, $brand, $variant, $position, $customDimension)
    {
        $this->id = $id;
        $this->name = $name;
        $this->category = $category;
        $this->brand = $brand;
        $this->variant = $variant;
        $this->position = $position;
        $this->customDimension = $customDimension;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

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

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return mixed
     */
    public function getVariant()
    {
        return $this->variant;
    }

    /**
     * @param mixed $variant
     */
    public function setVariant($variant)
    {
        $this->variant = $variant;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return mixed
     */
    public function getIndexList()
    {
        return $this->indexList;
    }

    /**
     * @param mixed $indexList
     */
    public function setIndexList($indexList)
    {
        $this->indexList = $indexList;
    }

    /**
     * @return mixed
     */
    public function getCustomDimension()
    {
        return $this->customDimension;
    }

    /**
     * @param mixed $customDimension
     */
    public function setCustomDimension($customDimension)
    {
        $this->customDimension = $customDimension;
    }

    public function render(int $index = 0): string {
        $params = [
            "il{$this->indexList}pi{$index}id" => $this->id,
            "il{$this->indexList}pi{$index}nm" => $this->name,
            "il{$this->indexList}pi{$index}ca" => $this->category,
            "il{$this->indexList}pi{$index}br" => $this->brand,
            "il{$this->indexList}pi{$index}va" => $this->variant,
            "il{$this->indexList}pi{$index}ps" => $this->position,
            "il{$this->indexList}pi{$index}cd1" => $this->customDimension,
        ];
        return array_reduce(array_keys($params), function($carry, $key) use ($params) {
            return ($carry === "") ? '' : "$carry&" . "$key={$params[$key]}";
        }, '');
    }
}