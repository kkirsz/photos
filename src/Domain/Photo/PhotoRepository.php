<?php

declare(strict_types=1);

namespace KKirsz\Photos\Domain\Photo;

/**
 * @author Korneliusz Kirsz <kornel.kirsz@gmail.com>
 */
interface PhotoRepository
{
    /**
     *
     * @return PhotoId
     */
    public function nextIdentity() : PhotoId;
    
    /**
     *
     * @param Photo $photo
     */
    public function add(Photo $photo);
    
    /**
     *
     * @param PhotoId $photoId
     * @return Photo|null
     */
    public function photoOfId(PhotoId $photoId);
}
