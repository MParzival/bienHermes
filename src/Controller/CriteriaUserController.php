<?php

namespace App\Controller;

use App\Entity\CriteriaUser;
use App\Entity\User;
use App\Form\CriteriaUserType;
use App\Repository\CriteriaUsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/criteria/user")
 */
class CriteriaUserController extends AbstractController
{
    /**
     * @Route("/", name="criteria_user_index", methods={"GET"})
     */
    public function index(CriteriaUsersRepository $criteriaUsersRepository): Response
    {
        return $this->render('criteria_user/index.html.twig', [
            'criteria_users' => $criteriaUsersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="criteria_user_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $criteriaUser = new CriteriaUser();
        $form = $this->createForm(CriteriaUserType::class, $criteriaUser);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($criteriaUser);
            $entityManager->flush();

            return $this->redirectToRoute('criteria_user_index');
        }
        return $this->render('criteria_user/new.html.twig', [
            'criteria_user' => $criteriaUser,
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/{id}", name="criteria_user_show", methods={"GET"})
     */
    public function show(CriteriaUser $criteriaUser): Response
    {
        return $this->render('criteria_user/show.html.twig', [
            'criteria_user' => $criteriaUser,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="criteria_user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CriteriaUser $criteriaUser): Response
    {
        $form = $this->createForm(CriteriaUserType::class, $criteriaUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('criteria_user_index');
        }

        return $this->render('criteria_user/edit.html.twig', [
            'criteria_user' => $criteriaUser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="criteria_user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CriteriaUser $criteriaUser): Response
    {
        if ($this->isCsrfTokenValid('delete'.$criteriaUser->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($criteriaUser);
            $entityManager->flush();
        }

        return $this->redirectToRoute('criteria_user_index');
    }
}
