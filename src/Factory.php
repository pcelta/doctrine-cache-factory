<?php

namespace Pcelta\Doctrine\Cache;

use Pcelta\Doctrine\Cache\Entity\Config;
use Doctrine\Common\Cache\CacheProvider;
use Pcelta\Doctrine\Cache\Exception\InvalidCacheConfig;
use Pcelta\Doctrine\Cache\Factory;

class Factory
{
    /**
     * @param Proxy $proxy
     */
    public function setProxy(Proxy $proxy)
    {
        $this->proxy = $proxy;
    }

    /**
     * @param array $cacheSettings
     * @return CacheProvider
     * @throws InvalidCacheConfig
     */
    public function create(array $cacheSettings)
    {
        $config = new Config($cacheSettings);

        $class = sprintf('\Pcelta\Doctrine\Cache\Factory\%sFactory', $config->getAdapterName());
        if (!class_exists($class)) {
            throw new InvalidCacheConfig('');
        }

        /** @var Factory\AbstractFactory $factory */
        $this->factory = new $class();
        return $this->factory->create($config);
    }
}
