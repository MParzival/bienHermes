<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/user/{id}", name="user_show")
     * @param User|null $user
     * @return Response
     */
    public function show(?User $user) : Response
    {
        if ($this->getUser() === $user)
        {
            return $this->render('user/show.html.twig',[
                'user' => $user
            ]);
        }
    }
}
