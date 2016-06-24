<?php

namespace Pcelta\Doctrine\Cache\Factory;

use Doctrine\Common\Cache\CacheProvider;
use Pcelta\Doctrine\Cache\Entity\Config;

class RedisFactory extends AbstractFactory
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
     * @return \Redis
     */
    protected function getRedisAdapter()
    {
        return new \Redis();
    }

    /**
     * @param CacheProvider $cacheProvider
     *
     * @return CacheProvider
     */
    protected function decorateWithConnectable(CacheProvider $cacheProvider)
    {
        $redis = $this->getRedisAdapter();
        $settings = $this->config->getSettings();
        $redis->connect($settings['host'], $settings['port']);

        $cacheProvider->setRedis($redis);

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
