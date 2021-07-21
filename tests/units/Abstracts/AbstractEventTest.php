<?php


namespace Crochetfeve0251\GoogleAnalyticsPhp\Tests\units\Abstracts;


use Crochetfeve0251\GoogleAnalyticsPhp\GA\Abstracts\AbstractEvent;
use Crochetfeve0251\GoogleAnalyticsPhp\HTTP\Contracts\ClientInterface;
use Crochetfeve0251\GoogleAnalyticsPhp\HTTP\Request;
use Crochetfeve0251\GoogleAnalyticsPhp\Services;

class AbstractEventTest extends \PHPUnit\Framework\TestCase
{
    public function testShouldBeAbleToSendDataWithBasicInformation() {
        $ga_url = '';
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
        $request = new Request([], $ga_url, $data, []);

        $httpClientMock = $this->createMock(ClientInterface::class);

        $httpClientMock->expects(self::once())->method('post')->with($request);
        Services::injectMock('getHttpClient', $httpClientMock);
        $event->send();
    }

    public function testShouldBeAbleToSendDataWithImpressionList() {
        $event = $this->getMockForAbstractClass(AbstractEvent::class);
        $httpClientMock = $this->createMock(ClientInterface::class);

        $httpClientMock->expects(self::once())->method('post');
        Services::injectMock('getHttpClient', $httpClientMock);
        $event->send();
    }

    public function testShouldBeAbleToSendDataWithProductAction() {
        $event = $this->getMockForAbstractClass(AbstractEvent::class);
        $httpClientMock = $this->createMock(ClientInterface::class);

        $httpClientMock->expects(self::once())->method('post');
        Services::injectMock('getHttpClient', $httpClientMock);
        $event->send();
    }

    public function testShouldBeAbleToSendDataWithTransaction() {
        $event = $this->getMockForAbstractClass(AbstractEvent::class);
        $httpClientMock = $this->createMock(ClientInterface::class);

        $httpClientMock->expects(self::once())->method('post');
        Services::injectMock('getHttpClient', $httpClientMock);
        $event->send();
    }

    public function testShouldBeAbleToSendDataWithAll() {
        $event = $this->getMockForAbstractClass(AbstractEvent::class);
        $httpClientMock = $this->createMock(ClientInterface::class);

        $httpClientMock->expects(self::once())->method('post');
        Services::injectMock('getHttpClient', $httpClientMock);
        $event->send();
    }
}