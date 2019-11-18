<?php

namespace App\Controller;


use App\Entity\BienRefSearch;
use App\Entity\BienSearch;
use App\Form\BienRefSearchType;
use App\Form\BienSearchType;
use App\Repository\BienHermesRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
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
        /**
         * methode permettant d'afficher les derniers bien ajoutés et les bien qui ont été mis en top
         */
        $biensLatest = $repository->findLatest();
        $bienTops = $repository->findTopVisible();

        /**
         * methode permettant la recherche d'un bien grâce une liste de de critères "$bienSearch"
         * soit directement par la référence du bien "$bienRefSearch"
         */
        $bienSearch = new BienSearch();
        $form = $this->createForm(BienSearchType::class, $bienSearch);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $result = $repository->findSearchByCriteriaForm($bienSearch);
            return $this->render('bien/index.html.twig', [
                'biens' => $result,
            ]);
        }

        /**
         * methode permettant la recherche d'un bien directement par la référence du bien "$bienRefSearch"
         */
        $bienRefSearch = new BienRefSearch();
        $formRef = $this->createForm(BienRefSearchType::class, $bienRefSearch);
        $formRef->handleRequest($request);
        if($formRef->isSubmitted() && $formRef->isValid()){
            $resultRef = $repository->findByNumero($bienRefSearch);
            return $this->render('bien/showRef.html.twig', [
                'biens' => $resultRef,
            ]);
        }

        return $this->render('home/home.html.twig', [
            'biensLatest' => $biensLatest,
            'bienTops' => $bienTops,
            'form' => $form->createView(),
            'formRef' => $formRef->createView(),
        ]);
    }


    /**
     * @Route("/ckeditor", name="ckeditor_app")
     * @return Response
     */
    public function ckeditor()
    {
        $form = $this->createFormBuilder()
            ->add('content', CKEditorType::class,[
                'config' =>[
                    'uiColor' => '#e2e2e2',
                    'toolbar' => 'full',
                    'required' => true
                ]
            ])
            ->getForm();

        return $this->render('home/ckeditor.html.twig', [
            'form' =>$form->createView()
        ]);
    }
}

