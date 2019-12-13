<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CabinetHermesController extends AbstractController
{
    /**
     * @Route("/cabinetHermes", name="cabinet_hermes_index")
     */
    public function indexCabinetHermes()
    {
        return $this->render('actuality/cabinetHermes.html.twig', [
            'controller_name' => 'ActualityController',
        ]);
    }
}
