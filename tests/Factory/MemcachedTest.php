<?php

use Pcelta\Doctrine\Cache\Factory\Memcached;

class MemcachedTest extends \PHPUnit_Framework_TestCase
{
    private $factoryWithMemcachedInstalled;

    public function setUp()
    {
        $this->factoryWithMemcachedInstalled = $this->getMockBuilder('Pcelta\Doctrine\Cache\Factory\Memcached')
            ->disableOriginalConstructor()
            ->setMethods(['__construct'])
            ->getMock();

        return $this->factoryWithMemcachedInstalled;
    }

    /**
     * @expectedException \Pcelta\Doctrine\Cache\Exception\ModuleIsNotInstalled
     * @covers Pcelta\Doctrine\Cache\Factory\AbstractFactory::__construct
     */
    public function testCreateShouldThrowsModuleIsNotInstalled()
    {
        if (extension_loaded(Memcached::MODULE_NAME)) {
            $this->markTestSkipped('Memcached Module Is Installed');

            return;
        }

        new Memcached();
    }

    /**
     * @covers Pcelta\Doctrine\Cache\Factory\Memcached::create
     * @covers Pcelta\Doctrine\Cache\Factory\AbstractFactory::__construct
     */
    public function testCreateShouldReturnMemcachedInstance()
    {
        if (!extension_loaded(Memcached::MODULE_NAME)) {
            $this->markTestSkipped('Memcached Module Is Not Installed');

            return;
        }

        $params = [
            'host' => '127.0.0.1',
            'port' => 11211,
            'adapter_name' => 'Any',
            'is_connectable' => true,
        ];
        $config = new \Pcelta\Doctrine\Cache\Entity\Config($params);

        $factory = new Memcached();

        $result = $factory->create($config);

        $this->assertInstanceOf('\Memcached', $result);
    }
}
