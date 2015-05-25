<?php

namespace Pcelta\Doctrine\Cache\Factory;

use Pcelta\Doctrine\Cache\Entity\Config;
use Pcelta\Doctrine\Cache\Exception\ModuleIsNotInstalled;

class Memcache extends AbstractFactory
{
    const MODULE_NAME = 'memcache';

    public function getModuleName()
    {
        return self::MODULE_NAME;
    }

    /**
     * @param Config $config
     *
     * @return \Memcache
     *
     * @throws ModuleIsNotInstalled
     */
    public function create(Config $config)
    {
        $memcache = new \Memcache();
        $memcache->connect($config->getHost(), $config->getPort());

        return $memcache;
    }
}
