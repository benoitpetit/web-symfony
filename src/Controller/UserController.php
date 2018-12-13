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
use App\Service\UserService;

use App\Form\LoginType;
use App\Form\RegisterType;

class UserController extends AbstractController
{
    /**
     * @Route("/user/register", name="register")
     */
    public function register(Request $request, UserService $userService, UserPasswordEncoderInterface $passwordEncoder )
    {
        $user = new User();

        $form = $this->createForm( RegisterType::class, $user );

        // Contrôle les @Assert dans l'entité
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // On crypte le mot de passe
            $password = $passwordEncoder->encodePassword( $user, $user->getPlainPassword() );
            $user->setPassword( $password );

            // Service - Roles / Password / ...
            $userService->add( $user );

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

    /**
     * @Route("/user/account/{id}", name="account")
     */
    public function account(Request $request, UserService $userService, string $id )
    {
        return $this->render('user/account.html.twig', [
            'title' => 'Votre compte',
            'id' => $id,
            'user' => $userService->getOneId( $id ),
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout() {}

}