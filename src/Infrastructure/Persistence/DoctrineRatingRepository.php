<?php

declare(strict_types=1);

namespace KKirsz\Photos\Infrastructure\Persistence;

use KKirsz\Photos\Domain\Photo\Photo;
use KKirsz\Photos\Domain\Photo\Rating;
use KKirsz\Photos\Domain\Photo\RatingId;
use KKirsz\Photos\Domain\Photo\RatingRepository;
use KKirsz\Photos\Domain\Photo\User;

/**
 * @author Korneliusz Kirsz <kornel.kirsz@gmail.com>
 */
class DoctrineRatingRepository extends DoctrineRepository implements
    RatingRepository
{
    /**
     *
     * @return RatingId
     */
    public function nextIdentity() : RatingId
    {
        $uuid = $this->uuid();
        return new RatingId($uuid);
    }
    
    /**
     *
     * @param Rating $rating
     */
    public function add(Rating $rating)
    {
        $this->getEntityManager()->persist($rating);
    }
    
    /**
     *
     * @param Photo $photo
     * @param User $ratedBy
     * @return Rating|null
     */
    public function findPhotoRatingByUser(Photo $photo, User $ratedBy)
    {
        return $this->findOneBy(['photo' => $photo, 'ratedBy' => $ratedBy]);
    }
}
