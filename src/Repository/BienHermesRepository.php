<?php


namespace App\Repository;

use App\Entity\BienHermes;
use App\Entity\BienSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
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
     * @return Query
     */
    public function findAllVisibleQuery(BienSearch $search) : Query
    {
        $query = $this->findVisibleQuery();
        if ($search->getMaxPrice()){
            $query = $query
                ->where('r.prixpublic <= :maxprice')
                ->setParameter('maxprice',$search->getMaxPrice());
        }
        return $query->getQuery();
    }

    public function findAllVisible()
    {
        return $this->findVisibleQuery()
            ->where('r.prixpublic <= 200000')
            ->getQuery()
            ->getResult();
    }

    private function findVisibleQuery() : QueryBuilder
    {
        return $this->createQueryBuilder('r')
            ->where('r.statut = false');
    }










    public function findLatest() : array
    {
        return $this->findVisibleQuery()
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }

    public function findByTitle($nomSearch)
    {
        return $this->createQueryBuilder('r')
            ->where('r.titreannonce LIKE :val')
            ->setParameter('val','%'.$nomSearch.'%')
            ->orderBy('r.titreannonce', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findByPostalCode($codePostalSearch)
    {
        return $this->createQueryBuilder('r')
            ->where('r.codepostal = :val')
            ->setParameter('val', $codePostalSearch)
            ->orderBy('r.titreannonce', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findByPrice($priceSearch)
    {
        return $this->createQueryBuilder('r')
            ->where('r.prixpublic < :val')
            ->setParameter('val', $priceSearch)
            ->orderBy('r.titreannonce', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findTopVisible()
    {
        return $this->createQueryBuilder('r')
            ->where('r.top = true')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
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





}