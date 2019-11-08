<?php

namespace App\Repository;

use App\Entity\ListPropertyByUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ListPropertyByUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListPropertyByUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListPropertyByUser[]    findAll()
 * @method ListPropertyByUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListPropertyByUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListPropertyByUser::class);
    }

    // /**
    //  * @return ListPropertyByUser[] Returns an array of ListPropertyByUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ListPropertyByUser
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
