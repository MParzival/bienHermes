<?php

namespace App\Controller;

use App\Repository\BienHermesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NegotiatorController extends AbstractController
{
    /**
     * @Route("/negotiator", name="negotiator_index")
     */
    public function index(BienHermesRepository $repository, PaginatorInterface $paginator,Request $request)
    {

        $biens = $paginator->paginate(
            $repository->findBienByNegociateur(),
            $request->query->getInt('page', 1),
            12
        );
        return $this->render('negotiator/index.html.twig', [
            'biens' => $biens,
        ]);
    }
}
