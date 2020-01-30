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

    /**
     * requête permettant la recherche de tout les biens visible en fonction de leur numero
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
     * requête permettant la recherche des derniers bien ajouté en base par leur date d'entrée
     * @return array
     */
    public function findLatest() : array
    {
        return $this->createQueryBuilder('r')
            ->orderBy('r.dateentree', 'ASC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }

    /**
     * requête permettant la recherche des bien en top (AVP 90%)
     * @return array
     */
    public function findTopVisible() : array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.top = true')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    /**
     * requête permettant la recherche par numero de bien
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
     * requête permettant la recherche par different critères que le bien possède.
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

    /**
     * requête permettant la recherche des biens vendus
     * @return array
     */
    public function findBienSold() :array
    {
        return $this->createQueryBuilder('r')
            ->where('r.statut = true')
            ->orderBy('r.numero', 'ASC')
            ->setMaxResults(4)
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
     * requête permettant la recherche par fond de commerce
     * @return Query
     */
    public function findByFondDeCommerce(): Query
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.typetransact = 1')
            ->andWhere('p.statut = false')
            ->getQuery();
    }

    /**
     * requête permettant la recherche par local commercial
     * @return Query
     */
    public function findByLocalCommercial(): Query
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.typetransact = 4')
            ->andWhere('p.statut = false')
            ->getQuery();
    }

    /**
     * requête permettant la recherche par Immobilier d'entreprise
     * @return Query
     */
    public function findByImmobilierEntreprise() : Query
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.typetransact = 3')
            ->andWhere('p.typebien = 2')
            ->andWhere('p.statut = false')
            ->getQuery();
    }

    /**
     * requête permettant la recherche par Investissement immobilier
     * @return Query
     */
    public function findByInvestissementImmo(): Query
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.typetransact = 3')
            ->andWhere('p.prixpublic > 0')
            ->andWhere('p.statut = false')
            ->getQuery();
    }

    /**
     * Requête permettant d'afficher tous les biens dispo dans l'agence de lyon
     * @return array
     */
    public function findByAgenceLyon(): array
    {
        return $this->createQueryBuilder('ag')
            ->andWhere('ag.statut = false')
            ->andWhere('ag.top = true')
            ->andWhere('ag.codeagence = 2136')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }

    /**
     * Requête permettant d'afficher tous les biens dispo dans l'agence d'annecy
     * @return array
     */
    public function findByAgenceAnnecy(): array
    {
        return $this->createQueryBuilder('ag')
            ->andWhere('ag.statut = false')
            ->andWhere('ag.top = true')
            ->andWhere('ag.codeagence = 328')
            ->orderBy('ag.id', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }

    /**
     * Requête permettant d'afficher tous les biens dispo dans l'agence de Grenoble
     * @return array
     */
    public function findByAgenceGrenoble(): array
    {
        return $this->createQueryBuilder('ag')
            ->andWhere('ag.statut = false')
            ->andWhere('ag.top = true')
            ->andWhere('ag.codeagence = 2553')
            ->orderBy('ag.id', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }

    /**
     * Requête permettant d'afficher tous les biens dispo dans l'agence de Clermont
     * @return array
     */
    public function findByAgenceClermont(): array
    {
        return $this->createQueryBuilder('ag')
            ->andWhere('ag.statut = false')
            ->andWhere('ag.top = true')
            ->andWhere('ag.codeagence = 9007')
            ->orderBy('ag.id', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }
}
