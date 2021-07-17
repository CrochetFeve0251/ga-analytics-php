<?php


namespace Crochetfeve0251\GoogleAnalyticsPhp\GA\Entities;


use Crochetfeve0251\GoogleAnalyticsPhp\GA\Entities\Exceptions\InvalidState;

class Product
{
    protected $id;
    protected $name;
    protected $category;
    protected $brand;
    protected $variant;
    protected $position;
    protected $indexList = 1;
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
    public function __construct(string $id = '', string $name = '', string $category = '', string $brand = '', string $variant = '', string $position = '', string $customDimension = '')
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

    public function render(int $index = 1): array {
        $result = [];
        $params = [
            "il{$this->indexList}pi{$index}id" => $this->id,
            "il{$this->indexList}pi{$index}nm" => $this->name,
            "il{$this->indexList}pi{$index}ca" => $this->category,
            "il{$this->indexList}pi{$index}br" => $this->brand,
            "il{$this->indexList}pi{$index}va" => $this->variant,
            "il{$this->indexList}pi{$index}ps" => $this->position,
            "il{$this->indexList}pi{$index}cd1" => $this->customDimension,
        ];
        foreach ($params as $key => $param) {
            $result = self::addToParams($result, $key, $param);
        }
        if(count($result) === 0)
            throw new InvalidState();
        return $result;
    }

    protected static function addToParams($params, $key, $value): array {
        if($value === '')
            return $params;
        $params[$key] = $value;
        return $params;
    }
}