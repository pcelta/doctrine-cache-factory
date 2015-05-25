<?php

namespace Pcelta\Doctrine\Cache;

use Pcelta\Doctrine\Cache\Entity\Config;
use Pcelta\Doctrine\Cache\Exception\InvalidCacheConfig;

class Proxy
{
    /**
     * @var Factorable
     */
    private $factory;

    /**
     * @param Config $config
     *
     * @return <Some Connection>
     */
    public function getAdapter(Config $config)
    {
        $class = sprintf('\Pcelta\Doctrine\Cache\Factory\%s', $config->getAdapterName());
        if (!class_exists($class)) {
            throw new InvalidCacheConfig('');
        }
        $this->factory = new $class();

        return $this->factory->create($config);
    }
}
