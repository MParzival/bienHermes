<?php

namespace App\Controller;

use App\Entity\BienHermes;
use App\Entity\BienSearch;
use App\Form\BienSearchType;
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
     * @var ObjectManager
     */
    private $em;

    public function __construct(ObjectManager $em)
    {

        $this->em = $em;
    }

//    public function index(Request $request, BienHermesRepository $repository) :Response
//    {
//        $result = null;
//        $nomSearch = $request->request->get('nomSearch');
//        $codePostalSearch = $request->request->get('codePostalSearch');
//        $priceSearch = $request->request->get('priceSearch');
//        if ($nomSearch && $codePostalSearch && $priceSearch) {
//            $result = $repository->findByAllSearch($nomSearch, $codePostalSearch, $priceSearch);
//        }elseif ($nomSearch && $codePostalSearch) {
//            $result = $repository->findByNameAndPostalCode($nomSearch, $codePostalSearch);
//        }elseif ($nomSearch && $priceSearch) {
//            $result = $repository->findByNameAndMaxPrice($nomSearch, $priceSearch);
//        }elseif ($codePostalSearch && $priceSearch){
//            $result = $repository->findByPostalCodeAndMaxPrice($codePostalSearch, $priceSearch);
//        }elseif ($nomSearch){
//            $result = $repository->findByTitle($nomSearch);
//        }elseif ($codePostalSearch){
//            $result = $repository->findByPostalCode($codePostalSearch);
//        }elseif ($priceSearch){
//            $result = $repository->findByPrice($priceSearch);
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
        $nameSearch = $request->request->get('nameSearch');
        $codePostalSearch = $request->request->get('codePostalSearch');
        $priceSearch = $request->request->get((int)('priceSearch'));
        if ($request->isMethod('POST')){
            $result = $repository->findByCriteria($nameSearch, $codePostalSearch, $priceSearch);
        }else {
            $result = $repository->findAllVisible();
        }
        return $this->render('bien/index.html.twig', [
            'biens' => $result,
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
