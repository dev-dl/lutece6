<?php

namespace App\Repository;

use App\Entity\DeveloperAuths;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DeveloperAuths|null find($id, $lockMode = null, $lockVersion = null)
 * @method DeveloperAuths|null findOneBy(array $criteria, array $orderBy = null)
 * @method DeveloperAuths[]    findAll()
 * @method DeveloperAuths[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeveloperAuthsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DeveloperAuths::class);
    }

    // /**
    //  * @return DeveloperAuths[] Returns an array of DeveloperAuths objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DeveloperAuths
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
