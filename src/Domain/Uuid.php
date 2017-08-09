<?php

declare(strict_types=1);

namespace KKirsz\Photos\Domain;

use DomainException;

/**
 * @author Korneliusz Kirsz <kornel.kirsz@gmail.com>
 */
trait Uuid
{
    /**
     *
     * @var string
     */
    private $uuid;
    
    /**
     *
     * @param string $uuid
     */
    public function __construct(string $uuid)
    {
        $this->setUuid($uuid);
    }
    
    /**
     *
     * @return string
     */
    public function uuid() : string
    {
        return $this->uuid;
    }
    
    /**
     *
     * @param string $uuid
     * @throws DomainException
     */
    private function setUuid(string $uuid)
    {
        $pattern = '/^[0-9A-F]{8}(\-[0-9A-F]{4}){3}\-[0-9A-F]{12}$/';
        if (!preg_match($pattern, $uuid)) {
            throw new DomainException('Invalid identifier provided');
        }
        
        $this->uuid = $uuid;
    }
}
