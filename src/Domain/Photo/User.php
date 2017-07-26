<?php

declare(strict_types=1);

namespace KKirsz\Photos\Domain\Photo;

use DomainException;
use KKirsz\Photos\Domain\Entity;

/**
 * @author Korneliusz Kirsz <kornel.kirsz@gmail.com>
 */
class User extends Entity
{
    /**
     *
     * @var UserId 
     */
    private $userId;
    
    /**
     *
     * @var string 
     */
    private $email;
    
    /**
     * 
     * @param UserId $userId
     * @param string $email 
     */
    public function __construct(UserId $userId, string $email) 
    {
        $this->setUserId($userId);
        $this->setEmail($email);
    }
    
    /**
     * 
     * @return UserId
     */
    public function userId() : UserId
    {
        return $this->userId;
    }
    
    /**
     * 
     * @param UserId $userId
     */
    private function setUserId(UserId $userId)
    {
        $this->userId = $userId;
    }
    
    /**
     * 
     * @return string
     */
    public function email() : string
    {
        return $this->email;
    }
    
    /**
     * 
     * @param string $email
     * @throws DomainException
     */
    private function setEmail(string $email)
    {
        $len = strlen($email);
        
        if ($len == 0) {            
            throw new DomainException('Email is required');
        }
        
        if ($len > 100) {
            throw new DomainException(
                    'Email can contain 100 characters or less');
        }

        $pattern = '/^[a-z0-9]+([\.\-][a-z0-9]+)*@[a-z0-9]+([\.\-][a-z0-9]+)*\.[a-z0-9]+([\.\-][a-z0-9]+)*$/';
        if (!preg_match($pattern, $email)) {
            throw new DomainException('Invalid email provided');
        }
        
        $this->email = $email;
    }
    
    /**
     * 
     * @param PhotoId $photoId
     * @param array $tags 
     * @return Photo
     */
    public function addPhoto(PhotoId $photoId, array $tags = []) : Photo
    {
        $photo = new Photo($photoId, $this);
        
        foreach ($tags as $tag) {
            $photo->tag($tag);
        }
        
        return $photo;
    }
    
    /**
     * 
     * @param RatingId $ratingId
     * @param Photo $photo
     * @param int $value
     * @return Rating
     */
    public function ratePhoto(RatingId $ratingId, Photo $photo, 
        int $value
    ) : Rating {
        return new Rating($ratingId, $photo, $this, $value);
    }
}