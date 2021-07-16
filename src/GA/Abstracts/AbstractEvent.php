<?php


namespace Crochetfeve0251\GoogleAnalyticsPhp\GA\Abstracts;


use Crochetfeve0251\GoogleAnalyticsPhp\GA\Entities\Impression;
use Crochetfeve0251\GoogleAnalyticsPhp\GA\Entities\Product;
use Crochetfeve0251\GoogleAnalyticsPhp\GA\Entities\ProductAction;
use Crochetfeve0251\GoogleAnalyticsPhp\GA\Entities\Transaction;
use Crochetfeve0251\GoogleAnalyticsPhp\HTTP\Request;
use Crochetfeve0251\GoogleAnalyticsPhp\Services;

abstract class AbstractEvent
{
    protected $version;
    protected $tracking_id;
    protected $client_id;
    protected $client;
    protected $type = '';
    protected $ga_url = '';
    protected $impressionList = [];
    protected $productAction;
    protected $transaction;
    /**
     * AbstractEvent constructor.
     * @param string $version
     * @param string $tracking_id
     * @param string $client_id
     */
    public function __construct(string $tracking_id, string $client_id, string $version = '1')
    {
        $this->version = $version;
        $this->tracking_id = $tracking_id;
        $this->client_id = $client_id;
        $this->client = Services::getHttpClient();
    }

    public function send() {
        $params = [
          'v' => $this->version,
          'tid' => $this->tracking_id,
          'cid' => $this->client_id,
          't' => $this->type,
        ];
        $params = $this->addParams($params);
        $request = new Request([], $this->ga_url, $params, []);
        $this->client->post($request);
    }

    protected function renderImpressionList(): string {
        $result = '';
        /** @var Impression $impression */
        foreach ($this->impressionList as $index => $impression) {
            $result .= "&{$impression->render($index)}";
        }
        return $result;
    }

    /**
     * @param array<string,string> $params
     * @return array<string,string>
     */
    abstract protected function addParams(array $params): array;

    public function addImpression(Impression $impression): void {
        $this->impressionList[] = $impression;
    }

    public function removeImpression(int $index): void {
        if(count($this->impressionList) > $index) {
            unset($this->impressionList[$index]);
            $this->impressionList = array_filter($this->impressionList);
        }
    }

    public function setTransaction(Transaction $transaction): void {
        $this->transaction = $transaction;
    }

    /**
     * @return mixed
     */
    public function getProductAction(): ProductAction
    {
        return $this->productAction;
    }

    /**
     * @param mixed $productAction
     */
    public function setProductAction(ProductAction $productAction)
    {
        $this->productAction = $productAction;
    }


}