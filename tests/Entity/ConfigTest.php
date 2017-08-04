<?php

namespace Pcelta\Doctrine\Cache\Entity;

use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    /**
     * @param $key
     * @param $invalidValue
     * @dataProvider providerInvalidConfigs
     * @expectedException \Pcelta\Doctrine\Cache\Exception\InvalidCacheConfig
     */
    public function testShouldThrowinvalidCacheConfigWhenInvalid($key, $invalidValue)
    {
        $cacheSettings = [
            'adapter_namespace' => '/tmp',
            'adapter_name' => 'AdapterName',
        ];

        $cacheSettings[$key] = $invalidValue;

        new Config($cacheSettings);
    }

    public function providerInvalidConfigs()
    {
        return [
            ['adapter_namespace', 0],
            ['adapter_name', null],
        ];
    }

    public function testShouldCreateConfigInstanceWhenIsConnectable()
    {
        $cacheSettings = [
            'host' => 'any.host.com',
            'port' => 90,
            'adapter_name' => 'AdapterName',
        ];

        $config = new Config($cacheSettings);

        $this->assertInstanceOf('Pcelta\Doctrine\Cache\Entity\Config', $config);
    }
}
