<?php


namespace Crochetfeve0251\GoogleAnalyticsPhp\GA\Entities;


class ProductAction
{
    protected $name;

    protected $actionList = [];

    /**
     * ProductAction constructor.
     * @param $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function addAction(Action $action): void {
        $this->actionList[] = $action;
    }

    public function removeAction(int $index): void {
        if(count($this->actionList) > $index) {
            unset($this->actionList[$index]);
            $this->actionList = array_filter($this->actionList);
        }
    }

    public function render(int $index = 0): array {
        $i = 0;
        return array_reduce($this->actionList, function($carry, $action) use (&$i) {
            return array_merge($carry, $action->render($i));
        }, ['a' => $this->name]);
    }
}