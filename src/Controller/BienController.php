<?php

namespace App\Controller;

use App\Entity\BienHermes;
use App\Entity\WishListProperties;
use App\Repository\BienHermesRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BienController extends AbstractController
{

    /**
     * @Route("/biens", name="app_bien", methods={"GET","POST"})
     * @param Request $request
     * @param BienHermesRepository $repository
     * @return Response
     */
    public function index(Request $request, BienHermesRepository $repository, PaginatorInterface $paginator) :Response
    {


        $result = $paginator->paginate(
        $repository->findVisibleWithPaginate(),
        $request->query->getInt('page', 1),
            12
        );
        return $this->render('bien/indexAllBien.html.twig', [
           'biens' => $result,
        ]);
    }



    /**
     * @Route("/biens/{slug}-{id}", name="bien_show", requirements={"slug": "[a-z0-9\-]*"}, methods={"GET", "POST"})
     * @param string $slug
     * @param BienHermes $bienHermes
     * @return Response
     */
    public function show(string $slug, BienHermes $bienHermes): Response
    {
        if($bienHermes->getSlug() !== $slug){
           return $this->redirectToRoute('bien_show', [
               'id' => $bienHermes->getId(),
                'slug' => $bienHermes->getSlug()
            ], 301);
        }
        return $this->render('bien/show.html.twig',[
            'bien' => $bienHermes
        ]);
    }

}
