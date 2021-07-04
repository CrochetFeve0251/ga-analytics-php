<?php


namespace Crochetfeve0251\GoogleAnalyticsPhp\HTTP;


use Crochetfeve0251\GoogleAnalyticsPhp\HTTP\Contracts\RequestInterface;
use Crochetfeve0251\GoogleAnalyticsPhp\HTTP\Contracts\ResponseInterface;
use Exception;

class Client implements Contracts\ClientInterface
{
    protected $ch;
    /**
     * @inheritDoc
     */
    public function get(RequestInterface $request): ResponseInterface
    {
        $this->ch = curl_init();
        try {
            curl_setopt($this->ch, CURLOPT_URL, $request->getURL());
            $this->createHeaders($request->getHeaders());
            $result = curl_exec($this->ch);
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
            $data = json_decode($result);
            if(((int) $data->returnCode) !== 200){
                throw new HTTPException($data->returnCode);
            }
            return $data;
        } catch (Exception $e) {
            curl_close($this->ch);
            throw new HTTPException();
        }
    }

    /**
     * @inheritDoc
     */
    public function post(RequestInterface $request): ResponseInterface
    {
        $this->ch = curl_init();
        try {
            $body = json_encode($request->getBody());

            curl_setopt($this->ch, CURLOPT_URL, $request->getURL());
            curl_setopt($this->ch, CURLOPT_POSTFIELDS, $body);
            $this->createHeaders($request->getHeaders());
            $result = curl_exec($this->ch);
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
            $data = json_decode($result);
            if(((int) $data->returnCode) !== 200){
                throw new HTTPException($data->returnCode);
            }
            return $data;
        } catch (Exception $e) {
            curl_close($this->ch);
            throw new HTTPException();
        }
    }

    /**
     * @inheritDoc
     */
    public function delete(RequestInterface $request): ResponseInterface
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param Header[] $headers
     * @return string[]
     */protected function createHeaders(array $headers): array{
        $results = [];
        foreach ($headers as $header) {
            $results[] = $header->getName() . ': ' . $header->getValue();
        }
      return $results;
    }
}