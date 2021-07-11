<?php


namespace Crochetfeve0251\GoogleAnalyticsPhp\HTTP;


class Request implements Contracts\RequestInterface
{
    protected $body = [];
    protected $url = '';
    /** @var array<string,string> */
    protected $params = [];
    /** @var Header[] */
    protected $headers = [];

    /**
     * Request constructor.
     * @param array $body
     * @param string $url
     * @param string[] $params
     * @param Header[] $headers
     */
    public function __construct(array $body, string $url, array $params, array $headers)
    {
        $this->body = $body;
        $this->url = $url;
        $this->params = $params;
        $this->headers = $headers;
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function getURL(): string
    {
        return $this->url . $this->parseParams();
    }

    /**
     * @inheritDoc
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    protected function parseParams(): string {
        $result = '';
        foreach ($this->params as $field => $value) {
            if($result === '') {
                $result .= "?$field=$value";
            } else {
                $result .= "&$field=$value";
            }
        }
        return $result;
    }
}