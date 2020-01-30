<?php

namespace App\EventSubscriber;

use App\Entity\User;
use App\Events;
use \Swift_Mailer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Twig\Environment;

class RegistrationNotifySubscriber implements EventSubscriberInterface
{

    /**
     * @var Swift_Mailer
     */
    private $mailer;
    private $sender;
    /**
     * @var Environment
     */
    private $renderer;

    /**
     * RegistrationNotifySubscriber constructor.
     * @param Swift_Mailer $mailer
     * @param $sender
     * @param Environment $renderer
     */
    public function __construct(\Swift_Mailer $mailer, $sender, Environment $renderer)
    {
        // on injecte notre expediteur et la classe pour envoyer des emails
        $this->mailer = $mailer;
        $this->sender = $sender;
        $this->renderer = $renderer;
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

        $subject = "Bienvenue sur le site de l'agence";
        $body = "Bienvenue sur le site de l'agence"." ".$user->getUsername();

        $message = (new \Swift_Message())
            ->setSubject($subject)
            ->setTo($user->getEmail())
            ->setFrom($this->sender)
            ->setBody($this->renderer->render('emails/bienvenu.html.twig',[
                'user'=> $user
            ]), 'text/html')
            ;
        $this->mailer->send($message);
    }
}