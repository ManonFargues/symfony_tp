<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     * @Route("/user/{id}", name="user_details")
     */
    public function details(User $user = null): Response
    {
        $user = $user ?? $this->getUser();

        if( ! $user ) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('user/details.html.twig', [
            'user' => $user
        ]);
    }
}
