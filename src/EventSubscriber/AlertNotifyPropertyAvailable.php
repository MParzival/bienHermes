<?php

namespace App\EventSubscriber;




use App\Events;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class AlertNotifyPropertyAvailable implements EventSubscriberInterface
{

    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    private $sender;


    public function __construct(\Swift_Mailer $mailer, string $sender)
    {

        $this->mailer = $mailer;
        $this->sender = $sender;
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * ['eventName' => 'methodName']
     *  * ['eventName' => ['methodName', $priority]]
     *  * ['eventName' => [['methodName1', $priority], ['methodName2']]]
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
            Events::PROPERTY_ALERT => 'onPropertyAvailable'
        ];
    }

    public function onPropertyAvailable(GenericEvent $event)
    {

        /**
         * @var
         */
        $propertyAlert = $event->getSubject();
        /*dd($propertyAlert);*/
        $subject = "Félicitations vous avez un nouveau bien qui correspond à vos critère";
        $body = "Merci";

        $message = (new \Swift_Message())
            ->setSubject($subject)
            ->setTo("mick.aubin@gmail.com")
            ->setFrom($this->sender)
            ->setBody($body, 'text/html');
        $this->mailer->send($message);
    }


}