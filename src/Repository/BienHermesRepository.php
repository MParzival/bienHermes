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


    public function findLatest() : array
    {
        return $this->findVisibleQuery()
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param BienSearch $search
     * @return Query
     */
   /* public function findAllVisibleQuery(BienSearch $search) : Query
    {
        $query = $this->findVisibleQuery();
        if ($search->getPrixMax()){
            $query = $query
                ->andWhere('r.prixpublic <= :prixMax')
                ->setParameter('prixMax', $search->getPrixMax());
        }
        if($search->getSurfaceMin()){
            $query = $query
                ->andWhere('r.surfacetotale >= :surfaceMin')
                ->setParameter('surfaceMin', $search->getSurfaceMin());
        }
            return $query->getQuery();
    }*/

    public function findAllVisible(): array
    {
        return $this->findVisibleQuery()
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

    public function findByTitleAndPostalCodeAndPrice(string $value, string $code, int $price)
    {
        $query = $this->findVisibleQuery();
        if ($value){
            $query = $query
                ->andWhere('r.titreannonce LIKE :val')
                ->setParameter('val','%'.$value.'%');
        }
        if ($code){
            $query = $query
                ->andWhere('r.codepostal LIKE :val')
                ->setParameter('val', '%'.$code.'%');
        }
        if ($price){
            $query = $query
                ->andWhere('r.prixpublic <= :val')
                ->setParameter('val', '%'.$price.'%');
        }
        return $query->getQuery();
    }

    public function findAllVisibleQuery(\App\Entity\BienSearch $search): Query
    {
        $query = $this->findVisibleQuery();

        /*if ($search->getMaxPrice()){
            $query = $query
                ->andWhere('r. <= :maxprice')
                ->setParameter('maxprice', $search->getMaxPrice());
        }*/
        if($search->getMinSurface()){
            $query = $query
                ->andWhere('r.surfacetotale >= :minsurface')
                ->setParameter('minsurface', $search->getMinSurface());
        }
        /* if($search->getNom()){
             $query = $query
                 ->andWhere('r.titreannonce LIKE :nom')
                 ->setParameter('nom', '%'.$search->getNom().'%');
         }
         if($search->getCodePostal()){
             $query = $query
                 ->andWhere('r.codepostal = :codePostal')
                 ->setParameter('codePostal', $search->getCodePostal());
         }*/

        return $query->getQuery();
    }

    private function findVisibleQuery() : QueryBuilder
    {
        return $this->createQueryBuilder('r')
            ->where('r.statut = false');
    }



}