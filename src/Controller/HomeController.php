<?php

namespace App\Controller;

use App\Entity\BienSearch;
use App\Form\BienSearchType;
use App\Repository\BienHermesRepository;
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
    public function index(BienHermesRepository $repository): Response
    {
        $biens = $repository->findLatest();
        $bienTops = $repository->findTopVisible();
        return $this->render('home/home.html.twig', [
            'biens' => $biens,
            'bienTops' => $bienTops
        ]);
    }


}

