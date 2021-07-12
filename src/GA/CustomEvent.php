<?php


namespace Crochetfeve0251\GoogleAnalyticsPhp\GA;


class CustomEvent extends Abstracts\AbstractEvent
{
    protected $category;
    protected $action;
    protected $label;
    protected $value;

    /**
     * CustomEvent constructor.
     * @param $category
     * @param $action
     * @param $label
     * @param $value
     */
    public function __construct(string $tracking_id, string $client_id, string $category, string $action, string $label, string $value,  string $version = '1')
    {
        parent::__construct($tracking_id, $client_id, $version);
        $this->category = $category;
        $this->action = $action;
        $this->label = $label;
        $this->value = $value;
    }


    /**
     * @inheritDoc
     */
    protected function addParams(array $params): array
    {
        $newParams = [
            'ec' => $this->category,
            'ea' => $this->action,
            'el' => $this->label,
            'ev' => $this->value,
        ];
        return array_merge($params, $newParams);
    }
}