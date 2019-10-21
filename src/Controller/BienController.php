<?php

namespace App\Controller;

use App\Entity\BienHermes;
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
     * @Route("/biens/{slug}-{codeagence}.{numero}", name="bien_show", requirements={"slug": "[a-z0-9\-]*"})
     * @param string $slug
     * @param BienHermes $bienHermes
     * @return Response
     */
    public function show(string $slug, BienHermes $bienHermes): Response
    {
        if($bienHermes->getSlug() !== $slug){
           return $this->redirectToRoute('bien_show', [
               'codeagence' => $bienHermes->getCodeagence(),
                'numero' => $bienHermes->getNumero(),
                'slug' => $bienHermes->getSlug()
            ], 301);
        }
        return $this->render('bien/show.html.twig',[
            'bien' => $bienHermes
        ]);
    }

    /**
     * @Route("/biens/new", name="bien_new")
     */
    public function new ()
    {

    }

}
