<?php

use Pcelta\Doctrine\Cache\Factory;
use Pcelta\Doctrine\Cache\Entity;

class MemcachedFactoryTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @expectedException \Pcelta\Doctrine\Cache\Exception\ModuleIsNotInstalled
     * @covers Pcelta\Doctrine\Cache\Factory\AbstractFactory::__construct
     */
    public function testCreateShouldThrowsModuleIsNotInstalled()
    {
        if (extension_loaded(Factory\MemcachedFactory::MODULE_NAME)) {
            $this->markTestSkipped('Memcached Module Is Installed');

            return;
        }

        new Factory\MemcachedFactory();
    }

    /**
     * @covers Pcelta\Doctrine\Cache\Factory\Memcached::create
     * @covers Pcelta\Doctrine\Cache\Factory\AbstractFactory::__construct
     */
    public function testCreateShouldReturnMemcachedInstance()
    {
        $params = [
            'host' => '127.0.0.1',
            'port' => 11211,
            'adapter_name' => 'Memcached'
        ];

        $config = new Entity\Config($params);

        $memcachedAdapter = $this->getMockBuilder(\Memcached::class)
            ->setMethods(['addServer'])
            ->getMock();

        $memcachedAdapter->expects($this->once())
            ->method('addServer')
            ->with($params['host'], $params['port']);

        $factory = $this->getMockBuilder(Factory\MemcachedFactory::class)
            ->disableOriginalConstructor()
            ->setMethods(['getMemcachedAdapter'])
            ->getMock();
        $factory->expects($this->once())
            ->method('getMemcachedAdapter')
            ->will($this->returnValue($memcachedAdapter));

        $result = $factory->create($config);

        $this->assertInstanceOf(\Doctrine\Common\Cache\MemcachedCache::class, $result);
    }
}
