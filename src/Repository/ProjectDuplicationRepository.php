<?php

namespace App\Repository;

use App\Entity\ProjectDuplication;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProjectDuplication|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectDuplication|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectDuplication[]    findAll()
 * @method ProjectDuplication[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectDuplicationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectDuplication::class);
    }

    // /**
    //  * @return ProjectDuplication[] Returns an array of ProjectDuplication objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProjectDuplication
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
