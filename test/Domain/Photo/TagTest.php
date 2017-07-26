<?php

declare(strict_types=1);

namespace KKirsz\Photos\Test\Domain\Photo;

use PHPUnit\Framework\TestCase;
use KKirsz\Photos\Domain\Photo\Tag;
use KKirsz\Photos\Domain\Photo\TagId;

/**
 * @author Korneliusz Kirsz <kornel.kirsz@gmail.com>
 */
class TagTest extends TestCase
{
    /**
     *
     * @var TagId
     */
    private $tagId;
    
    /**
     * 
     */
    protected function setUp() 
    {        
        $this->tagId = $this->createMock(TagId::class);
    }
    
    /**
     * 
     * @return array
     */
    public function invalidNameDataProvider() : array
    {
        return [
            [''],
            ['abcdefghabcdefghabcdefghabcdefgha'],
        ];
    }
    
    /**
     * 
     * @dataProvider invalidNameDataProvider
     * @param string $name
     */
    public function testCannotBeCreated(string $name)
    {           
        $this->expectException(\DomainException::class);        
        new Tag($this->tagId, $name);
    }
        
    /**
     * 
     * @return array
     */
    public function validNameDataProvider() : array
    {
        return [
            ['some name'],
        ];
    }
    
    /**
     * 
     * @dataProvider validNameDataProvider
     * @param string $name
     */
    public function testCanBeCreated(string $name)
    {           
        $tag   = new Tag($this->tagId, $name);
        $this->assertInstanceOf(Tag::class, $tag);
        $this->assertEquals($this->tagId, $tag->tagId());
        $this->assertEquals($name, $tag->name());
    }
}