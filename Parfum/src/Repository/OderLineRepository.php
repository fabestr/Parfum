<?php

namespace App\Repository;

use App\Entity\OderLine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OderLine|null find($id, $lockMode = null, $lockVersion = null)
 * @method OderLine|null findOneBy(array $criteria, array $orderBy = null)
 * @method OderLine[]    findAll()
 * @method OderLine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OderLineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OderLine::class);
    }

    // /**
    //  * @return OderLine[] Returns an array of OderLine objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OderLine
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
