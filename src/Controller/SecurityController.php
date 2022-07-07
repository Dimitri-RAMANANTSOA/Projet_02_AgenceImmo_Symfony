<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login (AuthenticationUtils $authutils) : Response
    {
        $lastusername = $authutils->getLastUsername();
        $error = $authutils->getLastAuthenticationError();
        return $this->render('security/login.html.twig', parameters:[
            'last_username' => $lastusername,
            'error' => $error            
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
    }

}