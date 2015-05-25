<?php

namespace Pcelta\Doctrine\Cache;

class ProxyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Pcelta\Doctrine\Cache\Proxy::getAdapter
     * @expectedException \Pcelta\Doctrine\Cache\Exception\InvalidCacheConfig
     */
    public function testGetAdapterShouldThrowInvalidCacheConfigWhenFactoryIsNotExists()
    {
        $proxy = new \Pcelta\Doctrine\Cache\Proxy();

        $params = [
            'host' => '127.0.0.1',
            'port' => 11211,
            'adapter_name' => 'Crazy',
            'is_connectable' => true,
        ];
        $config = new \Pcelta\Doctrine\Cache\Entity\Config($params);
        $proxy->getAdapter($config);
    }

    /**
     * @covers Pcelta\Doctrine\Cache\Proxy::getAdapter
     */
    public function testGetAdapterShouldReturnMemcachedInstance()
    {
        if (!extension_loaded(Factory\Memcached::MODULE_NAME)) {
            $this->markTestSkipped('Memcached Module Is Not Installed');

            return;
        }

        $proxy = new \Pcelta\Doctrine\Cache\Proxy();

        $params = [
            'host' => '127.0.0.1',
            'port' => 11211,
            'adapter_name' => 'Memcached',
            'is_connectable' => true,
        ];
        $config = new \Pcelta\Doctrine\Cache\Entity\Config($params);
        $result = $proxy->getAdapter($config);

        $this->assertInstanceOf('\Memcached', $result);
    }

    /**
     * @covers Pcelta\Doctrine\Cache\Proxy::getAdapter
     */
    public function testGetAdapterShouldReturnMemcacheInstance()
    {
        if (!extension_loaded(Factory\Memcache::MODULE_NAME)) {
            $this->markTestSkipped('Memcache Module Is Not Installed');

            return;
        }
        $proxy = new \Pcelta\Doctrine\Cache\Proxy();

        $params = [
            'host' => '127.0.0.1',
            'port' => 11211,
            'adapter_name' => 'Memcache',
            'is_connectable' => true,
        ];
        $config = new \Pcelta\Doctrine\Cache\Entity\Config($params);

        $result = $proxy->getAdapter($config);
        $this->assertInstanceOf('\Memcache', $result);
    }

    /**
     * @covers Pcelta\Doctrine\Cache\Proxy::getAdapter
     */
    public function testGetAdapterShouldReturnRedisInstance()
    {
        if (!extension_loaded(Factory\Redis::MODULE_NAME)) {
            $this->markTestSkipped('Redis Module Is Not Installed');

            return;
        }

        $proxy = new \Pcelta\Doctrine\Cache\Proxy();

        $params = [
            'host' => '127.0.0.1',
            'port' => 11211,
            'adapter_name' => 'Redis',
            'is_connectable' => true,
        ];
        $config = new \Pcelta\Doctrine\Cache\Entity\Config($params);

        $result = $proxy->getAdapter($config);
        $this->assertInstanceOf('\Redis', $result);
    }
}
