<?php

use Pcelta\Doctrine\Cache\Factory;
use Pcelta\Doctrine\Cache\Entity;

class ArrayFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testCreate()
    {
        $params = [
            'adapter_name' => 'Array',
        ];
        $config = new Entity\Config($params);

        $factory = new Factory\ArrayFactory();
        $result = $factory->create($config);

        $this->assertInstanceOf(\Doctrine\Common\Cache\ArrayCache::class, $result);
    }
}