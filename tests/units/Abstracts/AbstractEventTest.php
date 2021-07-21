<?php


namespace Crochetfeve0251\GoogleAnalyticsPhp\Tests\units\Abstracts;


use Crochetfeve0251\GoogleAnalyticsPhp\GA\Abstracts\AbstractEvent;
use Crochetfeve0251\GoogleAnalyticsPhp\GA\Entities\Impression;
use Crochetfeve0251\GoogleAnalyticsPhp\GA\Entities\ProductAction;
use Crochetfeve0251\GoogleAnalyticsPhp\HTTP\Contracts\ClientInterface;
use Crochetfeve0251\GoogleAnalyticsPhp\HTTP\Request;
use Crochetfeve0251\GoogleAnalyticsPhp\Services;
use ReflectionClass;

class AbstractEventTest extends \PHPUnit\Framework\TestCase
{
    public function testShouldBeAbleToSendDataWithBasicInformation() {
        $ga_url = 'http://test.test';
        $data = [
            'v' => '1',
            'tid' => 'tracking_id',
            'cid' => 'client_id',
            't' => 'transaction',
        ];
        $event = $this->getMockForAbstractClass(AbstractEvent::class, [
            $data['tid'],
            $data['cid'],
        ]);
        $event->expects($this->once())->method('addParams')->with($data)->willReturn($data);
        $reflection = new ReflectionClass(AbstractEvent::class);
        $reflection_property = $reflection->getProperty('transaction');
        $reflection_property->setAccessible(true);
        $reflection_property->setValue($event, $data['t']);

        $request = new Request([], $ga_url, $data, []);

        $httpClientMock = $this->createMock(ClientInterface::class);

        $httpClientMock->expects(self::once())->method('post')->with($request);
        Services::injectMock('getHttpClient', $httpClientMock);
        $event->send();
    }

    public function testShouldBeAbleToSendDataWithImpressionList() {
        $ga_url = 'http://test.test';
        $data = [
            'v' => '1',
            'tid' => 'tracking_id',
            'cid' => 'client_id',
            't' => 'transaction',
        ];

        $impressionData = [
            'test' => 'test'
        ];

        $event = $this->getMockForAbstractClass(AbstractEvent::class, [
            $data['tid'],
            $data['cid'],
        ]);
        $event->expects($this->once())->method('addParams')->with($data)->willReturn($data);
        $reflection = new ReflectionClass(AbstractEvent::class);
        $reflection_property = $reflection->getProperty('transaction');
        $reflection_property->setAccessible(true);
        $reflection_property->setValue($event, $data['t']);

        $allData = array_merge($data, $impressionData);
        $request = new Request([], $ga_url, $allData, []);

        $httpClientMock = $this->createMock(ClientInterface::class);

        $httpClientMock->expects(self::once())->method('post')->with($request);
        Services::injectMock('getHttpClient', $httpClientMock);

        $impressionMock = $this->createMock(Impression::class);
        $impressionMock->expects(self::once())->method('render')->with(1)->willReturn($impressionData);
        $event->addImpression($impressionMock);
        $event->send();
    }

    public function testShouldBeAbleToSendDataWithProductAction() {
        $ga_url = 'http://test.test';
        $data = [
            'v' => '1',
            'tid' => 'tracking_id',
            'cid' => 'client_id',
            't' => 'transaction',
        ];

        $productActionData = [
            'test' => 'test',
        ];

        $event = $this->getMockForAbstractClass(AbstractEvent::class, [
            $data['tid'],
            $data['cid'],
        ]);
        $event->expects($this->once())->method('addParams')->with($data)->willReturn($data);
        $reflection = new ReflectionClass(AbstractEvent::class);
        $reflection_property = $reflection->getProperty('transaction');
        $reflection_property->setAccessible(true);
        $reflection_property->setValue($event, $data['t']);

        $allData = array_merge($data, $productActionData);

        $request = new Request([], $ga_url, $allData, []);

        $httpClientMock = $this->createMock(ClientInterface::class);

        $httpClientMock->expects(self::once())->method('post')->with($request);
        Services::injectMock('getHttpClient', $httpClientMock);

        $productAction = $this->createMock(ProductAction::class);

        $productAction->expects(self::once())->method('render')->with(1)->willReturn($productActionData);

        $event->send();
    }

    public function testShouldBeAbleToSendDataWithTransaction() {
        $ga_url = 'http://test.test';
        $data = [
            'v' => '1',
            'tid' => 'tracking_id',
            'cid' => 'client_id',
            't' => 'transaction',
        ];

        $transactionData = [
            'test' => 'test',
        ];

        $event = $this->getMockForAbstractClass(AbstractEvent::class, [
            $data['tid'],
            $data['cid'],
        ]);
        $event->expects($this->once())->method('addParams')->with($data)->willReturn($data);
        $reflection = new ReflectionClass(AbstractEvent::class);
        $reflection_property = $reflection->getProperty('transaction');
        $reflection_property->setAccessible(true);
        $reflection_property->setValue($event, $data['t']);

        $allData = array_merge($data, $transactionData);
        $request = new Request([], $ga_url, $allData, []);

        $httpClientMock = $this->createMock(ClientInterface::class);

        $httpClientMock->expects(self::once())->method('post')->with($request);
        Services::injectMock('getHttpClient', $httpClientMock);
        $event->send();
    }

    public function testShouldBeAbleToSendDataWithAll() {
        $ga_url = 'http://test.test';
        $data = [
            'v' => '1',
            'tid' => 'tracking_id',
            'cid' => 'client_id',
            't' => 'transaction',
        ];
        $event = $this->getMockForAbstractClass(AbstractEvent::class, [
            $data['tid'],
            $data['cid'],
        ]);

        $impressionData = [
            'impression' => 'impression',
        ];

        $transactionData = [
          'transaction' => 'transaction',
        ];

        $productActionData = [
          'product_action' => 'product_action',
        ];

        $event->expects($this->once())->method('addParams')->with($data)->willReturn($data);
        $reflection = new ReflectionClass(AbstractEvent::class);
        $reflection_property = $reflection->getProperty('transaction');
        $reflection_property->setAccessible(true);
        $reflection_property->setValue($event, $data['t']);

        $allData = array_merge($data, $impressionData, $transactionData, $productActionData);

        $request = new Request([], $ga_url, $allData, []);

        $httpClientMock = $this->createMock(ClientInterface::class);

        $httpClientMock->expects(self::once())->method('post')->with($request);
        Services::injectMock('getHttpClient', $httpClientMock);
        $event->send();
    }
}