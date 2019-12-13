<?php

namespace App\Controller;

use App\Entity\BienHermes;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use App\Repository\BienHermesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BienController extends AbstractController
{

    /**
     * @Route("/biens/all", name="app_bien_all", methods={"GET","POST"})
     * @param Request $request
     * @param BienHermesRepository $repository
     * @return Response
     */
    public function indexAll(Request $request, BienHermesRepository $repository, PaginatorInterface $paginator) :Response
    {
        $result = $paginator->paginate(
        $repository->findVisibleWithPaginate(),
        $request->query->getInt('page', 1),
            12
        );
        return $this->render('bien/indexAllBien.html.twig', [
           'biens' => $result,
        ]);
    }


    /**
     * @Route("/biens/{slug}-{id}", name="bien_show", requirements={"slug": "[a-z0-9\-]*"}, methods={"GET", "POST"})
     * @param string $slug
     * @param BienHermes $bienHermes
     * @return Response
     */
    public function show(string $slug, BienHermes $bienHermes, Request $request, ContactNotification $contactNotification): Response
    {
        if($bienHermes->getSlug() !== $slug){
           return $this->redirectToRoute('bien_show', [
               'id' => $bienHermes->getId(),
                'slug' => $bienHermes->getSlug()
            ], 301);
        }

        /**
         * methode permettant d'envoyer un mail de demande de renseignement
         */
        $contact = new Contact();
        $contact->setBien($bienHermes);
        $formContact = $this->createForm(ContactType::class, $contact);
        $formContact->handleRequest($request);

        if($formContact->isSubmitted() && $formContact->isValid()){
            $contactNotification->notify($contact);
            $this->addFlash('success', 'Votre email a bien été envoyé');
            return $this->redirectToRoute('bien_show', [
                'id' => $bienHermes->getId(),
                'slug' => $bienHermes->getSlug()
            ]);
        }
        return $this->render('bien/show.html.twig',[
            'bien' => $bienHermes,
            'form' => $formContact->createView()
        ]);
    }

    /**
     * @Route("/biens/fonddecommerce", name="app_bien", methods={"GET","POST"})
     * @param Request $request
     * @param BienHermesRepository $repository
     * @return Response
     */
    public function index(BienHermesRepository $repository, Request $request, PaginatorInterface $paginator)
    {
        $result = $paginator->paginate(
            $repository->findByFondDeCommerce(),
            $request->query->getInt('page', 1),12);

        return $this->render('bien/byTypeTransac.html.twig', [
            'biens' => $result,
        ]);
    }

    /**
     * @Route("/biens/localcommercial", name="app_bien_localCommercial", methods={"GET","POST"})
     * @param Request $request
     * @param BienHermesRepository $repository
     * @return Response
     */
    public function indexLocalCommercial(BienHermesRepository $repository, Request $request, PaginatorInterface $paginator)
    {
        $result = $paginator->paginate(
            $repository->findByLocalCommercial(),
            $request->query->getInt('page', 1),12);
        return $this->render('bien/byTypeTransac.html.twig', [
            'biens' => $result,
        ]);
    }

    /**
     * @Route("/biens/immobilierEntreprise", name="app_bien_immobilierEntreprise", methods={"GET","POST"})
     * @param Request $request
     * @param BienHermesRepository $repository
     * @return Response
     */
    public function indexImmobilierEntreprise(BienHermesRepository $repository, Request $request, PaginatorInterface $paginator)
    {
        $result = $paginator->paginate(
            $repository->findByImmobilierEntreprise(),
            $request->query->getInt('page', 1),12);

        return $this->render('bien/byTypeTransac.html.twig', [
            'biens' => $result,
        ]);
    }

    /**
     * @Route("/biens/investissementImmobilier", name="app_bien_investissementImmobilier", methods={"GET","POST"})
     * @param Request $request
     * @param BienHermesRepository $repository
     * @return Response
     */
    public function indexInvestissementImmobilier(BienHermesRepository $repository, Request $request, PaginatorInterface $paginator)
    {
        $result = $paginator->paginate(
            $repository->findByInvestissementImmo(),
            $request->query->getInt('page', 1),12);

        return $this->render('bien/byTypeTransac.html.twig', [
            'biens' => $result,
        ]);
    }
}
