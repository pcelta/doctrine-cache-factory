<?php

namespace Pcelta\Doctrine\Cache\Entity;

class ConfigTest extends \PHPUnit_Framework_TestCase
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
            'host' => 'any.host.com',
            'port' => 90,
            'is_connectable' => true,
            'adapter_name' => 'AdapterName',
        ];

        $cacheSettings[$key] = $invalidValue;

        new Config($cacheSettings);
    }

    public function providerInvalidConfigs()
    {
        return [
            ['host', null],
            ['port', null],
            ['adapter_name', null],
            ['is_connectable', null],
        ];
    }

    public function testShouldCreateConfigInstanceWhenNotIsConnectable()
    {
        $cacheSettings = [
            'is_connectable' => false,
            'adapter_name' => 'AdapterName',
        ];

        $config = new Config($cacheSettings);

        $this->assertInstanceOf('Pcelta\Doctrine\Cache\Entity\Config', $config);
    }

    public function testShouldCreateConfigInstanceWhenIsConnectable()
    {
        $cacheSettings = [
            'host' => 'any.host.com',
            'port' => 90,
            'is_connectable' => true,
            'adapter_name' => 'AdapterName',
            'adapter_name' => 'AdapterName',
        ];

        $config = new Config($cacheSettings);

        $this->assertInstanceOf('Pcelta\Doctrine\Cache\Entity\Config', $config);
    }
}
