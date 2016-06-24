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
     * @var bool
     */
    private $isConnectable;

    /**
     * @var int
     */
    private $port;

    /**
     * @var string
     */
    private $host;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        if (!isset($config['adapter_name']) || !is_string($config['adapter_name'])) {
            throw new InvalidCacheConfig('Invalid Adapter Name. Is Not A String OR Is Missing!');
        }
        $this->adapterName = $config['adapter_name'];

        if (!isset($config['is_connectable']) || !is_bool($config['is_connectable'])) {
            throw new InvalidCacheConfig('Invalid Is Connectable. Is Not A Boolean OR Is Missing!');
        }
        $this->isConnectable = $config['is_connectable'];

        if ($config['is_connectable'] === false) {
            return;
        }

        if (!isset($config['host']) || !is_string($config['host'])) {
            throw new InvalidCacheConfig('Invalid Host Name. Is Not A String OR Is Missing!');
        }
        $this->host = $config['host'];

        if (!isset($config['port']) || !is_int($config['port'])) {
            throw new InvalidCacheConfig('Invalid Port Number. Is Not An Integer OR Is Missing!');
        }
        $this->port = $config['port'];

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
     * @return bool
     */
    public function isConnectable()
    {
        return $this->isConnectable;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getAdapterNamespace()
    {
        return $this->adapterNamespace;
    }
}
