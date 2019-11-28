<?php

namespace App\Controller;

use App\Entity\AlertUser;
use App\Entity\User;
use App\Form\AlertUserType;
use App\Repository\AlertUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/alert/user")
 */
class AlertUserController extends AbstractController
{
    /**
     * @Route("/", name="alert_user_index", methods={"GET"})
     */
    public function index(AlertUserRepository $alertUserRepository): Response
    {
        dd($alertUserRepository->findAllByUser());
        return $this->render('alert_user/index.html.twig', [
            'alert_users' => $alertUserRepository->findAllByUser(),
        ]);
    }

    /**
     * @Route("/new", name="alert_user_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        /** User $user **/
        $user = $this->getUser();
        //dd($this->getUser());
        $alertUser = new AlertUser();
        $alertUser->setIdUser($user);
        $form = $this->createForm(AlertUserType::class, $alertUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($alertUser);
            $entityManager->flush();

            return $this->redirectToRoute('alert_user_index');
        }
        return $this->render('alert_user/new.html.twig', [
            'alert_user' => $alertUser,
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/{id}", name="alert_user_show", methods={"GET"})
     */
    public function show(AlertUser $alertUser): Response
    {
        return $this->render('alert_user/show.html.twig', [
            'alert_user' => $alertUser,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="alert_user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AlertUser $alertUser): Response
    {
        $form = $this->createForm(AlertUserType::class, $alertUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('alert_user_index');
        }

        return $this->render('alert_user/edit.html.twig', [
            'alert_user' => $alertUser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="alert_user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AlertUser $alertUser): Response
    {
        if ($this->isCsrfTokenValid('delete'.$alertUser->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($alertUser);
            $entityManager->flush();
        }

        return $this->redirectToRoute('alert_user_index');
    }
}
