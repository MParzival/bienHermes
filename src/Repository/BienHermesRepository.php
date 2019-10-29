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
     * @param BienSearch $search
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
        if ($search->getMinSurface()){
            $query = $query
                ->andWhere('r.surfacetotale >= :minsurface')
                ->setParameter('minsurface', $search->getMinSurface());
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

    /**
     * @param string $value1
     * @param string $value2
     * @param int $value3
     * @return array
     */
    public function findByAllSearch(string $value1, string $value2 , int $value3): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.titreannonce LIKE :val1')
            ->andWhere('r.codepostal = :val2')
            ->andWhere('r.prixpublic <= :val3')
            ->setParameters([
                'val1' => '%'.$value1.'%',
                'val2' => $value2,
                'val3' => $value3
            ])
            ->orderBy('r.titreannonce', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param string $value1
     * @param string $value2
     * @return array
     */
    public function findByNameAndPostalCode(string $value1, string $value2): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.titreannonce LIKE :val1')
            ->andWhere('r.codepostal = :val2')
            ->setParameters([
                'val1' => '%'.$value1.'%',
                'val2' => $value2
            ])
            ->orderBy('r.titreannonce', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param string $value1
     * @param int $value2
     * @return array
     */
    public function findByNameAndMaxPrice(string $value1, int $value2): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.titreannonce LIKE :val1')
            ->andWhere('r.prixpublic <= :val2')
            ->setParameters([
                'val1' => '%'.$value1.'%',
                'val2' => $value2
            ])
            ->orderBy('r.titreannonce', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param string $value1
     * @param int $value2
     * @return mixed
     */
    public function findByPostalCodeAndMaxPrice(string $value1, int $value2)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.codepostal = :val1')
            ->andWhere('r.prixpublic <= :val2')
            ->setParameters([
                'val1' => $value1,
                'val2' => $value2,
            ])
            ->orderBy('r.titreannonce', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param string|null $nameSearch
     * @param string|null $postalCodeSearch
     * @param int|null $priceSearch
     * @param int|null $rentSearch
     * @return array
     */
    public function findByCriteria(string $nameSearch = null, string $postalCodeSearch = null, int $priceSearch = null, int $rentSearch = null): array
    {
        $query = $this->createQueryBuilder('q');
        if($nameSearch){
            dump($nameSearch);
            $query
                ->where('q.titreannonce LIKE :titreannonce')
                ->distinct(true)
                ->setParameter('titreannonce', '%'.$nameSearch.'%');
        }
        if ($postalCodeSearch) {
            dump($postalCodeSearch);
            $query
                ->andWhere('q.codepostal = :codepostal')
                ->setParameter('codepostal', $postalCodeSearch);
        }
        if ($priceSearch){
            dump($priceSearch);
            $query
                ->andWhere('q.prixpublic <= :prixpublic')
                ->setParameter('prixpublic', $priceSearch);
        }
        if ($rentSearch){
            dump($rentSearch);
            $query
                ->andWhere('q.loyerannuel <= :loyerannuel')
                ->setParameter('loyerannuel', $rentSearch);
        }

        dump($query->getQuery());
        return $query
            ->getQuery()
            ->getArrayResult();
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

    public function findByRentPrice($loyerSearch)
    {
        return $this->createQueryBuilder('r')
            ->where('r.loyerannuel < :val')
            ->setParameter('val', $loyerSearch)
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
            ->getResult();
    }




}
