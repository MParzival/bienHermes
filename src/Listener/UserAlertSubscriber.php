<?php
namespace App\Listener;

use App\Entity\Alert;
use App\Repository\AlertRepository;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Twig\Environment;

class UserAlertSubscriber implements EventSubscriber
{


    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return string[]
     */
    public function getSubscribedEvents()
    {
        // TODO: Implement getSubscribedEvents() method.
    }
}