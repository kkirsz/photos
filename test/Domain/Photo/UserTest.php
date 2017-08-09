<?php

declare(strict_types=1);

namespace KKirsz\Photos\Test\Domain\Photo;

use PHPUnit\Framework\TestCase;
use KKirsz\Photos\Domain\Photo\Photo;
use KKirsz\Photos\Domain\Photo\PhotoId;
use KKirsz\Photos\Domain\Photo\Tag;
use KKirsz\Photos\Domain\Photo\TagId;
use KKirsz\Photos\Domain\Photo\User;
use KKirsz\Photos\Domain\Photo\UserId;

/**
 * @author Korneliusz Kirsz <kornel.kirsz@gmail.com>
 */
class UserTest extends TestCase
{
    /**
     *
     * @var UserId
     */
    private $userId;
    
    /**
     *
     */
    protected function setUp()
    {
        $this->userId = $this->createMock(UserId::class);
    }
    
    /**
     *
     * @return array
     */
    public function invalidEmailDataProvider() : array
    {
        $longString = '';
        for ($i = 1; $i <= 101; $i++) {
            $longString .= 'a';
        }
        
        return [
            [''],
            [$longString],
            ['invalid'],
        ];
    }
    
    /**
     *
     * @dataProvider invalidEmailDataProvider
     * @param string $email
     */
    public function testCannotBeCreated(string $email)
    {
        $this->expectException(\DomainException::class);
        new User($this->userId, $email);
    }
        
    /**
     *
     * @return array
     */
    public function validEmailDataProvider() : array
    {
        return [
            ['kornel.kirsz@gmail.com'],
        ];
    }
    
    /**
     *
     * @dataProvider validEmailDataProvider
     * @param string $email
     */
    public function testCanBeCreated(string $email)
    {
        $user = new User($this->userId, $email);
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($this->userId, $user->userId());
        $this->assertEquals($email, $user->email());
    }
    
    /**
     *
     */
    public function testCanAddPhoto()
    {
        $photoId = $this->createMock(PhotoId::class);
        
        $tagId = $this->createMock(TagId::class);
        $tagId->method('uuid')
              ->willReturn('BE8C2D2C-671D-11E7-869D-0242AC120002');
        
        $tagOne = $this->createMock(Tag::class);
        $tagOne->method('tagId')->willReturn($tagId);
        
        $tagId = $this->createMock(TagId::class);
        $tagId->method('uuid')
              ->willReturn('B6C93A27-671E-11E7-869D-0242AC120002');
        
        $tagTwo = $this->createMock(Tag::class);
        $tagTwo->method('tagId')->willReturn($tagId);
        
        $user = new User($this->userId, 'kornel.kirsz@gmail.com');
        $this->assertInstanceOf(User::class, $user);
        
        $photo = $user->addPhoto($photoId, [$tagOne, $tagTwo]);
        $this->assertInstanceOf(Photo::class, $photo);
        $this->assertEquals($photoId, $photo->photoId());
        $this->assertEquals($user, $photo->addedBy());
        $this->assertCount(2, $photo->tags());
        $this->assertArrayHasKey($tagOne->tagId()->uuid(), $photo->tags());
        $this->assertContains($tagOne, $photo->tags());
        $this->assertArrayHasKey($tagTwo->tagId()->uuid(), $photo->tags());
        $this->assertContains($tagTwo, $photo->tags());
    }
}
