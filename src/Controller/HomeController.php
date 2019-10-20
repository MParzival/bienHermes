<?php

namespace App\Controller;

use App\Repository\BienHermesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        $properties = $repository->findLatest();
        return $this->render('home/home.html.twig', [
            'properties' => $properties
        ]);
    }
}
