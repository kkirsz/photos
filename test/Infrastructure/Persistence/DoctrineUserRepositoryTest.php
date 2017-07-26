<?php

declare(strict_types=1);

namespace KKirsz\Photos\Test\Infrastructure\Persistence;

use KKirsz\Photos\Domain\Photo\User;
use KKirsz\Photos\Domain\Photo\UserId;
use KKirsz\Photos\Domain\Photo\UserRepository;

/**
 * @author Korneliusz Kirsz <kornel.kirsz@gmail.com>
 */
class DoctrineUserRepositoryTest extends EntityManagerTestCase
{    
    /**
     *
     * @var UserRepository
     */
    private $userRepository;
    
    /**
     * 
     */
    protected function setUp() 
    {
        parent::setUp();
        
        $this->userRepository = $this->entityManager()
                ->getRepository(User::class);
    }
    
    /**
     * 
     */
    protected function tearDown() 
    {
        $this->userRepository = null;
        parent::tearDown();
    }
    
    /**
     * 
     */
    public function testAddAndFindOneUser()
    {
        $this->entityManager()->getConnection()->beginTransaction();
        
        $userId = $this->userRepository->nextIdentity();        
        $this->assertInstanceOf(UserId::class, $userId);
                        
        $email = 'kornel.kirsz@gmail.com';
        $user  = new User($userId, $email);
        $this->userRepository->add($user);
        $this->entityManager()->flush();
        
        $readUser = $this->userRepository->findByEmail($email);
        $this->assertNotNull($readUser);
        $this->assertEquals($user->userId(), $readUser->userId());
        $this->assertEquals($user->email(), $readUser->email());
        
        $this->entityManager()->getConnection()->rollBack();
    }
}