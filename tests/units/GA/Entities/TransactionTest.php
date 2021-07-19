<?php


namespace Crochetfeve0251\GoogleAnalyticsPhp\Tests\units\GA\Entities;


use Crochetfeve0251\GoogleAnalyticsPhp\GA\Entities\Exceptions\InvalidState;
use Crochetfeve0251\GoogleAnalyticsPhp\GA\Entities\Transaction;

class TransactionTest extends \PHPUnit\Framework\TestCase
{
    public function testShouldRenderIntoSingleDimensionArray() {
        $data = [
            'id' => 'id',
            'affiliation' => 'affiliation',
            'revenue' => 'revenue',
            'shipping' => 'shipping',
            'tax' => 'tax',
            'currency' => 'currency',
        ];

        $keys = [
            'ti' => 'id',
            'ta' => 'affiliation',
            'tr' => 'revenue',
            'ts' => 'shipping',
            'tt' => 'tax',
            'tc' => 'currency',
        ];
        $transaction = new Transaction($data['id'], $data['affiliation'], $data['revenue'], $data['shipping'], $data['tax'], $data['currency']);
        $result = $transaction->render();
        foreach (array_keys($keys) as $key) {
            $this->assertArrayHasKey($key, $result);
            $this->assertEquals($keys[$key], $result[$key]);
        }
    }

    public function testShouldNotRenderWithoutAnything() {
        $this->expectException(InvalidState::class);
        $transaction = new Transaction();
        $transaction->render();
    }

    public function testShouldRenderWithId() {
        $transaction = new Transaction();
        $id = 'id';
        $transaction->setId($id);
        $result = $transaction->render();
        $this->assertCount(2, $result);
        $this->assertArrayHasKey('ti', $result);
        $this->assertEquals($id, $result['ti']);
        $this->assertArrayHasKey('t', $result);
        $this->assertEquals('transaction', $result['t']);
    }
}