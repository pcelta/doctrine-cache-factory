<?php

namespace Pcelta\Doctrine\Cache\Factory;

use Doctrine\Common\Cache\CacheProvider;
use Pcelta\Doctrine\Cache\Entity\Config;

class MemcacheFactory extends AbstractFactory
{
    const MODULE_NAME = 'memcache';

    public function getModuleName()
    {
        return self::MODULE_NAME;
    }

    /**
     * @return \Memcache
     */
    public function getMemcacheAdapter()
    {
        return new \Memcache();
    }

    /**
     * @param CacheProvider $cacheProvider
     *
     * @return CacheProvider
     */
    protected function decorateWithConnectable(CacheProvider $cacheProvider)
    {
        $memcache = $this->getMemcacheAdapter();
        $settings = $this->config->getSettings();
        $memcache->connect($settings['host'], $settings['port']);

        $cacheProvider->setMemcache($memcache);

        return $cacheProvider;
    }

    /**
     * @param Config $config
     *
     * @return bool
     */
    protected function isValidConfig(Config $config)
    {
        $settings = $config->getSettings();
        if (!isset($settings['host'])) {
            return false;
        }

        if (!isset($settings['port'])) {
            return false;
        }

        return true;
    }
}
