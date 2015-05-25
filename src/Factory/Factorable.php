<?php

namespace Pcelta\Doctrine\Cache\Factory;

use Pcelta\Doctrine\Cache\Entity\Config;

interface Factorable
{
    /**
     * @param Config $config
     *
     * @return mixed
     */
    public function create(Config $config);
}
