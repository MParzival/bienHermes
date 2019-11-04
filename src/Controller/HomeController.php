<?php

namespace App\Controller;


use App\Entity\BienRefSearch;
use App\Entity\BienSearch;
use App\Form\BienRefSearchType;
use App\Form\BienSearchType;
use App\Repository\BienHermesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     * @param BienHermesRepository $repository
     * @return Response
     */
    public function index(BienHermesRepository $repository, Request $request): Response
    {
        $biensLatest = $repository->findLatest();
        $bienTops = $repository->findTopVisible();


        $bienSearch = new BienSearch();
        $bienRefSearch = new BienRefSearch();
        $form = $this->createForm(BienSearchType::class, $bienSearch);
        $form->handleRequest($request);
        $formRef = $this->createForm(BienRefSearchType::class, $bienRefSearch);
        $formRef->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $result = $repository->findSearchByCriteriaForm($bienSearch);
            return $this->render('bien/index.html.twig', [
               'biens' => $result,
            ]);
        } elseif ($formRef->isSubmitted() && $formRef->isValid()){
            $resultRef = $repository->findByNumero($bienRefSearch);
            return $this->render('bien/show.html.twig', [
                'bienRef' => $resultRef
            ]);

        }
        return $this->render('home/home.html.twig', [
            'biensLatest' => $biensLatest,
            'bienTops' => $bienTops,
            'form' => $form->createView(),
            'formRef' => $formRef->createView(),
        ]);
    }
}

