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

    /**
     * Product constructor.
     * @param $id
     * @param $name
     * @param $category
     * @param $brand
     * @param $variant
     * @param $position
     */
    public function __construct($id, $name, $category, $brand, $variant, $position)
    {
        $this->id = $id;
        $this->name = $name;
        $this->category = $category;
        $this->brand = $brand;
        $this->variant = $variant;
        $this->position = $position;
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
}