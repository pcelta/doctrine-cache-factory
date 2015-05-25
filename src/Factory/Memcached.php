<?php

namespace Pcelta\Doctrine\Cache\Factory;

use Pcelta\Doctrine\Cache\Entity\Config;

class Memcached extends AbstractFactory
{
    const MODULE_NAME = 'memcached';

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
     * @return \Memcached
     */
    public function create(Config $config)
    {
        $memcached = new \Memcached();
        $memcached->addServer($config->getHost(), $config->getPort());

        return $memcached;
    }
}
