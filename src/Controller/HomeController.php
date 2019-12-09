<?php

namespace App\Controller;


use App\Entity\BienHermes;
use App\Entity\BienRefSearch;
use App\Entity\BienSearch;
use App\Entity\Contact;
use App\Form\BienRefSearchType;
use App\Form\BienSearchType;
use App\Form\ContactType;
use App\Notification\ContactNotification;
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
    public function index(BienHermesRepository $repository, Request $request, ContactNotification $contactNotification): Response
    {
        /**
         * methode permettant d'afficher les derniers bien ajoutés
         * les bien qui ont été mis en top
         * et les biens qui ont été vendu
         */
        $biensLatest = $repository->findLatest();
        $bienTops = $repository->findTopVisible();
        $bienSold = $repository->findBienSold();

        /**
         * methode permettant la recherche d'un bien grâce une liste de de critères "$bienSearch"
         * soit directement par la référence du bien "$bienRefSearch"
         */
        $bienSearch = new BienSearch();
        $bienSearch->page = $request->get('page', 1);
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
            'bienSold' => $bienSold,
            'form' => $form->createView(),
            'formRef' => $formRef->createView(),
        ]);
    }
}

