<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Entity\Address;
use App\Form\LoginType;
use App\Form\AddressType;
use App\Service\AccountService;

use App\Service\UserAddressService;
use App\Repository\OrdersRepository;
use App\Repository\AddressRepository;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;

class UserController extends AbstractController
{

/////////////////////////////////////////////////////////////////////////////////////////

    /**
     * 
     * Permet à un client/prospect de s'enregistrer et d'ouvrir un compte
     * 
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


            if (isset($form)) {
                $username = $form['username']->getData();
            } else {
                $username = 'undefined';
            }
            if (isset($form)) {
                $firstname = $form['firstname']->getData();
            } else {
                $firstname = 'undefined';
            }
            if (isset($form)) {
                $lastname = $form['lastname']->getData();
            } else {
                $lastname = 'undefined';
            }
            if (isset($form)) {
                $email = $form['email']->getData();
            } else {
                $email = 'undefined';
            }
            if (isset($form)) {
                $phone = $form['phone']->getData();
            } else {
                $phone = 'undefined';
            }

            $user = $form->getData();

            // On crypte le mot de passe
            $password = $passwordEncoder->encodePassword( $user, $user->getPlainPassword() );
            $user->setPassword( $password );


            // Service - Roles / Password / ...
            $useraddressService->add( $user );

            // Flash
            $this->addFlash('success', 'Ton compte a bien été enregistré.');

            // return $this->redirectToRoute('account', [ 'id' => $user->getId() ]);
            return $this->redirectToRoute('login');
        }

        return $this->render('user/register.html.twig', [
            'controller_name' => 'Inscription',
            'title' => 'Inscription',
            'registerNav' => true,
            'form' => $form->createView(),
            'id' => $user->getId(),
        ]);

    }

    /**
     * 
     * Permet à un client/prospect de voir son compte
     * 
     * @Route("/user/account/{id}", name="account")
     * 
     * @return render
     * 
     */
    public function account(Request $request, UserAddressService $useraddressService, string $id, AddressRepository $address, AccountService $accountService)
    {
        return $this->render('user/account.html.twig', [
            'title' => 'Ton compte',
            'accountNav' => true,
            'id' => $id,
            'user' => $useraddressService->getOneId( $id ),
            'address' => $address->findOneById( $useraddressService->getOneId( $id )->getAddressBillingId() ),
            'orders' => $accountService->getAllOrders( $id ),
            'orderLines' => $accountService->getAllOrderLines( $id ),
        ]);
    }

    /**
     * permet d'afficher le formulaire d'edition de compte utilisateur
     *
     * @Route("/user/account/{id}/edit", name="user_edit")
     * 
     * @return Response
     */
    public function edit(User $user, Request $request, ObjectManager $om){

        // create form
        $form = $this->createForm(UserType::class, $user);
        
        // gére les envois de formulaire
        $form->handleRequest($request);

        // condition
        if ($form->isSubmitted() && $form->isValid()) {

            // object manager
            $om->persist($user);
            $om->flush();

            // Flash
            $this->addFlash('success', 'Tes modifications ont bien été enregistrées.');

            // redirection
            return $this->redirectToRoute('home');
        }
        
        return $this->render('user/edit.html.twig',[
            'form' => $form->createView()
        ]);
    }


    /**
     * 
     * Permet à un client/prospect de se déconnecter de son compte
     * 
     * @Route("/user/logout", name="logout")
     */
    public function logout() {}

}