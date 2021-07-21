<?php


namespace Crochetfeve0251\GoogleAnalyticsPhp;


use Crochetfeve0251\GoogleAnalyticsPhp\HTTP\Client;
use Crochetfeve0251\GoogleAnalyticsPhp\HTTP\Contracts\ClientInterface;
use ReflectionClass;

class Services
{
    protected static $mocks = [];

    public static function injectMock(string $function, $mock) {
        self::$mocks[$function] = $mock;
    }

    /**
     * Allow to mock the model
     * @param string $method method from the model
     * @param string $class class to instantiate
     * @param array $params params from the class
     * @return mixed|object instantiation or mock
     * @throws \ReflectionException
     */
    protected static function useServiceMock(string $method, string $class, array $params = [])
    {
        $method = strtolower($method);
        if (isset(static::$mocks[$method])) {
            return static::$mocks[$method];
        }

        $class = new ReflectionClass($class);

        return $class->newInstanceArgs($params);
    }

    public static function getHttpClient(): ClientInterface {
        return self::useServiceMock('getHttpClient', Client::class);
    }
}