<?php

namespace App\Controller;

use App\Entity\Actuality;
use App\Form\ActualityType;
use App\Repository\ActualityRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
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
     * @Route("/actuality/cabinetHermes", name="cabinet_hermes_index")
     */
    public function indexCabinetHermes()
    {
        return $this->render('actuality/cabinetHermes.html.twig', [
            'controller_name' => 'ActualityController',
        ]);
    }

    /**
     * @Route("/actuality/values", name="values_index")
     */
    public function indexValues()
    {
        return $this->render('actuality/values.html.twig', [
            'controller_name' => 'ActualityController',
        ]);
    }

    /**
     * @Route("/ckeditor", name="ckeditor_app")
     * @return Response
     */
    public function ckeditor()
    {
        $form = $this->createFormBuilder()
            ->add('content', CKEditorType::class,[
                'config' =>[
                    'uiColor' => '#e2e2e2',
                    'toolbar' => 'full',
                    'required' => true
                ]
            ])
            ->getForm();

        return $this->render('home/ckeditor.html.twig', [
            'form' =>$form->createView()
        ]);
    }
}
