<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use App\Entity\User;
use App\Service\UserService;
use App\Form\LoginType;

class SecurityController extends AbstractController {

    /**
     * @Route("/user/login", name="login")
     */
    public function login(Request $request, UserService $userService, AuthenticationUtils $authenticationUtils) {

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $user = new User();
        $form = $this->createForm( LoginType::class, $user );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            if ( $userService->isConnected( $user ) ) {
                // $session = new Session(new NativeSessionStorage(), new AttributeBag());
                // $session->set( 'name', $user->getUsername() );
                // $session->set( 'role', $user->getRoles() );
                return $this->redirectToRoute('home');
            } else {
                return $this->redirectToRoute('login');
            };
        }

    
        return $this->render('security/login.html.twig', [
                    'title' => 'Connexion',
                    'mainNavLogin' => true,
                    'form' => $form->createView(),
                    'last_username' => $lastUsername,
                    'error' => $error,
        ]);
    }

}


    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
            
    //         if ( $userService->isConnected( $user ) ) {
    //             $session = new Session(new NativeSessionStorage(), new AttributeBag());
    //             $session->set( 'name', $user->getUsername() );
    //             $session->set( 'role', $user->getRoles() );

    //             return $this->redirectToRoute('home');
    //         } else {
    //             return $this->redirectToRoute('login');
    //         };
    //     }

    //     return $this->render('user/login.html.twig', [
    //         'title' => 'Se connecter',
    //         'mainnavLogin' => true,
    //         'lasUsername' => $authenticationUtils->getLastUsername(),
    //         'error' => $error,
    //         'form' => $form->createView(),
    //     ]);

    // }