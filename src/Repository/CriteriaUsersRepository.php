<?php

namespace App\Repository;

use App\Entity\CriteriaUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CriteriaUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method CriteriaUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method CriteriaUser[]    findAll()
 * @method CriteriaUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CriteriaUsersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CriteriaUser::class);
    }

    
}
