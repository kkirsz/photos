<?php

declare(strict_types=1);

namespace KKirsz\Photos\Infrastructure\Persistence;

use KKirsz\Photos\Domain\Photo\Tag;
use KKirsz\Photos\Domain\Photo\TagId;
use KKirsz\Photos\Domain\Photo\TagRepository;

/**
 * @author Korneliusz Kirsz <kornel.kirsz@gmail.com>
 */
class DoctrineTagRepository extends DoctrineRepository implements TagRepository
{
    /**
     *
     * @return TagId
     */
    public function nextIdentity() : TagId
    {
        $uuid = $this->uuid();
        return new TagId($uuid);
    }
    
    /**
     *
     * @param Tag $tag
     */
    public function add(Tag $tag)
    {
        $this->getEntityManager()->persist($tag);
    }
    
    /**
     *
     * @param string $name
     * @return Tag|null
     */
    public function findByName(string $name)
    {
        return $this->findOneBy(['name' => $name]);
    }
}
