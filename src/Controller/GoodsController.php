<?php

namespace App\Controller;

use App\Entity\Commentaires;
use App\Entity\Goods;
use App\Form\CommentairesType;
use App\Form\GoodsType;
use App\Repository\GoodsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/goods")
 */
class GoodsController extends AbstractController
{
    /**
     * @Route("/", name="goods_index", methods={"GET"})
     */
    public function index(GoodsRepository $goodsRepository): Response
    {
        return $this->render('goods/index.html.twig', [
            'goods' => $goodsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="goods_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $good = new Goods();
        $form = $this->createForm(GoodsType::class, $good);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($good);
            $entityManager->flush();

            return $this->redirectToRoute('goods_index');
        }

        return $this->render('goods/new.html.twig', [
            'good' => $good,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="goods_show", methods={"GET"})
     */
    public function show(Goods $good): Response
    {
        return $this->render('goods/show.html.twig', [
            'good' => $good,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="goods_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Goods $good): Response
    {
        $form = $this->createForm(GoodsType::class, $good);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('goods_index');
        }

        return $this->render('goods/edit.html.twig', [
            'good' => $good,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="goods_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Goods $good): Response
    {
        if ($this->isCsrfTokenValid('delete'.$good->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($good);
            $entityManager->flush();
        }

        return $this->redirectToRoute('goods_index');
    }

    /**
     * @Route("/{slug}", name="goods_app")
     */
    public function article($slug, Request $request){
        // On récupère l'article correspondant au slug
        $article = $this->getDoctrine()->getRepository(Goods::class)->findOneBy(['slug' => $slug]);
        $commentaires = $this->getDoctrine()->getRepository(Commentaires::class)->findBy([
            'articles' => $article,
            'actif' => 1
        ],['created_at' => 'desc']);
        if(!$article){
            // Si aucun article n'est trouvé, nous créons une exception
            throw $this->createNotFoundException('L\'article n\'existe pas');
        }
        // Nous créons l'instance de "Commentaires"
        $commentaire = new Commentaires();
        // Nous créons le formulaire en utilisant "CommentairesType" et on lui passe l'instance
        $form = $this->createForm(CommentairesType::class, $commentaire);
        // Nous récupérons les données
        $form->handleRequest($request);
        // Nous vérifions si le formulaire a été soumis et si les données sont valides
        if ($form->isSubmitted() && $form->isValid()) {
            // Hydrate notre commentaire avec l'article
            $commentaire->setGoods($article);
            // Hydrate notre commentaire avec la date et l'heure courants
            $commentaire->setCreatedAt(new \DateTime('now'));
            $doctrine = $this->getDoctrine()->getManager();
            // On hydrate notre instance $commentaire
            $doctrine->persist($commentaire);
            // On écrit en base de données
            $doctrine->flush();
        }
        // Si l'article existe nous envoyons les données à la vue
        return $this->render('goods/article.html.twig', [
            'form' => $form->createView(),
            'article' => $article,
            'commentaires' => $commentaires,
        ]);
    }
}
