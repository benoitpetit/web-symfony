<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use App\Entity\User;
use App\Service\UserAddressService;
use App\Form\LoginType;

class SecurityController extends AbstractController {

    /**
     * @Route("/user/login", name="login")
     */
    public function login( AuthenticationUtils $authenticationUtils ) {

        // Affiche un message d'erreur si nécessaire
        $error = $authenticationUtils->getLastAuthenticationError();

        // Garde le nom d'utilisateur affiché en cas d'erreur de mot de passe
        $lastUsername = $authenticationUtils->getLastUsername();
    
        return $this->render('user/login.html.twig', [
                    'controller_name' => 'Connexion',
                    'title' => 'Connexion',
                    'mainNavLogin' => true,
                    'last_username' => $lastUsername,
                    'error' => $error,
        ]);
    }

   
     /**
     *  Redirection apres connexionBasket
     * @Route("/basket/delivery", name="delivery")
     * @IsGranted("ROLE_BUYER")
     */
    // public function postLoginRedirectAction()
    // {
    //     if (($user->hasBasket() == true) && (!empty($basket)) {
    //         return $this->redirectToRoute("delivery");
    //     } 
        
    //     if(!isset($_SESSION['basket'])) {
    //     // header('Location:login.html.twig');
    //              return $this->redirectToRoute("delivery"); 
    //         } else if(!isset($_SESSION['index'])) {
    //             return $this->redirectToRoute("index");
    //         }
    //         session_start();

    // }
}

 // /**
    //  * @Route("/user/admin", name="useradmin")
    //  */
    // public function admin() {
    //     return $this->redirectToRoute('admin');
    // }