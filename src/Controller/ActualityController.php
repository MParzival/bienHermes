<?php

namespace App\Controller;

use App\Entity\Actuality;
use App\Form\ActualityType;
use App\Repository\ActualityRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActualityController extends AbstractController
{
    /**
     * @Route("/actuality", name="actuality_index")
     */
    public function index(ActualityRepository $repository)
    {
        return $this->render('actuality/blog.html.twig', [
            'actualities' => $repository->findAll(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/actuality/new", name="actuality_new")
     */
    public function new(ActualityRepository $repository, Request $request)
    {
        $actuality = new Actuality();
        $form = $this->createForm(ActualityType::class, $actuality);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($actuality);
            $em->flush();

            return $this->redirectToRoute('actuality_index');
        }
        return $this->render('actuality/new.html.twig', [
            'actuality' => $actuality,
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/actuality/{id}/edit", name="actuality_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Actuality $actuality)
    {
        $form = $this->createForm(ActualityType::class, $actuality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('actuality_index');
        }

        return $this->render('actuality/edit.html.twig', [
            'alert_user' => $actuality,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/actuality/{id}", name="actuality_show", methods={"GET"})
     */
    public function show(Actuality $actuality)
    {
        return $this->render('actuality/show.html.twig', [
        'actualities' => $actuality,
        ]);
    }





}
