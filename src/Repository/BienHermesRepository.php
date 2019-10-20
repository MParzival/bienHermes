<?php


namespace App\Repository;

use App\Entity\BienHermes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @method BienHermes|null find($id, $lockMode = null, $lockVersion = null)
 * @method BienHermes|null findOneBy(array $criteria, array $orderBy = null)
 * @method BienHermes[]    findAll()
 * @method BienHermes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BienHermesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BienHermes::class);
    }


    /**
     * @param $value
     * @return array
     */
    public function findByNumero($value) : array
    {
        return $this->createQueryBuilder('r')
            ->where('r.numero = :val')
            ->setParameter('val', $value)
            ->orderBy('r.numero', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return array
     */
    public function findLatest() : array
    {
        return $this->findVisibleQuery()
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    private function findVisibleQuery() : QueryBuilder
    {
        return $this->createQueryBuilder('r')
            ->where('r.statut = false');
    }

}