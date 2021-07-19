<?php


namespace Crochetfeve0251\GoogleAnalyticsPhp\GA\Entities;


use Crochetfeve0251\GoogleAnalyticsPhp\GA\Entities\Exceptions\InvalidState;

class Transaction
{
    protected $type;
    protected $id;
    protected $affiliation;
    protected $revenue;
    protected $shipping;
    protected $tax;
    protected $currency;

    /**
     * Transaction constructor.
     * @param $type
     * @param $id
     * @param $affiliation
     * @param $revenue
     * @param $shipping
     * @param $tax
     * @param $currency
     */
    public function __construct(string $id = '', string $affiliation = '', string $revenue = '', string $shipping = '', string $tax = '', string $currency = '')
    {
        $this->type = 'transaction';
        $this->id = $id;
        $this->affiliation = $affiliation;
        $this->revenue = $revenue;
        $this->shipping = $shipping;
        $this->tax = $tax;
        $this->currency = $currency;
    }

    public function render(int $index = 1): array {
        $result = [];
        $params = [
          't' => $this->type,
          'ti' => $this->id,
          'ta' => $this->affiliation,
          'tr' => $this->revenue,
          'ts' => $this->shipping,
          'tt' => $this->tax,
          'tc' => $this->currency,
        ];
        foreach ($params as $key => $param) {
            $result = self::addToParams($result, $key, $param);
        }
        if(count($result) === 1)
            throw new InvalidState();
        return $result;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
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
    public function getAffiliation()
    {
        return $this->affiliation;
    }

    /**
     * @param mixed $affiliation
     */
    public function setAffiliation($affiliation)
    {
        $this->affiliation = $affiliation;
    }

    /**
     * @return mixed
     */
    public function getRevenue()
    {
        return $this->revenue;
    }

    /**
     * @param mixed $revenue
     */
    public function setRevenue($revenue)
    {
        $this->revenue = $revenue;
    }

    /**
     * @return mixed
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * @param mixed $shipping
     */
    public function setShipping($shipping)
    {
        $this->shipping = $shipping;
    }

    /**
     * @return mixed
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * @param mixed $tax
     */
    public function setTax($tax)
    {
        $this->tax = $tax;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    protected static function addToParams($params, $key, $value): array {
        if($value === '')
            return $params;
        $params[$key] = $value;
        return $params;
    }


}