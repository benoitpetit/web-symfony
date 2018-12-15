<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;

use App\Entity\User;
use App\Entity\Address;
use App\Service\UserAddressService;

use App\Form\LoginType;
use App\Form\UserType;
use App\Form\AddressType;

class UserController extends AbstractController
{
    /**
     * @Route("/user/register", name="register")
     */
    public function register(Request $request, UserAddressService $useraddressService, UserPasswordEncoderInterface $passwordEncoder )
    {
        // Utilisateur / Address
        $user = new User();
        $form = $this->createForm( UserType::class, $user, array( 'method' => 'GET' ) );

        // Contrôle les @Assert dans l'entité
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();

            // On crypte le mot de passe
            $password = $passwordEncoder->encodePassword( $user, $user->getPlainPassword() );
            $user->setPassword( $password );


            // Service - Roles / Password / ...
            $useraddressService->add( $user );

            // Flash
            $this->addFlash('success', 'Votre compte a été bien enregistré.');

            // return $this->redirectToRoute('account', [ 'id' => $user->getId() ]);
            return $this->redirectToRoute('home');
        }

        return $this->render('user/register.html.twig', [
            'title' => 'Inscription',
            'mainRegstration' => true,
            'form' => $form->createView(),
        ]);

    }

    // /**
    //  * @Route("/user/account/{id}", name="account")
    //  */
    // public function account(Request $request, UserAddressService $useraddressService, string $id )
    // {
    //     return $this->render('user/account.html.twig', [
    //         'title' => 'Votre compte',
    //         'id' => $id,
    //         'user' => $useraddressService->getOneId( $id ),
    //     ]);
    // }



    /**
     * detail global du compte utilisateur (address, order)
     * 
     * @Route("/user/account/{id}", name="account")
     * 
     * @return render
     * 
     */
    public function account(Request $request, UserAddressService $useraddressService, string $id)
    {
        // Utilisateur / Address
        $user = new User();
        // pour ma modification des informations utilisateur
        $form = $this->createForm( UserType::class, $user, array( 'method' => 'GET' ) );

        // Contrôle les @Assert dans l'entité
        $form->handleRequest($request);

        return $this->render('user/account.html.twig', [
            'controller_name' => 'Votre compte',
            'id' => $id,
            'user' => $useraddressService->getOneId( $id ),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout() {}

}