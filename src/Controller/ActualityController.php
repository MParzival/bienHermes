<?php

namespace App\Controller;

use App\Entity\Actuality;
use App\Form\ActualityType;
use App\Repository\ActualityRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ActualityController extends AbstractController
{
    /**
     * @Route("/actuality", name="actuality_index")
     */
    public function index(ActualityRepository $repository)
    {
        $actualities = $repository->findAll();
        return $this->render('actuality/blog.html.twig', [
            'actualities' => $actualities,
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/actuality/new", name="actuality_new")
     */
    public function new(Request $request)
    {
        // Création d'une variable pour instancier un nouveau objet ACTUALITY
        $actuality = new Actuality();

        // Initialisation du formulaire depuis la classe actualityType
        // et récupération de l'objet $actuality grâce à la variable créer précedement.
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
        // Initialisation du formulaire depuis la classe actualityType
        // et récupération de l'objet $actuality grâce à la variable créer précedement.
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
