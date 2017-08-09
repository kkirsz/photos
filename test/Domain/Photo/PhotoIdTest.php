<?php

declare(strict_types=1);

namespace KKirsz\Photos\Test\Domain\Photo;

use PHPUnit\Framework\TestCase;
use KKirsz\Photos\Domain\Photo\PhotoId;

/**
 * @author Korneliusz Kirsz <kornel.kirsz@gmail.com>
 */
class PhotoIdTest extends TestCase
{
    /**
     *
     * @return array
     */
    public function invalidUuidDataProvider() : array
    {
        return [
            ['80CE9784.656C-11E7-A274-0242AC120002'],
            ['80CE9784-656C.11E7-A274-0242AC120002'],
            ['80CE9784-656C-11E7.A274-0242AC120002'],
            ['80CE9784-656C-11E7-A274.0242AC120002'],
            ['80cE9784-656C-11E7-A274-0242AC120002'],
            ['80CE9784-656c-11E7-A274-0242AC120002'],
            ['80CE9784-656C-11e7-A274-0242AC120002'],
            ['80CE9784-656C-11E7-a274-0242AC120002'],
            ['80CE9784-656C-11E7-A274-0242aC120002'],
        ];
    }
    
    /**
     *
     * @dataProvider invalidUuidDataProvider
     * @param string $uuid
     */
    public function testCannotBeCreated(string $uuid)
    {
        $this->expectException(\DomainException::class);
        new PhotoId($uuid);
    }
        
    /**
     *
     * @return array
     */
    public function validUuidDataProvider() : array
    {
        return [
            ['80CE9784-656C-11E7-A274-0242AC120002'],
        ];
    }
    
    /**
     *
     * @dataProvider validUuidDataProvider
     * @param string $uuid
     */
    public function testCanBeCreatedAndIsImmutable(string $uuid)
    {
        $photoId = new PhotoId($uuid);
        $this->assertInstanceOf(PhotoId::class, $photoId);

        $photoIdCopy = clone $photoId;
        $this->assertEquals($photoId, $photoIdCopy);
        $this->assertEquals($uuid, $photoId->uuid());
        $this->assertEquals($photoId, $photoIdCopy);
    }
}
