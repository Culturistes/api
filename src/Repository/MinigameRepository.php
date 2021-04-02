<?php

namespace App\Repository;

use App\Entity\Minigame;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Minigame|null find($id, $lockMode = null, $lockVersion = null)
 * @method Minigame|null findOneBy(array $criteria, array $orderBy = null)
 * @method Minigame[]    findAll()
 * @method Minigame[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MinigameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Minigame::class);
    }

    // /**
    //  * @return Minigame[] Returns an array of Minigame objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Minigame
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
