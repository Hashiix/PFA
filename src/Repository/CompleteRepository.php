<?php

namespace App\Repository;

use App\Entity\Complete;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Complete|null find($id, $lockMode = null, $lockVersion = null)
 * @method Complete|null findOneBy(array $criteria, array $orderBy = null)
 * @method Complete[]    findAll()
 * @method Complete[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompleteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Complete::class);
    }

    // /**
    //  * @return Complete[] Returns an array of Complete objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Complete
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
