<?php

namespace App\Repository;

use App\Entity\PropertyAlert;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PropertyAlert|null find($id, $lockMode = null, $lockVersion = null)
 * @method PropertyAlert|null findOneBy(array $criteria, array $orderBy = null)
 * @method PropertyAlert[]    findAll()
 * @method PropertyAlert[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyAlertRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PropertyAlert::class);
    }

    public function findByBienAndAlert()
    {
        return $this->createQueryBuilder('pa')
            ->leftJoin('pa.bien', 'pab')
            ->addSelect('pab.activite','pab.prixpublic','pab.codepostal','pab.titreannonce')
            ->join('pa.alertUser', 'paa')
            ->getQuery()
            ->getResult();

    }



    // /**
    //  * @return PropertyAlert[] Returns an array of PropertyAlert objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PropertyAlert
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
