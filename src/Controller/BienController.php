<?php

namespace App\Controller;

use App\Repository\BienHermesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BienController extends AbstractController
{
    /**
     * @var BienHermesRepository
     */
    private $repository;

    public function __construct(BienHermesRepository $repository)
    {

        $this->repository = $repository;
    }

    /**
     * @Route("/biens", name="app_bien")
     */
    public function index()
    {
        $biens = $this->repository->findAll();
        return $this->render('bien/index.html.twig', [
            'biens' => $biens,
        ]);
    }

    /**
     * @Route("/biens/{slug}-{numero}", name="bien_show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show($slug, $numero): Response
    {
        $bien = $this->repository->findOneBy([
            'numero' => $numero
        ]);
        return $this->render('bien/show.html.twig',[
            'bien' => $bien
        ]);
    }
}
