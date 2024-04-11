<?php

namespace App\Repository;

use App\Entity\CardFamily;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CardFamily>
 *
 * @method CardFamily|null find($id, $lockMode = null, $lockVersion = null)
 * @method CardFamily|null findOneBy(array $criteria, array $orderBy = null)
 * @method CardFamily[]    findAll()
 * @method CardFamily[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CardFamilyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CardFamily::class);
    }
}
