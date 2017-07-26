<?php

declare(strict_types=1);

namespace KKirsz\Photos\Test\Domain\Photo;

use PHPUnit\Framework\TestCase;
use KKirsz\Photos\Domain\Photo\Photo;
use KKirsz\Photos\Domain\Photo\Rating;
use KKirsz\Photos\Domain\Photo\RatingId;
use KKirsz\Photos\Domain\Photo\User;

/**
 * @author Korneliusz Kirsz <kornel.kirsz@gmail.com>
 */
class RatingTest extends TestCase
{
    /**
     *
     * @var RatingId 
     */
    private $ratingId;
    
    /**
     *
     * @var Photo 
     */
    private $photo;
    
    /**
     *
     * @var User 
     */
    private $ratedBy;
    
    /**
     * 
     */
    protected function setUp() 
    {
        $this->ratingId = $this->createMock(RatingId::class);
        $this->photo    = $this->createMock(Photo::class);
        $this->ratedBy  = $this->createMock(User::class);
    }
    
    /**
     * 
     * @return array
     */
    public function invalidValueDataProvider()
    {
        return [
            [-1], [0], [6],
        ];
    }
    
    /**
     * 
     * @dataProvider invalidValueDataProvider
     * @param int $value
     */
    public function testCannotBeCreated(int $value)
    {
        $this->expectException(\DomainException::class);
        new Rating($this->ratingId, $this->photo, $this->ratedBy, $value);
    }
    
    /**
     * 
     * @return array
     */
    public function validValueDataProvider()
    {
        return [
            [1], [2], [3], [4], [5],
        ];
    }
    
    /**
     * 
     * @dataProvider validValueDataProvider
     * @param int $value
     */
    public function testCanBeCreated(int $value)
    {
        $rating = new Rating($this->ratingId, $this->photo,
                $this->ratedBy, $value);
        $this->assertInstanceOf(Rating::class, $rating);
        $this->assertEquals($this->ratingId, $rating->ratingId());
        $this->assertEquals($this->photo, $rating->photo());
        $this->assertEquals($this->ratedBy, $rating->ratedBy());
        $this->assertEquals($value, $rating->value());
    }
}