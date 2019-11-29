<?php

namespace App\Controller;

use App\Entity\BienHermes;
use App\Entity\WishList;
use App\Entity\User;
use App\Repository\WishListRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WishListController extends AbstractController
{
    /**
     * @Route("/list/property/by/user", name="wishList")
     */
    public function index()
    {
        return $this->render('wish_list_property/index.html.twig', [
            'controller_name' => 'WishListController',
        ]);
    }

    /**
     * @Route("/user/{user}/bienHermes/{bienHermes}", name="property_like")
     */
    public function likeProperty(WishListRepository $repository, ?BienHermes $bienHermes, ?User $user)
    {
        //$this fait référence à l'abstractController
        //on verifie qu'il s'agit bien du user connecté
        if ($this->getUser() === $user)
        {
            // on cherche si l'utilisateur possede deja une liste avec le bien indiqué dans l'url
            // pour eviter de dupliquer la liste
            // on cherche un objet listProperty et pas un tableau de listProperty
            $listPropertyByUser = $repository->findOneBy([
                'user' => $user,
                'bien' => $bienHermes
            ]);

            //si la liste n'existe pas en base on la créée
            if (!$listPropertyByUser)
            {
                $listProperty = new WishList();
                $listProperty->setUser($user);
                $listProperty->setBien($bienHermes);

                $em = $this->getDoctrine()->getManager();
                $em->persist($listProperty);
                $em->flush();
            }
        }
        // dans tous les cas je redirige l'utilisateur vers la page index_Bien
        return $this->redirectToRoute('bien_show', [
            'id' => $bienHermes->getId(),
            'slug' => $bienHermes->getSlug()
        ]);
    }

    /**
     * @Route("/user/{user}/bienHermes/{bienHermes}/notlike", name="property_notlike")
     */
    public function notLikeProperty(WishListRepository $repository, ?BienHermes $bienHermes, ?User $user)
    {
        //$this fait référence à l'abstractController
        //on verifie qu'il s'agit bien du user connecté
        if ($this->getUser() === $user)
        {
            // on cherche si l'utilisateur possede deja une liste avec le bien indiqué dans l'url
            // pour eviter de dupliquer la liste
            // on cherche un objet listProperty et pas un tableau de listProperty
            $listPropertyByUser = $repository->findOneBy([
                'user' => $user,
                'bien' => $bienHermes
            ]);

            if ($listPropertyByUser)
            {
                $em = $this->getDoctrine()->getManager();
                $em->remove($listPropertyByUser);
                $em->flush();
            }
        }
        // dans tous les cas je redirige l'utilisateur vers la page index_Bien
        return $this->redirectToRoute('bien_show', [
            'id' => $bienHermes->getId(),
            'slug' => $bienHermes->getSlug()
        ]);
    }
}
