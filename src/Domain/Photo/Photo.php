<?php

declare(strict_types=1);

namespace KKirsz\Photos\Domain\Photo;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use KKirsz\Photos\Domain\Entity;

/**
 * @author Korneliusz Kirsz <kornel.kirsz@gmail.com>
 */
class Photo extends Entity
{
    /**
     *
     * @var PhotoId
     */
    private $photoId;
    
    /**
     *
     * @var User
     */
    private $addedBy;
    
    /**
     *
     * @var Collection
     */
    private $tags;
    
    /**
     *
     * @param PhotoId $photoId
     * @param User $addedBy
     */
    public function __construct(PhotoId $photoId, User $addedBy)
    {
        $this->setPhotoId($photoId);
        $this->setAddedBy($addedBy);
        $this->setTags(new ArrayCollection());
    }
    
    
    /**
     *
     * @return PhotoId
     */
    public function photoId() : PhotoId
    {
        return $this->photoId;
    }
    
    /**
     *
     * @param PhotoId $photoId
     */
    private function setPhotoId(PhotoId $photoId)
    {
        $this->photoId = $photoId;
    }
    
    /**
     *
     * @return User
     */
    public function addedBy() : User
    {
        return $this->addedBy;
    }
    
    /**
     *
     * @param User $addedBy
     */
    private function setAddedBy(User $addedBy)
    {
        $this->addedBy = $addedBy;
    }
    
    /**
     *
     * @return array
     */
    public function tags() : array
    {
        return $this->tags->toArray();
    }
        
    /**
     *
     * @param Collection $tags
     */
    private function setTags(Collection $tags)
    {
        $this->tags = $tags;
    }
    
    /**
     *
     * @param Tag $tag
     */
    public function tag(Tag $tag)
    {
        $this->tags->set($tag->tagId()->uuid(), $tag);
    }
}
