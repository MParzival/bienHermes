<?php

namespace App\Repository;

use App\Entity\AlertUser;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AlertUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method AlertUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method AlertUser[]    findAll()
 * @method AlertUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlertUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AlertUser::class);
    }


    public function getActivityWithName()
    {
        $qb = $this->createQueryBuilder('a')
            ->leftJoin('a.activity', 'n')
            ->addSelect('n.name');

        return $qb->getQuery()
            ->getResult();
    }

    public function findAllByUser()
    {
        return $this->createQueryBuilder('a')
            ->innerJoin('a.idUser', 'u')
            ->addSelect('u.id')
            ->where('a.idUser = u.id')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return AlertUser[] Returns an array of AlertUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AlertUser
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
