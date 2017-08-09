<?php

declare(strict_types=1);

namespace KKirsz\Photos\Test\Infrastructure\Persistence;

use KKirsz\Photos\Domain\Photo\Photo;
use KKirsz\Photos\Domain\Photo\PhotoId;
use KKirsz\Photos\Domain\Photo\PhotoRepository;
use KKirsz\Photos\Domain\Photo\Tag;
use KKirsz\Photos\Domain\Photo\TagRepository;
use KKirsz\Photos\Domain\Photo\User;
use KKirsz\Photos\Domain\Photo\UserRepository;

/**
 * @author Korneliusz Kirsz <kornel.kirsz@gmail.com>
 */
class DoctrinePhotoRepositoryTest extends EntityManagerTestCase
{
    /**
     *
     * @var PhotoRepository
     */
    private $photoRepository;
    
    /**
     *
     * @var UserRepository
     */
    private $userRepository;
    
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
        
        $this->photoRepository = $this->entityManager()
                ->getRepository(Photo::class);
        
        $this->userRepository = $this->entityManager()
                ->getRepository(User::class);
        
        $this->tagRepository = $this->entityManager()
                ->getRepository(Tag::class);
    }
    
    /**
     *
     */
    public function testAddAndFindOnePhoto()
    {
        $this->entityManager()->getConnection()->beginTransaction();
        
        $userId  = $this->userRepository->nextIdentity();
        $addedBy = new User($userId, 'kornel.kirsz@gmail.com');
        $this->userRepository->add($addedBy);
        
        $tagId  = $this->tagRepository->nextIdentity();
        $tagOne = new Tag($tagId, 'tag one');
        $this->tagRepository->add($tagOne);
        
        $tagId  = $this->tagRepository->nextIdentity();
        $tagTwo = new Tag($tagId, 'tag two');
        $this->tagRepository->add($tagTwo);
        
        $photoId = $this->photoRepository->nextIdentity();
        $this->assertInstanceOf(PhotoId::class, $photoId);
        
        $photo = new Photo($photoId, $addedBy);
        $photo->tag($tagOne);
        $photo->tag($tagTwo);
        $this->photoRepository->add($photo);
        $this->entityManager()->flush();
        
        $readPhoto = $this->photoRepository->photoOfId($photoId);
        $this->assertNotNull($readPhoto);
        $this->assertEquals($photo->photoId(), $readPhoto->photoId());
        $this->assertEquals($photo->addedBy(), $readPhoto->addedBy());
        $this->assertCount(2, $readPhoto->tags());
        $this->assertArrayHasKey($tagOne->tagId()->uuid(), $readPhoto->tags());
        $this->assertContains($tagOne, $readPhoto->tags());
        $this->assertArrayHasKey($tagTwo->tagId()->uuid(), $readPhoto->tags());
        $this->assertContains($tagTwo, $readPhoto->tags());
        
        $this->entityManager()->getConnection()->rollBack();
    }
}
