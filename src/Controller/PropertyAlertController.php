<?php

namespace App\Controller;

use App\Events;
use App\Repository\PropertyAlertRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Routing\Annotation\Route;

class PropertyAlertController extends AbstractController
{
    /**
     * @Route("/property/alert", name="property_alert_index")
     */
    public function index(PropertyAlertRepository $repository, EventDispatcherInterface $dispatcher)
    {
        $bienAlert = $repository->findByBienAndAlert();

        if ($bienAlert)
        {
            $event = new GenericEvent($bienAlert);
            $dispatcher->dispatch(Events::PROPERTY_ALERT, $event);
        }
        return $this->render('property_alert/index.html.twig', [
            'bienAlert' => $bienAlert,
        ]);
    }
}
