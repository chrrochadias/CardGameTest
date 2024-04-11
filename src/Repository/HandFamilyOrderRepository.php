<?php

namespace App\Repository;

use App\Entity\HandFamilyOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HandFamilyOrder>
 *
 * @method HandFamilyOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method HandFamilyOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method HandFamilyOrder[]    findAll()
 * @method HandFamilyOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HandFamilyOrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HandFamilyOrder::class);
    }

    //    /**
    //     * @return HandFamilyOrder[] Returns an array of HandFamilyOrder objects
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

    //    public function findOneBySomeField($value): ?HandFamilyOrder
    //    {
    //        return $this->createQueryBuilder('h')
    //            ->andWhere('h.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
