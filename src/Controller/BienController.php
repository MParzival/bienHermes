<?php

namespace App\Controller;

use App\Entity\BienHermes;
use App\Entity\BienRefSearch;
use App\Entity\BienSearch;
use App\Form\BienRefSearchType;
use App\Form\BienSearchType;
use App\Repository\BienHermesRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BienController extends AbstractController
{
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(ObjectManager $em)
    {

        $this->em = $em;
    }

    /**
     * @Route("/biens", name="app_bien", methods={"GET","POST"})
     * @param Request $request
     * @param BienHermesRepository $repository
     * @return Response
     */
//    public function index(Request $request, BienHermesRepository $repository) :Response
//    {
//        $result = null;
//        $nameSearch = $request->request->get('nameSearch');
//        $codePostalSearch = $request->request->get('codePostalSearch');
//        $priceSearch = $request->request->get('priceSearch');
//        if ($nameSearch && $codePostalSearch && $priceSearch) {
//            $result = $repository->findByAllSearch($nameSearch, $codePostalSearch, $priceSearch);
//            //dd($result);
//        }elseif ($nameSearch && $codePostalSearch) {
//            $result = $repository->findByNameAndPostalCode($nameSearch, $codePostalSearch);
//            //dd($result);
//        }elseif ($nameSearch && $priceSearch) {
//            $result = $repository->findByNameAndMaxPrice($nameSearch, $priceSearch);
//            //dd($result);
//        }elseif ($codePostalSearch && $priceSearch){
//            $result = $repository->findByPostalCodeAndMaxPrice($codePostalSearch, $priceSearch);
//            //dd($result);
//        }elseif ($nameSearch){
//            $result = $repository->findByTitle($nameSearch);
//            //dd($result);
//        }elseif ($codePostalSearch){
//            $result = $repository->findByPostalCode($codePostalSearch);
//            //dd($result);
//        }elseif ($priceSearch){
//            $result = $repository->findByPrice($priceSearch);
//            //dd($result);
//        }else {
//            $result = $repository->findAllVisible();
//        }
//        return $this->render('bien/index.html.twig', [
//            'biens' => $result,
//        ]);
//    }

    /**
     * @Route("/biens", name="app_bien", methods={"GET","POST"})
     * @param Request $request
     * @param BienHermesRepository $repository
     * @return Response
     */
    public function index(Request $request, BienHermesRepository $repository) :Response
    {
        $bienSearch = new BienSearch();
        $form = $this->createForm(BienSearchType::class, $bienSearch);
        $form->handleRequest($request);

        $bienRefSearch = new BienRefSearch();
        $formRef = $this->createForm(BienRefSearchType::class, $bienRefSearch);
        $formRef->handleRequest($request);

        $result = $repository->findSearchByCriteriaForm($bienSearch);


        $resultRef = $repository->findByNumero($bienRefSearch);

        return $this->render('bien/index.html.twig', [
            'biens' => $result,
            'bienRef' => $resultRef,
            'form' => $form->createView(),
            'formRef' => $formRef->createView()
        ]);
    }

    /**
     * @Route("/biens/{slug}-{codeagence}.{numero}", name="bien_show", requirements={"slug": "[a-z0-9\-]*"}, methods={"GET"})
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
