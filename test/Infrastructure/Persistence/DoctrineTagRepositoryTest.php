<?php

declare(strict_types=1);

namespace KKirsz\Photos\Test\Infrastructure\Persistence;

use KKirsz\Photos\Domain\Photo\Tag;
use KKirsz\Photos\Domain\Photo\TagId;
use KKirsz\Photos\Domain\Photo\TagRepository;

/**
 * @author Korneliusz Kirsz <kornel.kirsz@gmail.com>
 */
class DoctrineTagRepositoryTest extends EntityManagerTestCase
{
    /**
     *
     * @var TagRepository
     */
    private $tagRepository;
    
    /**
     *
     */
    protected function setUp()
    {
        parent::setUp();
        
        $this->tagRepository = $this->entityManager()
                ->getRepository(Tag::class);
    }
    
    /**
     *
     */
    protected function tearDown()
    {
        $this->tagRepository = null;
        parent::tearDown();
    }
    
    /**
     *
     */
    public function testAddAndFindOneTag()
    {
        $this->entityManager()->getConnection()->beginTransaction();
        
        $tagId = $this->tagRepository->nextIdentity();
        $this->assertInstanceOf(TagId::class, $tagId);
                        
        $name = 'some name';
        $tag  = new Tag($tagId, $name);
        $this->tagRepository->add($tag);
        $this->entityManager()->flush();
        
        $readTag = $this->tagRepository->findByName($name);
        $this->assertNotNull($readTag);
        $this->assertEquals($tag->tagId(), $readTag->tagId());
        $this->assertEquals($tag->name(), $readTag->name());
        
        $this->entityManager()->getConnection()->rollBack();
    }
}
