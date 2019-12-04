<?php


namespace App\Repository;

use App\Entity\BienHermes;
use App\Entity\BienRefSearch;
use App\Entity\BienSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method BienHermes|null find($id, $lockMode = null, $lockVersion = null)
 * @method BienHermes|null findOneBy(array $criteria, array $orderBy = null)
 * @method BienHermes[]    findAll()
 * @method BienHermes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BienHermesRepository extends ServiceEntityRepository
{
    /**
     * @var PaginatorInterface
     */
    private $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, BienHermes::class);
        $this->paginator = $paginator;
    }


    public function findBienAndAlert()
    {
        $this->createQueryBuilder()
            ->select('bh.prixpublic', 'bh.activite','bh.codepostal')
            ->from('App:BienHermes', 'bh')
            ->leftJoin('bh.propertyAlerts', 'pa')
            ->where('bh.codepostal',
                $this->createQueryBuilder()
                    ->select('au.postalcode')
                    ->from('App:AlertUser', 'au')
            );
    }

    /**
     * @return array
     */
    public function findAllVisible() : array
    {
        return $this->createQueryBuilder('r')
            ->orderBy('r.numero', 'desc')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Query
     */
    public function findVisibleWithPaginate() : Query
    {
        return $this->createQueryBuilder('p')
            ->getQuery();
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

    /**git pull
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
            //dump($nameSearch);
            $query
                ->where('q.titreannonce LIKE :titreannonce')
                ->distinct(true)
                ->setParameter('titreannonce', '%'.$nameSearch.'%');
        }
        if ($postalCodeSearch) {
            //dump($postalCodeSearch);
            $query
                ->andWhere('q.codepostal = :codepostal')
                ->setParameter('codepostal', $postalCodeSearch);
        }
        if ($priceSearch){
            //dump($priceSearch);
            $query
                ->andWhere('q.prixpublic <= :prixpublic')
                ->setParameter('prixpublic', $priceSearch);
        }
        if ($rentSearch){
            //dump($rentSearch);
            $query
                ->andWhere('q.loyerannuel <= :loyerannuel')
                ->setParameter('loyerannuel', $rentSearch);
        }

        //dump($query->getQuery());
        return $query
            ->getQuery()
            ->getResult();
    }

    /**
     * @return array
     */
    public function findLatest() : array
    {
        return $this->createQueryBuilder('r')
            ->orderBy('r.dateentree', 'ASC')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $nomSearch
     * @return array
     */
    public function findByTitle($nomSearch) : array
    {
        return $this->createQueryBuilder('r')
            ->where('r.titreannonce LIKE :val')
            ->setParameter('val','%'.$nomSearch.'%')
            ->orderBy('r.titreannonce', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $codePostalSearch
     * @return array
     */
    public function findByPostalCode($codePostalSearch) : array
    {
        return $this->createQueryBuilder('r')
            ->where('r.codepostal = :val')
            ->setParameter('val', $codePostalSearch)
            ->orderBy('r.titreannonce', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $priceSearch
     * @return array
     */
    public function findByPrice($priceSearch) : array
    {

        return $this->createQueryBuilder('r')
            ->where('r.prixpublic < :val')
            ->setParameter('val', $priceSearch)
            ->orderBy('r.titreannonce', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $loyerSearch
     * @return array
     */
    public function findByRentPrice($loyerSearch) : array
    {
        return $this->createQueryBuilder('r')
            ->where('r.loyerannuel < :val')
            ->setParameter('val', $loyerSearch)
            ->orderBy('r.titreannonce', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return array
     */
    public function findTopVisible() : array
    {
        return $this->createQueryBuilder('r')
            ->where('r.top = true')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param BienRefSearch $bienRefSearch
     * @return array
     */
    public function findByNumero(BienRefSearch $bienRefSearch) :array
    {
        $query = $this->createQueryBuilder('r');
        $query = $query
            ->andWhere('r.numero = :numero')
            ->setParameter('numero', $bienRefSearch->getNumero());
        return $query
            ->getQuery()
            ->getResult();

    }


    /**
     * @param BienSearch $bienSearch
     * @return PaginationInterface
     */
    public function findSearchByCriteriaForm(BienSearch $bienSearch) : PaginationInterface
    {
        $query = $this->createQueryBuilder('p');
        if($bienSearch->getTitle()){
            $query = $query
                ->andWhere('p.titreannonce LIKE :titreannonce')
                ->setParameter('titreannonce', '%'.$bienSearch->getTitle().'%');
        }
        if($bienSearch->getPostalCode()){
            $query = $query
                ->andWhere('p.codepostal = :codepostal')
                ->setParameter('codepostal', $bienSearch->getPostalCode());
        }
        if($bienSearch->getMaxPrice()){
            $query = $query
                ->andWhere('p.prixpublic <= :maxprice')
                ->setParameter('maxprice', $bienSearch->getMaxPrice())
                ->andWhere('p.loyerannuel <= :loyerannuel')
                ->setParameter('loyerannuel', $bienSearch->getMaxPrice());
        }
        if ($bienSearch->getActivite()){
            $query = $query
                ->andWhere('p.activite LIKE :activite')
                ->setParameter('activite','%'.$bienSearch->getActivite().'%');
        }
        if ($bienSearch->getMinSurface()){
            $query = $query
                ->andWhere('p.surfacetotale >= :surfacetotale')
                ->setParameter('surfacetotale',$bienSearch->getMinSurface());
        }
        $query = $query->getQuery();
        return $this->paginator->paginate(
            $query,
            $bienSearch->page,15
        );

    }


    public function findBienByPropertyAlert()
    {
        return $this->getEntityManager()
            ->createQuery("SELECT bien_hermes.id, bien_hermes.PrixPublic, bien_hermes.CodePostal FROM bien_hermes
            LEFT OUTER JOIN property_alert ON bien_hermes.id = property_alert.bien_id
            WHERE bien_hermes.CodePostal = (SELECT alert_user.postal_code FROM alert_user limit 1)
            AND bien_hermes.PrixPublic <= (SELECT alert_user.max_price FROM alert_user LIMIT 1)
            AND bien_hermes.Activite LIKE CONCAT('%',(SELECT activity.name FROM alert_user JOIN activity ON alert_user.id_activity_id = activity.id),'%') 
            AND property_alert.bien_id IS null")
            ->getResult();
    }

    public function findBienSold()
    {
        return $this->createQueryBuilder('r')
            ->where('r.statut = true')
            ->orderBy('r.numero', 'ASC')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }
}
