<?php

declare(strict_types=1);

namespace KKirsz\Photos\Domain\Photo;

use KKirsz\Photos\Domain\Entity;

/**
 * @author Korneliusz Kirsz <kornel.kirsz@gmail.com>
 */
class Rating extends Entity
{
    /**
     *
     * @var RatingId
     */
    private $ratingId;
    
    /**
     *
     * @var Photo
     */
    private $photo;
    
    /**
     *
     * @var User
     */
    private $ratedBy;
    
    /**
     *
     * @var int
     */
    private $value;
    
    /**
     *
     * @param RatingId $ratingId
     * @param Photo $photo
     * @param User $ratedBy
     * @param int $value
     */
    public function __construct(
        RatingId $ratingId,
        Photo $photo,
        User $ratedBy,
        int $value
    ) {
        $this->setRatingId($ratingId);
        $this->setPhoto($photo);
        $this->setRatedBy($ratedBy);
        $this->setValue($value);
    }
    
    /**
     *
     * @return RatingId
     */
    public function ratingId() : RatingId
    {
        return $this->ratingId;
    }
    
    /**
     *
     * @param RatingId $ratingId
     */
    private function setRatingId(RatingId $ratingId)
    {
        $this->ratingId = $ratingId;
    }
    
    /**
     *
     * @return Photo
     */
    public function photo() : Photo
    {
        return $this->photo;
    }
    
    /**
     *
     * @param Photo $photo
     */
    private function setPhoto(Photo $photo)
    {
        $this->photo = $photo;
    }
    
    /**
     *
     * @return User
     */
    public function ratedBy() : User
    {
        return $this->ratedBy;
    }
    
    /**
     *
     * @param User $ratedBy
     */
    private function setRatedBy(User $ratedBy)
    {
        $this->ratedBy = $ratedBy;
    }
    
    /**
     *
     * @return int
     */
    public function value() : int
    {
        return $this->value;
    }
    
    /**
     *
     * @param int $value
     * @throws \DomainException
     */
    public function setValue(int $value)
    {
        if (!in_array($value, [1, 2, 3, 4, 5], true)) {
            throw new \DomainException('Invalid value provided');
        }
        
        $this->value = $value;
    }
}
