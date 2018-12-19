<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Entity\Address;
use App\Form\LoginType;
use App\Form\AddressType;
use App\Service\AccountService;

use App\Repository\UserRepository;
use App\Service\UserAddressService;
use App\Repository\OrdersRepository;

use App\Repository\AddressRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

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



/////////////////////////////////////////////////////////////////////////////////////////




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



/////////////////////////////////////////////////////////////////////////////////////////



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


/////////////////////////////////////////////////////////////////////////////////////////



    /**
     * 
     * Permet à un client/prospect de se déconnecter de son compte
     * 
     * @Route("/user/logout", name="logout")
     */
    public function logout() {}



/////////////////////////////////////////////////////////////////////////////////////////

        
        
    /**
     * entre adresse mail pour changement du mots de passe
     * 
     * @Route("/forgotten_password", name="app_forgotten_password")
     */
    public function forgottenPassword(
        Request $request,
        UserPasswordEncoderInterface $encoder,
        \Swift_Mailer $mailer,
        TokenGeneratorInterface $tokenGenerator
    ): Response
    {

        if ($request->isMethod('POST')) {

            $email = $request->request->get('email');

            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->findOneByEmail($email);

            if ($user === null) {
                $this->addFlash('danger', 'Email Inconnu');
                return $this->redirectToRoute('home');
            }
            $token = $tokenGenerator->generateToken();

            try{
                $user->setResetToken($token);
                $entityManager->flush();
            } catch (\Exception $e) {
                $this->addFlash('warning', $e->getMessage());
                return $this->redirectToRoute('home');
            }

            $url = $this->generateUrl('app_reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);

            $message = (new \Swift_Message('mots de passe oublier'))
                ->setFrom('wf3tshirt@gmail.com')
                ->setTo($user->getEmail())
                ->setBody(
                    "Modifier votre mot de passe : " . $url,
                    'text/html'
                );

            $mailer->send($message);

            $this->addFlash('success', 'Mail envoyé');

            return $this->redirectToRoute('home');
        }

        return $this->render('user/forgotten_password.html.twig');
    }



/////////////////////////////////////////////////////////////////////////////////////////



    /**
     * entre le nouveau mots de passe
     * 
     * @Route("/reset_password/{token}", name="app_reset_password")
     */
    public function resetPassword(Request $request, string $token, UserPasswordEncoderInterface $passwordEncoder)
    {

        if ($request->isMethod('POST')) {
            $entityManager = $this->getDoctrine()->getManager();

            $user = $entityManager->getRepository(User::class)->findOneByResetToken($token);

            if ($user === null) {
                $this->addFlash('danger', 'Token Inconnu');
                return $this->redirectToRoute('home');
            }

            $user->setResetToken(null);
            $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));
            $entityManager->flush();

            
            return $this->redirectToRoute('home');
            $this->addFlash('notice', 'Mot de passe mis à jour');
        }else {

            return $this->render('user/reset_password.html.twig', ['token' => $token]);
        }

    }
        
    }