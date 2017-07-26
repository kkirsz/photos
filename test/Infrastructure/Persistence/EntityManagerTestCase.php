<?php

declare(strict_types=1);

namespace KKirsz\Photos\Test\Infrastructure\Persistence;

use Doctrine\ORM\EntityManager;
use KKirsz\Photos\Test\Bootstrap;
use PHPUnit\Framework\TestCase;

/**
 * @author Korneliusz Kirsz <kornel.kirsz@gmail.com>
 */
abstract class EntityManagerTestCase extends TestCase
{
    /**
     *
     * @var EntityManager 
     */
    protected $entityManager;
    
    /**
     * 
     */
    protected function setUp() 
    {
        $this->ensureEntityManagerClosed();
        
        $name = 'doctrine.entitymanager.orm_default';
        $this->entityManager = Bootstrap::serviceManager()->get($name);
    }
    
    /**
     * 
     */
    protected function tearDown() 
    {
        $this->ensureEntityManagerClosed();
    }
    
    /**
     * 
     */
    protected function ensureEntityManagerClosed()
    {
        if (null !== $this->entityManager) {
            $this->entityManager->close();
            $this->entityManager = null;
        }
    }

    /**
     * 
     * @return EntityManager
     * @throws \UnexpectedValueException
     */
    protected function entityManager() : EntityManager
    {
        if (null === $this->entityManager) {
            throw new \UnexpectedValueException();
        }
        return $this->entityManager;
    }    
}