<?php

use Pcelta\Doctrine\Cache\Factory;
use PHPUnit\Framework\TestCase;

class RedisFactoryTest extends TestCase
{
    /**
     * @covers Pcelta\Doctrine\Cache\Factory\RedisFactory::create
     * @covers Pcelta\Doctrine\Cache\Factory\AbstractFactory::__construct
     */
    public function testCreateShouldReturnRedisInstance()
    {
        if (!extension_loaded(Factory\RedisFactory::MODULE_NAME)) {
            return $this->markTestSkipped('Redis Module Is Not Installed');
        }

        $params = [
            'host' => '127.0.0.1',
            'port' => 11211,
            'adapter_name' => 'Redis',
        ];

        $config = new \Pcelta\Doctrine\Cache\Entity\Config($params);

        $redisAdapter = $this->getMockBuilder(\Redis::class)
            ->setMethods(['connect', 'setOption'])
            ->getMock();
        $redisAdapter->expects($this->once())
            ->method('connect')
            ->with($params['host'], $params['port']);

        $factory = $this->getMockBuilder(Factory\RedisFactory::class)
            ->disableOriginalConstructor()
            ->setMethods(['getRedisAdapter'])
            ->getMock();
        $factory->expects($this->once())
            ->method('getRedisAdapter')
            ->will($this->returnValue($redisAdapter));

        $result = $factory->create($config);

        $this->assertInstanceOf(\Doctrine\Common\Cache\RedisCache::class, $result);
    }
}
