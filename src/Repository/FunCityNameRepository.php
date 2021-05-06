<?php

namespace App\Repository;

use App\Entity\FunCityName;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FunCityName|null find($id, $lockMode = null, $lockVersion = null)
 * @method FunCityName|null findOneBy(array $criteria, array $orderBy = null)
 * @method FunCityName[]    findAll()
 * @method FunCityName[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FunCityNameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FunCityName::class);
    }

    // /**
    //  * @return FunCityName[] Returns an array of FunCityName objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FunCityName
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
