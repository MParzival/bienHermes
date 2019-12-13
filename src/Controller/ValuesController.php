<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ValuesController extends AbstractController
{
    /**
     * @Route("/valeur", name="values_index")
     */
    public function indexValues()
    {
        return $this->render('actuality/values.html.twig', [
            'controller_name' => 'ActualityController',
        ]);
    }
}
