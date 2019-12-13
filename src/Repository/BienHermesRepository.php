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
     * @return Query
     */
    public function findVisibleWithPaginate() : Query
    {
        return $this->createQueryBuilder('p')
            ->getQuery();
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
     * requête permettant la recherche par fond de commerce
     * @return array
     */
    public function findByFondDeCommerce(): array
    {
        return $this->createQueryBuilder('fc')
            ->andWhere('fc.typetransact = 1')
            ->andWhere('fc.statut = false')
            ->getQuery()
            ->getResult();
    }

    /**
     * requête permettant la recherche par local commercial
     * @return array
     */
    public function findByLocalCommercial(): array
    {
        return $this->createQueryBuilder('lc')
            ->andWhere('lc.typetransact = 4')
            ->andWhere('lc.statut = false')
            ->getQuery()
            ->getResult();
    }

    /**
     * requête permettant la recherche par Immobilier d'entreprise
     * @return array
     */
    public function findByImmobilierEntreprise() : array
    {
        return $this->createQueryBuilder('lc')
            ->andWhere('lc.typetransact = 3')
            ->andWhere('lc.statut = false')
            ->getQuery()
            ->getResult();
    }

    /**
     * requête permettant la recherche par Investissement immobilier
     * @return array
     */
    public function findByInvestissementImmo(): array
    {
        return $this->createQueryBuilder('ii')
            ->andWhere('ii.typebien = 1')
            ->orWhere('ii.typebien = 2')
            ->andWhere('ii.typetransact = 3')
            ->getQuery()
            ->getResult();
    }
}
