<?php

use Pcelta\Doctrine\Cache\Factory\Memcache;

class MemcacheTest extends \PHPUnit_Framework_TestCase
{
    private $factoryWithMemcacheInstalled;

    public function setUp()
    {
        $this->factoryWithMemcacheInstalled = $this->getMockBuilder('Pcelta\Doctrine\Cache\Factory\Memcache')
            ->disableOriginalConstructor()
            ->setMethods(['__construct'])
            ->getMock();

        return $this->factoryWithMemcacheInstalled;
    }

    /**
     * @covers Pcelta\Doctrine\Cache\Factory\Memcache::create
     */
    public function testCreateShouldReturnMemcacheInstance()
    {
        $params = [
            'host' => '127.0.0.1',
            'port' => 11211,
            'adapter_name' => 'Any',
            'is_connectable' => true,
        ];
        $config = new \Pcelta\Doctrine\Cache\Entity\Config($params);

        $factory = new Memcache();
        if (!extension_loaded(Memcache::MODULE_NAME)) {
            $this->markTestSkipped('Memcache Module Is Not Installed');

            return;
        }

        $result = $factory->create($config);

        $this->assertInstanceOf('\Memcache', $result);
    }

    /**
     * @expectedException \Pcelta\Doctrine\Cache\Exception\ModuleIsNotInstalled
     * @covers Pcelta\Doctrine\Cache\Factory\Memcache::create
     */
    public function testCreateShouldThrowsModuleIsNotInstalled()
    {
        if (extension_loaded(Memcache::MODULE_NAME)) {
            $this->markTestSkipped('Memcache Module Is Installed');

            return;
        }

        new Memcache();
    }
}
