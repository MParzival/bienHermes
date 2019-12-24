<?php

namespace App\Controller;

use App\Events;
use App\Repository\PropertyAlertRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class PropertyAlertController extends AbstractController
{
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("/property/alert", name="property_alert_index")
     * @param PropertyAlertRepository $repository
     * @param EventDispatcherInterface $dispatcher
     * @return Response
     */
    public function index(PropertyAlertRepository $repository, EventDispatcherInterface $dispatcher)
    {
        $bienAlert = $repository->findByBienAndAlert();
       /* if ($this->getUser() === $user){*/
            if ($bienAlert)
            {
                $event = new GenericEvent($bienAlert);
                $dispatcher->dispatch(Events::PROPERTY_ALERT, $event);
            }
        /*}*/

        return $this->render('property_alert/index.html.twig', [
            'bienAlert' => $bienAlert,
        ]);
    }
}
