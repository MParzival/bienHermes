<?php

namespace App\EventSubscriber;

use App\Entity\User;
use App\Events;
use \Swift_Mailer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class RegistrationNotifySubscriber implements EventSubscriberInterface
{

    /**
     * @var Swift_Mailer
     */
    private $mailer;
    private $sender;

    public function __construct(\Swift_Mailer $mailer, $sender)
    {
        // on injecte notre expediteur et la classe pour envoyer des emails
        $this->mailer = $mailer;
        $this->sender = $sender;
    }


    public static function getSubscribedEvents(): array
    {
        return [
          // le nom de l'event et le nom de la fonction qui sera declenché
            Events::USER_REGISTERED => 'onUserRegistrated'
        ];

    }

    public function onUserRegistrated(GenericEvent $event)
    {
        /**
         * @var User $user
         */
        $user = $event->getSubject();

        $subject = "Bienvenue";
        $body = "Bienvenue sur le site du cabinet hermes";

        $message = (new \Swift_Message())
            ->setSubject($subject)
            ->setTo($user->getEmail())
            ->setFrom($this->sender)
            ->setBody($body, 'text/html')
            ;
        $this->mailer->send($message);
    }
}