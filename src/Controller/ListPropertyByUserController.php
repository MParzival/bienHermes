<?php

namespace App\Controller;

use App\Entity\BienHermes;
use App\Entity\ListPropertyByUser;
use App\Entity\User;
use App\Repository\ListPropertyByUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ListPropertyByUserController extends AbstractController
{
    /**
     * @Route("/list/property/by/user", name="list_property_by_user")
     */
    public function index()
    {
        return $this->render('list_property_by_user/index.html.twig', [
            'controller_name' => 'ListPropertyByUserController',
        ]);
    }

    /**
     * @Route("/user/{user}/bienHermes/{bienHermes}", name="property_like")
     */
    public function likeProperty(ListPropertyByUserRepository $repository, ?BienHermes $bienHermes, ?User $user)
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
                $listProperty = new ListPropertyByUser();
                $listProperty->setUser($user);
                $listProperty->setBien($bienHermes);

                $em = $this->getDoctrine()->getManager();
                $em->persist($listProperty);
                $em->flush();
            }
        }
        // dans tous les cas je redirige l'utilisateur vers la page index_Bien
        return $this->redirectToRoute('app_home');
    }

    /**
     * @Route("/user/{user}/bienHermes/{bienHermes}/notlike", name="property_notlike")
     */
    public function notLikeProperty(ListPropertyByUserRepository $repository, ?BienHermes $bienHermes, ?User $user)
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
        return $this->redirectToRoute('app_home');
    }
}
