<?php

namespace App\Repository;

trait RepositoryTrait
{
    public function findByFollowUp($state)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.FollowUp = :val')
            ->setParameter('val', $state)
            ->getQuery()
            ->getResult();
    }
}
