<?php

declare(strict_types=1);

namespace KKirsz\Photos\Test\Domain\Photo;

use PHPUnit\Framework\TestCase;
use KKirsz\Photos\Domain\Photo\Photo;
use KKirsz\Photos\Domain\Photo\PhotoId;
use KKirsz\Photos\Domain\Photo\Tag;
use KKirsz\Photos\Domain\Photo\TagId;
use KKirsz\Photos\Domain\Photo\User;

/**
 * @author Korneliusz Kirsz <kornel.kirsz@gmail.com>
 */
class PhotoTest extends TestCase
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
    private $user;
    
    /**
     *
     */
    protected function setUp()
    {
        $this->photoId = $this->createMock(PhotoId::class);
        $this->user    = $this->createMock(User::class);
    }
    
    /**
     *
     */
    public function testCanBeCreated()
    {
        $photo = new Photo($this->photoId, $this->user);
        $this->assertInstanceOf(Photo::class, $photo);
        $this->assertEquals($this->photoId, $photo->photoId());
        $this->assertEquals($this->user, $photo->addedBy());
        $this->assertEquals([], $photo->tags());
    }
    
    /**
     *
     */
    public function testTagCollection()
    {
        $uuidOne = 'BE8C2D2C-671D-11E7-869D-0242AC120002';
        
        $tagIdOne = $this->createMock(TagId::class);
        $tagIdOne->method('uuid')->willReturn($uuidOne);
        
        $tagOne = $this->createMock(Tag::class);
        $tagOne->method('tagId')->willReturn($tagIdOne);
        
        $uuidTwo = 'B6C93A27-671E-11E7-869D-0242AC120002';
        
        $tagIdTwo = $this->createMock(TagId::class);
        $tagIdTwo->method('uuid')->willReturn($uuidTwo);
        
        $tagTwo = $this->createMock(Tag::class);
        $tagTwo->method('tagId')->willReturn($tagIdTwo);
                        
        $photo = new Photo($this->photoId, $this->user);
        $this->assertCount(0, $photo->tags());
        
        $photo->tag($tagOne);
        $this->assertCount(1, $photo->tags());
        $this->assertArrayHasKey($uuidOne, $photo->tags());
        $this->assertContains($tagOne, $photo->tags());
        
        $photo->tag($tagOne);
        $this->assertCount(1, $photo->tags());

        $photo->tag($tagTwo);
        $this->assertCount(2, $photo->tags());
        $this->assertArrayHasKey($uuidTwo, $photo->tags());
        $this->assertContains($tagTwo, $photo->tags());
    }
}
