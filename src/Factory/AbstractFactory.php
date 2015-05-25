<?php

namespace Pcelta\Doctrine\Cache\Factory;

use Pcelta\Doctrine\Cache\Exception\ModuleIsNotInstalled;

abstract class AbstractFactory implements Factorable
{
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
}
