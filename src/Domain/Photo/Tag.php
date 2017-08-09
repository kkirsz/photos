<?php

declare(strict_types=1);

namespace KKirsz\Photos\Domain\Photo;

use DomainException;
use KKirsz\Photos\Domain\Entity;

/**
 * @author Korneliusz Kirsz <kornel.kirsz@gmail.com>
 */
class Tag extends Entity
{
    /**
     *
     * @var TagId
     */
    private $tagId;
    
    /**
     *
     * @var string
     */
    private $name;
    
    /**
     *
     * @param TagId $tagId
     * @param string $name
     */
    public function __construct(TagId $tagId, string $name)
    {
        $this->setTagId($tagId);
        $this->setName($name);
    }
    
    /**
     *
     * @return TagId
     */
    public function tagId() : TagId
    {
        return $this->tagId;
    }
    
    /**
     *
     * @param TagId $tagId
     */
    private function setTagId(TagId $tagId)
    {
        $this->tagId = $tagId;
    }
    
    /**
     *
     * @return string
     */
    public function name() : string
    {
        return $this->name;
    }
        
    /**
     *
     * @param string $name
     * @throws DomainException
     */
    private function setName(string $name)
    {
        $len = strlen($name);
        
        if ($len == 0) {
            throw new DomainException('Name is required');
        }
        
        if ($len > 32) {
            throw new DomainException('Name can contain 32 characters or less');
        }
        
        $this->name = $name;
    }
}
