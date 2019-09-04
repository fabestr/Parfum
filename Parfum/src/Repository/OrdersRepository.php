<?php

namespace App\Repository;

use App\Entity\Orders;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Orders|null find($id, $lockMode = null, $lockVersion = null)
 * @method Orders|null findOneBy(array $criteria, array $orderBy = null)
 * @method Orders[]    findAll()
 * @method Orders[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Orders::class);
    }

    /**
    * @return Orders[] Returns an array of Orders objects
    */
    public function resumeOrder($value)
    {
        return $this->createQueryBuilder('o')
            ->select('o')
            ->Where('o.user = :val')
            ->andWhere('o.status = :status')
            ->setParameters([
                'val'=> $value,
                'status' => 'En cour'
            ])
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
   

    
    public function findOnePanier($value): ?Orders
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o. = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
  
}
