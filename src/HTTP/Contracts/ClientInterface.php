<?php


namespace Crochetfeve0251\GoogleAnalyticsPhp\HTTP\Contracts;


interface ClientInterface
{
    /**
     * Launch GET request
     * @param RequestInterface $request request to send
     * @return ResponseInterface response from the request
     */
    public function get(RequestInterface $request): ResponseInterface;
    /**
     * Launch POST request
     * @param RequestInterface $request request to send
     * @return ResponseInterface response from the request
     */
    public function post(RequestInterface $request): ResponseInterface;
    /**
     * Launch DELETE request
     * @param RequestInterface $request request to send
     * @return ResponseInterface response from the request
     */
    public function delete(RequestInterface $request): ResponseInterface;
}