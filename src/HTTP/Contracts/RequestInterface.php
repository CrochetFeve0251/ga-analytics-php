<?php


namespace Crochetfeve0251\GoogleAnalyticsPhp\HTTP\Contracts;


use Crochetfeve0251\GoogleAnalyticsPhp\HTTP\Header;

interface RequestInterface
{
    public function getBody(): array;

    public function getURL(): string;

    /**
     * @return Header[]
     */
    public function getHeaders(): array;
}