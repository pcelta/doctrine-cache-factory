<?php

namespace Pcelta\Doctrine\Cache\Factory;

use Doctrine\Common\Cache\CacheProvider;
use Pcelta\Doctrine\Cache\Entity\Config;

class MemcachedFactory extends AbstractFactory
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
     * @return \Memcache
     */
    public function getMemcachedAdapter()
    {
        return new \Memcached();
    }

    /**
     * @param CacheProvider $cacheProvider
     * @return CacheProvider
     */
    protected function decorateWithConnectable(CacheProvider $cacheProvider)
    {
        $memcached = $this->getMemcachedAdapter();
        $settings = $this->config->getSettings();
        $memcached->addserver($settings['host'], $settings['port']);

        $cacheProvider->setMemcached($memcached);
        return $cacheProvider;
    }

    /**
     * @param Config $config
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
