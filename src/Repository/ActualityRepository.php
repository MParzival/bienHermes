<?php

namespace App\Repository;

use App\Entity\Actuality;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Actuality|null find($id, $lockMode = null, $lockVersion = null)
 * @method Actuality|null findOneBy(array $criteria, array $orderBy = null)
 * @method Actuality[]    findAll()
 * @method Actuality[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActualityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Actuality::class);
    }
    /**
     * Cette requête va recuperer les dernieres actualité créer par leur date de parution
     * @return array
     */
    public function findByLatest() : array
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.dateParution', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
