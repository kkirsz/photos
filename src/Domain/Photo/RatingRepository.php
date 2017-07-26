<?php

declare(strict_types=1);

namespace KKirsz\Photos\Domain\Photo;

/**
 * @author Korneliusz Kirsz <kornel.kirsz@gmail.com>
 */
interface RatingRepository
{
    /**
     * 
     * @return RatingId 
     */
    public function nextIdentity() : RatingId;
    
    /**
     * 
     * @param Rating $rating
     */
    public function add(Rating $rating);
    
    /**
     * 
     * @param Photo $photo
     * @param User $ratedBy
     * @return Rating|null 
     */
    public function findPhotoRatingByUser(Photo $photo, User $ratedBy);            
}