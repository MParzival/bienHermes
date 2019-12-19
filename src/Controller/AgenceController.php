<?php

namespace App\Controller;

use App\Entity\BienHermes;
use App\Repository\BienHermesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/agence")
 */
class AgenceController extends AbstractController
{
    /**
     * @var BienHermesRepository
     */
    private $repository;
    /**
     * @var PaginatorInterface
     */
    private $paginator;


    public function __construct(BienHermesRepository $repository, PaginatorInterface $paginator)
    {

        $this->repository = $repository;
        $this->paginator = $paginator;

    }

    /**
     * @Route("/Lyon", name="agence_lyon")
     */
    public function indexLyon()
    {

       $biens = $this->repository->findByAgenceLyon();

        return $this->render('agence/lyon.html.twig', [
            'biens' => $biens,
        ]);
    }

    /**
     * @Route("/Annecy", name="agence_annecy")
     */
    public function indexAnnecy()
    {
        $biens = $this->repository->findByAgenceAnnecy();
        return $this->render('agence/annecy.html.twig', [
            'biens' => $biens,
        ]);
    }

    /**
     * @Route("/Grenoble", name="agence_grenoble")
     */
    public function indexGrenoble()
    {
        $bien = $this->repository->findByAgenceGrenoble();
        return $this->render('agence/grenoble.html.twig', [
            'biens' => $bien,
        ]);
    }

    /**
     * @Route("/clermont", name="agence_clermont")
     */
    public function indexClermont()
    {
        $bien = $this->repository->findByAgenceClermont();
        return $this->render('agence/clermont.html.twig', [
            'biens' => $bien,
        ]);
    }
}
