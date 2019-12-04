<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ContactController extends AbstractController
{

    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $renderer;

    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {

        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    /**
     * @Route("/contact", name="contact_index")
     */
    public function index(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $message = (new \Swift_Message('Agence : un message de votre agence'))
                ->setFrom('mparzival69@gmail.com')
                ->setTo($contact->getEmail())
                ->setReplyTo($contact->getEmail())
                ->setBody($this->renderer->render('contact/emailSent.html.twig',[
                    'contact' => $contact
                ]), 'text/html');
            $this->mailer->send($message);
            $this->addFlash('success', 'Votre email a bien été envoyé');
            return $this->redirectToRoute('contact_index');
        }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
