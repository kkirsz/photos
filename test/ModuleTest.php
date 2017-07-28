<?php

declare(strict_types=1);

namespace KKirsz\Photos\Test;

use KKirsz\Photos\Module;
use PHPUnit\Framework\TestCase;

/**
 * @author Korneliusz Kirsz <kornel.kirsz@gmail.com>
 */
class ModuleTest extends TestCase
{
    /**
     *
     * @var Module 
     */
    private $module;
    
    /**
     * 
     */
    protected function setUp() 
    {
        $this->module = new Module();
    }
    
    /**
     * 
     */
    public function testConfigIsReturned()
    {
        $config = $this->module->getConfig();
        $this->assertInternalType('array', $config);
        $this->assertArrayHasKey('doctrine', $config);
    }
}