<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ActualityController extends AbstractController
{
    /**
     * @Route("/actuality", name="actuality_index")
     */
    public function index()
    {
        return $this->render('actuality/blog.html.twig', [
            'controller_name' => 'ActualityController',
        ]);
    }

    /**
     * @Route("/actuality/cabinetHermes", name="cabinet_hermes_index")
     */
    public function indexCabinetHermes()
    {
        return $this->render('actuality/cabinetHermes.html.twig', [
            'controller_name' => 'ActualityController',
        ]);
    }

    /**
     * @Route("/actuality/values", name="values_index")
     */
    public function indexValues()
    {
        return $this->render('actuality/values.html.twig', [
            'controller_name' => 'ActualityController',
        ]);
    }
}
