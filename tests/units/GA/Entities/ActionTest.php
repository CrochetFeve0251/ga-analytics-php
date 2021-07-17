<?php


namespace Crochetfeve0251\GoogleAnalyticsPhp\Tests\units\GA\Entities;


use Crochetfeve0251\GoogleAnalyticsPhp\GA\Entities\Action;
use Crochetfeve0251\GoogleAnalyticsPhp\GA\Entities\Exceptions\InvalidState;
use PHPUnit\Framework\TestCase;

class ActionTest extends TestCase
{
    public function testShouldRenderIntoSingleDimensionArray() {
        $data = [
            'id' => 'id',
            'name' => 'name',
            'category' => 'category',
            'brand' => 'brand',
            'variant' => 'variant',
            'position' => 'position',
        ];
        $keys = [
            'pr1id' => 'id',
            'pr1nm' => 'name',
            'pr1ca' => 'category',
            'pr1br' => 'brand',
            'pr1va' => 'variant',
            'pr1ps' => 'position',
        ];
        $action = new Action($data['name'], $data['id'], $data['category'], $data['brand'], $data['variant'], $data['position']);

        $result = $action->render();
        foreach (array_keys($keys) as $key) {
            $this->assertArrayHasKey($key, $result);
            $this->assertEquals($keys[$key], $result[$key]);
        }
    }

    public function testShouldRenderWithRightIndex() {
        $data = [
            'id' => 'id',
            'name' => 'name',
            'category' => 'category',
            'brand' => 'brand',
            'variant' => 'variant',
            'position' => 'position',
        ];
        $keys = [
            'pr3id' => 'id',
            'pr3nm' => 'name',
            'pr3ca' => 'category',
            'pr3br' => 'brand',
            'pr3va' => 'variant',
            'pr3ps' => 'position',
        ];
        $action = new Action($data['name'], $data['id'], $data['category'], $data['brand'], $data['variant'], $data['position']);

        $result = $action->render(3);
        foreach (array_keys($keys) as $key) {
            $this->assertArrayHasKey($key, $result);
            $this->assertEquals($keys[$key], $result[$key]);
        }
    }

    public function testShouldRenderWithJustName() {
        $action = new Action();
        $action->setName('name');
        $result = $action->render();
        $this->assertCount(1, $result);
        $this->assertArrayHasKey('pr1nm', $result);
        $this->assertEquals('name', $result['pr1nm']);
    }

    public function testShouldRenderWithJustId() {
        $action = new Action();
        $action->setId('id');
        $result = $action->render();
        $this->assertCount(1, $result);
        $this->assertArrayHasKey('pr1id', $result);
        $this->assertEquals('id', $result['pr1id']);

    }

    public function  testShouldNotRenderWithoutParams() {
        $this->expectException(InvalidState::class);
        $action = new Action();
        $action->render();
    }
}