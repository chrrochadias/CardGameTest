<?php

namespace App\Repository;

use App\Entity\Hand;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Hand>
 *
 * @method Hand|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hand|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hand[]    findAll()
 * @method Hand[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HandRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hand::class);
    }

    public function findDistinctFamilyInHand(Hand $hand): array
    {
        $qb = $this->createQueryBuilder('h');

        return $qb
           ->select('DISTINCT cf.id')
           ->join('h.cards', 'c')
           ->join('c.cardFamily', 'cf')
           ->where('h = :hand')
           ->setParameter('hand', $hand)
           ->getQuery()
           ->getResult()
        ;
    }

    public function findDistinctValuesInHand(Hand $hand): array
    {
        $qb = $this->createQueryBuilder('h');

        return $qb
           ->select('DISTINCT cv.id')
           ->join('h.cards', 'c')
           ->join('c.cardValue', 'cv')
           ->where('h = :hand')
           ->setParameter('hand', $hand)
           ->getQuery()
           ->getResult()
        ;
    }
}
