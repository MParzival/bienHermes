<?php

namespace App\EventSubscriber;

use App\Entity\AlertUser;
use App\Events;
use Swift_Mailer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * Class AlertNotifyCreate
 * @package App\EventSubscriber
 */
class AlertNotifyCreate implements EventSubscriberInterface
{
    /**
     * @var Swift_Mailer
     */
    private $mailer;
    /**
     * @var string
     */
    private $sender;
    public function __construct(Swift_Mailer $mailer, string $sender)
    {
        // On injecte notre expediteur et la classe pour envoyer des mails
        $this->mailer = $mailer;
        $this->sender = $sender;
    }

    public static function getSubscribedEvents()
    {
        return [
            // l'event et le nom de la fonction qui sera declenché
            Events::USER_ALERT => 'onUserCreateAlert'
        ];
    }

    public function onUserCreateAlert(GenericEvent $event)
    {
        /**
         * @var AlertUser $alertUser
         */
        $alertUser = $event->getSubject();
        $subject = "Félicitations pour la création de votre alerte";
        $body = "Merci d'avoir créée votre alerte ".$alertUser->getIdUser()->getUsername()."<br>"
            .$alertUser->getPostalCode()."<br>".$alertUser->getMaxPrice();

        $message = (new \Swift_Message())
            ->setSubject($subject)
            ->setTo($alertUser->getIdUser()->getEmail())
            ->setFrom($this->sender)
            ->setBody($body, 'text/html');
        $this->mailer->send($message);
    }


}