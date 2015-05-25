<?php

namespace Pcelta\Doctrine\Cache\Factory;

use Pcelta\Doctrine\Cache\Entity\Config;

class Redis extends AbstractFactory
{
    const MODULE_NAME = 'redis';

    /**
     * @return string
     */
    public function getModuleName()
    {
        return self::MODULE_NAME;
    }

    /**
     * @param Config $config
     *
     * @return \Redis
     */
    public function create(Config $config)
    {
        $redis = new \Redis();
        $redis->connect($config->getHost(), $config->getPort());

        return $redis;
    }
}
