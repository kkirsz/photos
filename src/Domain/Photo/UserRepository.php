<?php

declare(strict_types=1);

namespace KKirsz\Photos\Domain\Photo;

/**
 * @author Korneliusz Kirsz <kornel.kirsz@gmail.com>
 */
interface UserRepository
{
    /**
     * 
     * @return UserId 
     */
    public function nextIdentity() : UserId;
    
    /**
     * 
     * @param User $user
     */
    public function add(User $user);
    
    /**
     * 
     * @param string $email
     * @return User|null 
     */
    public function findByEmail(string $email);
}