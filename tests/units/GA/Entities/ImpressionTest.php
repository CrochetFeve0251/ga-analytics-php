<?php


namespace Crochetfeve0251\GoogleAnalyticsPhp\Tests\units\GA\Entities;


use Crochetfeve0251\GoogleAnalyticsPhp\GA\Entities\Impression;
use Crochetfeve0251\GoogleAnalyticsPhp\GA\Entities\Product;

class ImpressionTest extends \PHPUnit\Framework\TestCase
{
    public function testShouldRenderIntoSingleDimensionArray() {
        $mockProduct = $this->createMock(Product::class);
        $mockProduct->expects(self::once())->method('render')->with(1)->willReturn([
           'test' => 'testvalue',
        ]);
        $impression = new Impression('name');
        $impression->addProduct($mockProduct);
        $result = $impression->render();
        $this->assertArrayHasKey('test', $result);
        $this->assertEquals('testvalue', $result['test']);
        $this->assertArrayHasKey('il1nm', $result);
        $this->assertEquals('name', $result['il1nm']);
    }
    public function testShouldRenderWithRightIndex() {
        $mockProduct = $this->createMock(Product::class);
        $mockProduct->expects(self::once())->method('render')->with(1)->willReturn([
            'test' => 'testvalue',
        ]);
        $impression = new Impression('name');
        $impression->addProduct($mockProduct);
        $result = $impression->render(3);
        $this->assertArrayHasKey('test', $result);
        $this->assertEquals('testvalue', $result['test']);
        $this->assertArrayHasKey('il3nm', $result);
        $this->assertEquals('name', $result['il3nm']);
    }
    public function testRenderWithoutAnyListShouldWorks() {
        $impression = new Impression('name');
        $result = $impression->render();
        $this->assertArrayHasKey('il1nm', $result);
        $this->assertEquals('name', $result['il1nm']);
        $this->assertCount(1, $result);
    }
}