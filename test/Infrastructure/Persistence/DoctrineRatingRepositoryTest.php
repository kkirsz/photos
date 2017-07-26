<?php

declare(strict_types=1);

namespace KKirsz\Photos\Test\Infrastructure\Persistence;

use KKirsz\Photos\Domain\Photo\Photo;
use KKirsz\Photos\Domain\Photo\PhotoRepository;
use KKirsz\Photos\Domain\Photo\Rating;
use KKirsz\Photos\Domain\Photo\RatingId;
use KKirsz\Photos\Domain\Photo\RatingRepository;
use KKirsz\Photos\Domain\Photo\User;
use KKirsz\Photos\Domain\Photo\UserRepository;

/**
 * @author Korneliusz Kirsz <kornel.kirsz@gmail.com>
 */
class DoctrineRatingRepositoryTest extends EntityManagerTestCase 
{
    /**
     *
     * @var PhotoRepository 
     */
    private $photoRepository;
    
    /**
     *
     * @var RatingRepository 
     */
    private $ratingRepository;
    
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
        
        $this->photoRepository = $this->entityManager()
                ->getRepository(Photo::class);
        
        $this->ratingRepository = $this->entityManager()
                ->getRepository(Rating::class);
        
        $this->userRepository = $this->entityManager()
                ->getRepository(User::class);
    }
    
    /**
     * 
     */
    public function testAddAndFindOneRating()
    {
        $this->entityManager()->getConnection()->beginTransaction();
        
        $userId  = $this->userRepository->nextIdentity();
        $photoId = $this->photoRepository->nextIdentity();
        $user    = new User($userId, 'kornel.kirsz@gmail.com');
        $photo   = $user->addPhoto($photoId);
        $this->userRepository->add($user);
        $this->photoRepository->add($photo);
        
        $ratingId = $this->ratingRepository->nextIdentity();
        $this->assertInstanceOf(RatingId::class, $ratingId);
        
        $rating = new Rating($ratingId, $photo, $user, 3);
        $this->ratingRepository->add($rating);
        $this->entityManager()->flush();
        
        $readRating = $this->ratingRepository
                           ->findPhotoRatingByUser($photo, $user);
        $this->assertNotNull($readRating);
        $this->assertEquals($rating->ratingId(), $readRating->ratingId());
        $this->assertEquals($rating->photo(), $readRating->photo());
        $this->assertEquals($rating->ratedBy(), $readRating->ratedBy());
        $this->assertEquals($rating->value(), $readRating->value());
        
        $this->entityManager()->getConnection()->rollBack();
    }
}