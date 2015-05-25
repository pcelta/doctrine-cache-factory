<?php

namespace Pcelta\Doctrine\Cache;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Pcelta\Doctrine\Cache\Exception\InvalidCacheConfig
     */
    public function testShouldThrowInvalidCacheConfigWhenCacheProviderIsNotExists()
    {
        $cacheSettings = [
            'host' => '127.0.0.1',
            'port' => 11211,
            'adapter_name' => 'Crazy',
            'is_connectable' => true,
        ];

        $factory = new Factory();
        $factory->create($cacheSettings);
    }

    public function testShouldCreateCacheProviderConnectable()
    {
        $cacheSettings = [
            'host' => '127.0.0.1',
            'port' => 11211,
            'adapter_name' => 'Memcached',
            'is_connectable' => true,
        ];

        $factory = $this->getMockBuilder('Pcelta\Doctrine\Cache\Factory')
            ->disableOriginalConstructor()
            ->setMethods(['addConnection'])
            ->getMock();
        $factory->expects($this->once())
            ->method('addConnection');

        $result = $factory->create($cacheSettings);

        $this->assertInstanceOf('Doctrine\Common\Cache\CacheProvider', $result);
    }
    public function testShouldCreateCacheProviderNonConnectable()
    {
        $cacheSettings = [
            'adapter_name' => 'Array',
            'is_connectable' => false,
        ];

        $factory = new Factory();

        $mockedProxy = $this->getMockBuilder('Pcelta\Doctrine\Cache\Proxy')
            ->setMethods(['getAdapter'])
            ->getMock();

        $mockedProxy->expects($this->never())
            ->method('getAdapter');

        $factory->setProxy($mockedProxy);
        $result = $factory->create($cacheSettings);

        $this->assertInstanceOf('Doctrine\Common\Cache\CacheProvider', $result);
    }
}
