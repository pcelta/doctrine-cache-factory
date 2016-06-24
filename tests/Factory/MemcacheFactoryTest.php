<?php

use Pcelta\Doctrine\Cache\Factory;
use Pcelta\Doctrine\Cache\Entity;

class MemcacheFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Pcelta\Doctrine\Cache\Factory\MemcacheFactory::create
     */
    public function testCreateShouldReturnMemcacheInstance()
    {
        $params = [
            'host' => '127.0.0.1',
            'port' => 11211,
            'adapter_name' => 'Memcache',
        ];
        $config = new Entity\Config($params);

        $memcacheAdapter = $this->getMockBuilder(\Memcache::class)
            ->setMethods(['connect'])
            ->getMock();
        $memcacheAdapter->expects($this->once())
            ->method('connect')
            ->with($params['host'], $params['port']);

        $factory = $this->getMockBuilder(Factory\MemcacheFactory::class)
            ->disableOriginalConstructor()
            ->setMethods(['getMemcacheAdapter'])
            ->getMock();
        $factory->expects($this->once())
            ->method('getMemcacheAdapter')
            ->will($this->returnValue($memcacheAdapter));

        $result = $factory->create($config);

        $this->assertInstanceOf(\Doctrine\Common\Cache\MemcacheCache::class, $result);
    }

    /**
     * @expectedException \Pcelta\Doctrine\Cache\Exception\ModuleIsNotInstalled
     * @covers Pcelta\Doctrine\Cache\Factory\MemcacheFactory::create
     */
    public function testCreateShouldThrowsModuleIsNotInstalled()
    {
        if (extension_loaded(Factory\MemcacheFactory::MODULE_NAME)) {
            return $this->markTestSkipped('Memcache Module Is Installed');
        }

        new Factory\MemcacheFactory();
    }
}
