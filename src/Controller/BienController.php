<?php

namespace App\Controller;

use App\Entity\BienHermes;
use App\Entity\BienSearch;
use App\Form\BienSearchType;
use App\Repository\BienHermesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BienController extends AbstractController
{

    /**
     * @Route("/biens", name="app_bien", methods={"GET", "POST"})
     */
    /*public function index()
    {
        $biens = $this->repository->findAllVisible();
        return $this->render('bien/index.html.twig', [
            'biens' => $biens,
        ]);
    }*/

    /**
     * @Route("/biens", name="app_bien", methods={"GET", "POST"})
     */
    public function index(Request $request, BienHermesRepository $repository)
    {
        $resultNom = null;
        $nomSearch = $request->request->get('nomSearch');
        if ($nomSearch) {
            $resultNom = $repository->findByTitle($nomSearch);
        } else {
            $resultNom = $repository->findAllVisible();
        }


        $resultCodePostal = null;
        $codePostalSearch = $request->get('codePostalSearch');
        if ($codePostalSearch) {
            $resultCodePostal = $repository->findByPostalCode($codePostalSearch);
        } else {
            $resultCodePostal = $repository->findAllVisible();
        }

        $resultPrice = null;
        $priceSearch = $request->request->get('priceSearch');
        if ($priceSearch) {
            $resultPrice = $repository->findByPrice($priceSearch);
        }else{
            $resultPrice = $repository->findAllVisible();

        }
        return $this->render('bien/index.html.twig', [
            'biens' => $resultNom,
            /*'biens'=> $resultCodePostal,
            'biens'=> $resultPrice,*/
        ]);
    }

    /**
     * @Route("/biens", name="app_bien")
     */
    /*public function index(Request $request)
    {
        $biens = $this->repository->findAllVisible();
        $search = new BienSearch();
        $form = $this->createForm(BienSearchType::class, $search);
        $form->handleRequest($request);
        $bienAll = $this->repository->findAllVisibleQuery($search);
        return $this->render('bien/index.html.twig', [
            'biens' => $biens,
            'bienAll' => $bienAll,
            'form' => $form->createView()
        ]);
    }*/




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

}
