<?php

declare(strict_types=1);

namespace KKirsz\Photos\Infrastructure\Persistence;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * @author Korneliusz Kirsz <kornel.kirsz@gmail.com>
 */
abstract class DoctrineRepository extends EntityRepository
{
    /**
     * 
     * @return string
     */
    protected function uuid(): string
    {
        $sql   = 'SELECT UPPER(UUID()) AS uuid';
        $rsm   = new ResultSetMapping();
        $rsm->addScalarResult('uuid', 'uuid');
        $query = $this->getEntityManager()->createNativeQuery($sql, $rsm);        
        return $query->getSingleScalarResult();
    }
}