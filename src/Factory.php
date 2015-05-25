<?php

namespace Pcelta\Doctrine\Cache;

use Pcelta\Doctrine\Cache\Entity\Config;
use Pcelta\Doctrine\Cache\Exception\InvalidCacheConfig as InvalidCacheConfigException;
use Doctrine\Common\Cache\CacheProvider;

class Factory
{
    /**
     * @var Proxy
     */
    private $proxy;

    /**
     * @return Proxy
     */
    private function getProxy()
    {
        if (!$this->proxy instanceof Proxy) {
            $this->proxy = new Proxy();
        }

        return $this->proxy;
    }

    /**
     * @param Proxy $proxy
     */
    public function setProxy(Proxy $proxy)
    {
        $this->proxy = $proxy;
    }

    /**
     * @param array $cacheSettings
     *
     * @return CacheProvider
     */
    public function create(array $cacheSettings)
    {
        $config = new Config($cacheSettings);

        $cacheClassName = sprintf('\Doctrine\Common\Cache\%sCache', $config->getAdapterName());

        if (!class_exists($cacheClassName)) {
            throw new InvalidCacheConfigException('Cache Adapter Not Supported!');
        }

        $cacheProvider = new $cacheClassName();

        if ($config->isConnectable() === true) {
            $this->addConnection($cacheProvider, $config);
        }

        return $cacheProvider;
    }

    /**
     * @param CacheProvider $cacheProvider
     * @param Config        $config
     */
    protected function addConnection(CacheProvider $cacheProvider, Config $config)
    {
        $connection = $this->getProxy()->getAdapter($config);

        $setMethod = sprintf('set%s', $config->getAdapterName());
        $cacheProvider->$setMethod($connection);
    }
}
