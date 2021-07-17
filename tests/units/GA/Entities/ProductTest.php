<?php


namespace Crochetfeve0251\GoogleAnalyticsPhp\Tests\units\GA\Entities;


use Crochetfeve0251\GoogleAnalyticsPhp\GA\Entities\Exceptions\InvalidState;
use Crochetfeve0251\GoogleAnalyticsPhp\GA\Entities\Product;

class ProductTest extends \PHPUnit\Framework\TestCase
{
    public function testShouldRenderIntoSingleDimensionArray() {
        $data = [
            'id' => 'id',
            'name' => 'name',
            'category' => 'category',
            'brand' => 'brand',
            'variant' => 'variant',
            'position' => 'position',
            'custom' => 'custom',
        ];
        $keys = [
            'il1pi1id' => 'id',
            'il1pi1nm' => 'name',
            'il1pi1ca' => 'category',
            'il1pi1br' => 'brand',
            'il1pi1va' => 'variant',
            'il1pi1ps' => 'position',
            'il1pi1cd1' => 'custom',
        ];

        $product = new Product($data['id'], $data['name'], $data['category'], $data['brand'], $data['variant'], $data['position']);
        $product->setCustomDimension($data['custom']);
        $result = $product->render();
        foreach (array_keys($keys) as $key) {
            $this->assertArrayHasKey($key, $result);
            $this->assertEquals($keys[$key], $result[$key]);
        }
    }

    public function testShouldRenderWithRightIndexes() {
        $data = [
            'id' => 'id',
            'name' => 'name',
            'category' => 'category',
            'brand' => 'brand',
            'variant' => 'variant',
            'position' => 'position',
            'custom' => 'custom',
        ];
        $keys = [
            'il3pi2id' => 'id',
            'il3pi2nm' => 'name',
            'il3pi2ca' => 'category',
            'il3pi2br' => 'brand',
            'il3pi2va' => 'variant',
            'il3pi2ps' => 'position',
            'il3pi2cd1' => 'custom',
        ];

        $product = new Product($data['id'], $data['name'], $data['category'], $data['brand'], $data['variant'], $data['position']);
        $product->setCustomDimension($data['custom']);
        $product->setIndexList(3);
        $result = $product->render(2);
        foreach (array_keys($keys) as $key) {
            $this->assertArrayHasKey($key, $result);
            $this->assertEquals($keys[$key], $result[$key]);
        }
    }

    public function testShouldNotRenderWithoutAnything() {
        $this->expectException(InvalidState::class);
        $product = new Product();
        $product->render();
    }

    public function testShouldRenderWithName() {
        $name = 'name';
        $product = new Product();
        $product->setName($name);
        $result = $product->render();
        $this->assertCount(1, $result);
        $this->assertArrayHasKey('il1pi1nm', $result);
        $this->assertEquals($name, $result['il1pi1nm']);
    }

    public function testShouldRenderWithId() {
        $id = 'id';
        $product = new Product();
        $product->setId($id);
        $result = $product->render();
        $this->assertCount(1, $result);
        $this->assertArrayHasKey('il1pi1id', $result);
        $this->assertEquals($id, $result['il1pi1id']);
    }
}