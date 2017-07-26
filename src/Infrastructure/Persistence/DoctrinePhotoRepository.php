<?php

declare(strict_types=1);

namespace KKirsz\Photos\Infrastructure\Persistence;

use KKirsz\Photos\Domain\Photo\Photo;
use KKirsz\Photos\Domain\Photo\PhotoId;
use KKirsz\Photos\Domain\Photo\PhotoRepository;

/**
 * @author Korneliusz Kirsz <kornel.kirsz@gmail.com>
 */
class DoctrinePhotoRepository
    extends DoctrineRepository
    implements PhotoRepository
{
    /**
     * 
     * @return PhotoId 
     */
    public function nextIdentity() : PhotoId
    {
        $uuid = $this->uuid();
        return new PhotoId($uuid);
    }
    
    /**
     * 
     * @param Photo $photo
     */
    public function add(Photo $photo)
    {
        $this->getEntityManager()->persist($photo);
    }
    
    /**
     * 
     * @param PhotoId $photoId
     * @return Photo|null 
     */
    public function photoOfId(PhotoId $photoId)
    {
        return $this->findOneBy(['photoId.uuid' => $photoId->uuid()]);
    }
}