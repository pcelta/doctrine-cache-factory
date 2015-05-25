<?php

use Pcelta\Doctrine\Cache\Factory\Redis;

class RedisTest extends \PHPUnit_Framework_TestCase
{
    private $factoryWithRedisInstalled;

    public function setUp()
    {
        $this->factoryWithRedisInstalled = $this->getMockBuilder('Pcelta\Doctrine\Cache\Factory\Redis')
            ->disableOriginalConstructor()
            ->setMethods(['__construct'])
            ->getMock();

        return $this->factoryWithRedisInstalled;
    }

    /**
     * @covers Pcelta\Doctrine\Cache\Factory\Redis::create
     * @covers Pcelta\Doctrine\Cache\Factory\AbstractFactory::__construct
     */
    public function testCreateShouldReturnRedisInstance()
    {
        if (!extension_loaded(Redis::MODULE_NAME)) {
            $this->markTestSkipped('Redis Module Is Not Installed');

            return;
        }

        $params = [
            'host' => '127.0.0.1',
            'port' => 11211,
            'adapter_name' => 'Any',
            'is_connectable' => true,
        ];
        $config = new \Pcelta\Doctrine\Cache\Entity\Config($params);

        $factory = new Redis();
        $result = $factory->create($config);

        $this->assertInstanceOf('\Redis', $result);
    }
}
