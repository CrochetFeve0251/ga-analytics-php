<?php


namespace Crochetfeve0251\GoogleAnalyticsPhp\GA\Abstracts;


class PageViewEvent extends AbstractEvent
{
    protected $domain;
    protected $page;
    protected $title;

    public function __construct(string $tracking_id, string $client_id, string $version = '1', string $domain = '', string $page = '', string $title = '')
    {
        parent::__construct($tracking_id, $client_id, $version);
        $this->type = 'pageview';
        $this->domain = $domain;
        $this->page = $page;
        $this->title = $title;
    }

    /**
     * @inheritDoc
     */
    protected function addParams(array $params): array
    {
        $newParams = [
            'dh' => $this->domain,
            'dp' => $this->page,
            'dt' => $this->title,
        ];
        return array_merge($params, $newParams);
    }
}