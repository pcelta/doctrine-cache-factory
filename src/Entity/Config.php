<?php

namespace Pcelta\Doctrine\Cache\Entity;

use Pcelta\Doctrine\Cache\Exception\InvalidCacheConfig;

class Config
{
    /**
     * @var string
     */
    private $adapterName;

    /**
     * @var string
     */
    private $adapterNamespace = '\Doctrine\Common\Cache\%sCache';

    /**
     * @var array
     */
    private $settings = [];

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        if (!isset($config['adapter_name']) || !is_string($config['adapter_name'])) {
            throw new InvalidCacheConfig('Invalid Adapter Name. Is Not A String OR Is Missing!');
        }
        $this->adapterName = $config['adapter_name'];


        unset($config['adapter_name']);
        $this->settings = $config;

        if (isset($config['adapter_namespace'])) {
            if (!is_string($config['adapter_namespace'])) {
                throw new InvalidCacheConfig('Invalid Adapter Namespace. Is Not A String!');
            }

            $this->adapterNamespace = $config['adapter_namespace'];
        }
    }

    /**
     * @return string
     */
    public function getAdapterName()
    {
        return $this->adapterName;
    }

    /**
     * @return array
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * @return string
     */
    public function getAdapterNamespace()
    {
        return $this->adapterNamespace;
    }
}
