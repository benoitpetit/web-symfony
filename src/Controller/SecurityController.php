<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use App\Entity\User;
use App\Service\UserAddressService;
use App\Form\LoginType;

class SecurityController extends AbstractController {

    /**
     * @Route("/user/login", name="login")
     */
    public function login( AuthenticationUtils $authenticationUtils ) {

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
    
        return $this->render('user/login.html.twig', [
                    'controller_name' => 'Connexion',
                    'title' => 'Connexion',
                    'mainNavLogin' => true,
                    'last_username' => $lastUsername,
                    'error' => $error,
        ]);
    }

    // /**
    //  * @Route("/user/admin", name="useradmin")
    //  */
    // public function admin() {
    //     return $this->redirectToRoute('admin');
    // }


}