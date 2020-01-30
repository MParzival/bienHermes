<?php

namespace App\Controller;

use App\Entity\Actuality;
use App\Form\ActualityType;
use App\Repository\ActualityRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ActualityController extends AbstractController
{
    /**
     * @Route("/actuality", name="actuality_index")
     * @param ActualityRepository $repository
     * @return Response
     */
    public function index(ActualityRepository $repository) : Response
    {
        $actualities = $repository->findByLatest();
        return $this->render('actuality/blog.html.twig', [
            'actualities' => $actualities,
        ]);
    }

    /**
     * @IsGranted("ROLE_ACTUALITY")
     * @Route("/actuality/new", name="actuality_new", methods={"GET", "POST"})
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function new(Request $request)
    {
    // cas GET (Affichage)
        // Création d'une variable pour instancier un nouveau objet ACTUALITY
        $actuality = new Actuality();
        // on prepare le formulaire: on utilise le service createForm avec en arguments:
        // le formulaire généré(actualityType) et l'objet a traité par le formulaire ($actuality)
        $form = $this->createForm(ActualityType::class, $actuality);
    // cas POST (Traitement)
        // on indique au formulaire de traité la requête.
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            // on enregistre les donneés
            $em = $this->getDoctrine()->getManager();
            $em->persist($actuality);
            $em->flush();
            return $this->redirectToRoute('actuality_index');
        }
    // Pour les deux cas si le formulaire est invalide
    // on affiche le formulaire
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
