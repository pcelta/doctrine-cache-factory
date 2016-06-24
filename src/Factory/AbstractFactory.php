<?php

namespace Pcelta\Doctrine\Cache\Factory;

use Pcelta\Doctrine\Cache\Entity\Config;
use Pcelta\Doctrine\Cache\Exception\InvalidCacheConfig;
use Pcelta\Doctrine\Cache\Exception\ModuleIsNotInstalled;
use Doctrine\Common\Cache\CacheProvider;

abstract class AbstractFactory implements Factorable
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * @return string
     */
    abstract public function getModuleName();

    public function __construct()
    {
        if (!$this->moduleIsInstalled()) {
            throw new ModuleIsNotInstalled($this->getModuleName());
        }
    }

    /**
     * @return bool
     */
    public function moduleIsInstalled()
    {
        if (!extension_loaded($this->getModuleName())) {
            return false;
        }

        return true;
    }

    /**
     * @param Config $config
     * @return CacheProvider
     * @throws InvalidCacheConfigException
     */
    public function create(Config $config)
    {
        $this->config = $config;

        $cacheClassName = sprintf('\Doctrine\Common\Cache\%sCache', $this->config->getAdapterName());

        if (!class_exists($cacheClassName)) {
            throw new InvalidCacheConfigException('Cache Adapter Not Supported!');
        }

        /** @var CacheProvider $cacheProvider */
        $cacheProvider = new $cacheClassName();
        if (!$this->isValidConfig($this->config)) {

            throw new InvalidCacheConfig('Options Not Supported Passed');
        }

        return $this->decorateWithConnectable($cacheProvider);

    }

    /**
     * @param CacheProvider $cacheProvider
     * @return CacheProvider
     */
    abstract protected function decorateWithConnectable(CacheProvider $cacheProvider);

    /**
     * @param Config $config
     * @return bool
     */
    abstract protected function isValidConfig(Config $config);
}
