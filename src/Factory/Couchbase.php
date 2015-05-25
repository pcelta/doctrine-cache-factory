<?php

namespace Pcelta\Doctrine\Cache\Factory;

use Pcelta\Doctrine\Cache\Entity\Config;

class Couchbase extends AbstractFactory
{
    /**
     * @return string
     */
    public function getModuleName()
    {
    }

    /**
     * @param Config $config
     *
     * @return \Couchbase
     */
    public function create(Config $config)
    {
    }
}
