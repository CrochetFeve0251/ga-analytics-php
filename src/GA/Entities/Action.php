<?php


namespace Crochetfeve0251\GoogleAnalyticsPhp\GA\Entities;


use Crochetfeve0251\GoogleAnalyticsPhp\GA\Entities\Exceptions\InvalidState;

class Action
{
    protected $name;
    protected $id;
    protected $category;
    protected $brand;
    protected $variant;
    protected $position;

    /**
     * ProductAction constructor.
     * @param string $name
     * @param string $id
     * @param string $category
     * @param string $brand
     * @param string $variant
     * @param string $position
     */
    public function __construct(string $name = '', string $id = '', string $category = '', string $brand = '', string $variant = '', string $position = '')
    {
        $this->name = $name;
        $this->id = $id;
        $this->category = $category;
        $this->brand = $brand;
        $this->variant = $variant;
        $this->position = $position;
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

    public function render(int $index = 1): array {
        $result = [];
        $params = [
            "pr{$index}id" => $this->id,
            "pr{$index}nm" => $this->name,
            "pr{$index}ca" => $this->category,
            "pr{$index}br" => $this->brand,
            "pr{$index}va" => $this->variant,
            "pr{$index}ps" => $this->position,
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