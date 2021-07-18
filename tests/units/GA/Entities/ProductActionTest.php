<?php


namespace Crochetfeve0251\GoogleAnalyticsPhp\Tests\units\GA\Entities;


use Crochetfeve0251\GoogleAnalyticsPhp\GA\Entities\Action;
use Crochetfeve0251\GoogleAnalyticsPhp\GA\Entities\ProductAction;

class ProductActionTest extends \PHPUnit\Framework\TestCase
{
    public function testShouldRenderIntoSingleDimensionArray()
    {
        $data = [
            'name' => 'name',
        ];
        $actionMock = $this->createMock(Action::class);
        $actionMock->expects(self::once())->method('render')->with(1)->willReturn([
            'test' => 'testvalue',
        ]);
        $productAction = new ProductAction($data['name']);
        $productAction->addAction($actionMock);
        $result = $productAction->render();
        $this->assertArrayHasKey('a', $result);
        $this->assertEquals('name', $result['a']);
        $this->assertArrayHasKey('test', $result);
        $this->assertEquals('testvalue', $result['test']);
    }

    public function testShouldRenderWithoutAction()
    {
        $data = [
            'name' => 'name',
        ];
        $productAction = new ProductAction($data['name']);
        $result = $productAction->render();
        $this->assertArrayHasKey('a', $result);
        $this->assertEquals('name', $result['a']);
        $this->assertCount(1, $result);
    }
}