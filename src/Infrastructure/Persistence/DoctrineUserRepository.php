<?php

declare(strict_types=1);

namespace KKirsz\Photos\Infrastructure\Persistence;

use KKirsz\Photos\Domain\Photo\User;
use KKirsz\Photos\Domain\Photo\UserId;
use KKirsz\Photos\Domain\Photo\UserRepository;

/**
 * @author Korneliusz Kirsz <kornel.kirsz@gmail.com>
 */
class DoctrineUserRepository extends DoctrineRepository implements
    UserRepository
{
    /**
     *
     * @return UserId
     */
    public function nextIdentity(): UserId
    {
        $uuid = $this->uuid();
        return new UserId($uuid);
    }
    
    /**
     *
     * @param User $user
     */
    public function add(User $user)
    {
        $this->getEntityManager()->persist($user);
    }
    
    /**
     *
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email)
    {
        return $this->findOneBy(['email' => $email]);
    }
}
