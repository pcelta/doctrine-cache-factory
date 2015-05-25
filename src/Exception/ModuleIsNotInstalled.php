<?php

namespace Pcelta\Doctrine\Cache\Exception;

class ModuleIsNotInstalled extends \Exception
{
    /**
     * @param string $moduleName
     */
    public function __construct($moduleName)
    {
        $message = sprintf('Module %s Is Not Loaded!', $moduleName);
        parent::__construct($message);
    }
}
