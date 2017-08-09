<?php

declare(strict_types=1);

namespace KKirsz\Photos\Domain;

/**
 * @author Korneliusz Kirsz <kornel.kirsz@gmail.com>
 */
abstract class IdentifiedDomainObject
{
    /**
     *
     * @var int
     */
    protected $id = -1;
}
