<?php

namespace App\Repository;

use App\Entity\AlertUser;
use App\Entity\BienHermes;
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
        return $this->createQueryBuilder('ab')
            ->Join('ab.bien', 'abb')
            ->addSelect('abb.prixpublic', 'abb.id', 'abb.codepostal')
            ->Join('ab.alert', 'aba')
            ->addSelect('aba.maxPrice', 'aba.postalCode', 'aba.id')
            ->getQuery()
            ->getResult();
    }

    public function findByPropertyAndAlert(BienHermes $bienHermes, AlertUser $alertUser)
    {
        return $this->createQueryBuilder('pa')
            ->leftJoin()


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
