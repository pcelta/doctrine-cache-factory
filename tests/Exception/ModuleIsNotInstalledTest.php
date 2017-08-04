<?php

namespace Pcelta\Doctrine\Cache\Exception;

use PHPUnit\Framework\TestCase;

class ModuleIsNotInstalledTest extends TestCase
{
    /**
     * @throws ModuleIsNotInstalled
     * @expectedException \Pcelta\Doctrine\Cache\Exception\ModuleIsNotInstalled
     * @expectedExceptionMessage Module my-module Is Not Loaded!
     */
    public function testShouldGenerateProperMessageWhenThrown()
    {
        throw new ModuleIsNotInstalled('my-module');
    }
}