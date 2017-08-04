<?php

namespace Pcelta\Doctrine\Cache;

use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    /**
     * @expectedException \Pcelta\Doctrine\Cache\Exception\InvalidCacheConfig
     */
    public function testShouldThrowInvalidCacheConfigWhenCacheProviderIsNotExists()
    {
        $cacheSettings = [
            'adapter_name' => 'Crazy',
        ];

        $factory = new Factory();
        $factory->create($cacheSettings);
    }

    public function testShouldCreateCacheProviderNonConnectable()
    {
        $cacheSettings = [
            'adapter_name' => 'Array',
        ];

        $factory = new Factory();

        $mockedProxy = $this->getMockBuilder('Pcelta\Doctrine\Cache\Proxy')
            ->setMethods(['getAdapter'])
            ->getMock();

        $mockedProxy->expects($this->never())
            ->method('getAdapter');

        $factory->setProxy($mockedProxy);
        $result = $factory->create($cacheSettings);

        $this->assertInstanceOf('Doctrine\Common\Cache\ArrayCache', $result);
    }
}
