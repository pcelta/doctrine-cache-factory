<?php


namespace Pcelta\Doctrine\Cache\Factory;


use Doctrine\Common\Cache\CacheProvider;
use Pcelta\Doctrine\Cache\Entity\Config;

class ArrayFactory extends AbstractFactory
{

    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getModuleName()
    {
        return 'array';
    }

    /**
     * @param CacheProvider $cacheProvider
     * @return CacheProvider
     */
    protected function decorateWithConnectable(CacheProvider $cacheProvider)
    {
        return $cacheProvider;
    }

    /**
     * @param Config $config
     * @return bool
     */
    protected function isValidConfig(Config $config)
    {
        return true;
    }

}