<?php


namespace Crochetfeve0251\GoogleAnalyticsPhp\GA\Abstracts;


use Crochetfeve0251\GoogleAnalyticsPhp\Services;

abstract class AbstractEvent
{
    protected $version;
    protected $tracking_id;
    protected $client_id;
    protected $client;
    protected $type = '';

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
        $request = Ser
        $response = $this->client->post();
    }

    /**
     * @param array<string,string> $params
     * @return array<string,string>
     */
    abstract protected function addParams(array $params): array;
}