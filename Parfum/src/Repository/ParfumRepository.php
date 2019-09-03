<?php

namespace App\Repository;

use App\Entity\Parfum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Parfum|null find($id, $lockMode = null, $lockVersion = null)
 * @method Parfum|null findOneBy(array $criteria, array $orderBy = null)
 * @method Parfum[]    findAll()
 * @method Parfum[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParfumRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Parfum::class);
    }


    public function allMenParfum()
    {
        return $this->createQueryBuilder('p')
            ->select('p')
            ->andWhere('p.sex = :val')
            ->orderBy('p.name', 'ASC')
            ->setParameter('val','man')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    public function allWomanParfum()
    {
        return $this->createQueryBuilder('p')
            ->select('p')
            ->andWhere('p.sex = :val')
            ->orderBy('p.name', 'ASC')
            ->setParameter('val','woman')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    /**
    * @return Parfum[] Returns an array of Parfum objects
    */
    public function findParfum($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }
   

    /*
    public function findOneBySomeField($value): ?Parfum
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
