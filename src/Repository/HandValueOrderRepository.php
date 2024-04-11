<?php

namespace App\Repository;

use App\Entity\HandValueOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HandValueOrder>
 *
 * @method HandValueOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method HandValueOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method HandValueOrder[]    findAll()
 * @method HandValueOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HandValueOrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HandValueOrder::class);
    }

    //    /**
    //     * @return HandValueOrder[] Returns an array of HandValueOrder objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('h')
    //            ->andWhere('h.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('h.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?HandValueOrder
    //    {
    //        return $this->createQueryBuilder('h')
    //            ->andWhere('h.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
