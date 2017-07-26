<?php

declare(strict_types=1);

namespace KKirsz\Photos\Domain\Photo;

/**
 * @author Korneliusz Kirsz <kornel.kirsz@gmail.com>
 */
interface TagRepository
{
    /**
     * 
     * @return TagId 
     */
    public function nextIdentity() : TagId;
    
    /**
     * 
     * @param Tag $tag
     */
    public function add(Tag $tag);
    
    /**
     * 
     * @param string $name
     * @return Tag|null 
     */
    public function findByName(string $name);
}
