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

use App\Service\BasketService;

class UserController extends AbstractController
{

/////////////////////////////////////////////////////////////////////////////////////////

    /**
     * 
     * Permet à un client/prospect de s'enregistrer et d'ouvrir un compte
     * 
     * @Route("/user/register", name="register")
     */
    public function register(Request $request, UserAddressService $useraddressService, UserPasswordEncoderInterface $passwordEncoder, BasketService $basketService)
    {
        // Utilisateur / Address
        $user = new User();

        // create form
        $form = $this->createForm( UserType::class, $user, array( 'method' => 'GET' ) );

        // gére les envois de formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // si il y a du contenu dans les variables
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

           
            return $this->redirectToRoute('login');
        }

        return $this->render('user/register.html.twig', [
            'controller_name' => 'Inscription',
            'title' => 'Inscription',
            'registerNav' => true,
            'form' => $form->createView(),
            'id' => $user->getId(),
            // Basket
            'basketCountQuantity' => $basketService->countQuantity(),
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
    public function account(Request $request, UserAddressService $useraddressService, BasketService $basketService, string $id, AddressRepository $address, AccountService $accountService)
    {
        // render sur la page account{id de l'utilisateur}
        return $this->render('user/account.html.twig', [
            // titre de la page
            'title' => 'Ton compte',
            'accountNav' => true,
            'id' => $id,
            // je récupére l'utilisateur par l'id
            'user' => $useraddressService->getOneId( $id ),
            // je récupére l'address par l'id de l'utilisateur -> sur l'adresse ID de AdresseBilling
            'address' => $address->findOneById( $useraddressService->getOneId( $id )->getAddressBillingId() ),
            // je récupére les commandes par l'id
            'orders' => $accountService->getAllOrders( $id ),
            // je récupére les information des commandes par l'id
            'orderLines' => $accountService->getAllOrderLines( $id ),
            // Basket
            'basketCountQuantity' => $basketService->countQuantity(),
        ]);
    }


/////////////////////////////////////////////////////////////////////////////////////////

    /**
     * Permet d'afficher le formulaire d'édition de compte utilisateur
     *
     * @Route("/user/account/{id}/edit", name="user_edit")
     * 
     * @return Response
     */
    public function edit(User $user, Request $request, ObjectManager $om, BasketService $basketService){

        // Création du formulaire
        $form = $this->createForm(UserType::class, $user);
        
        // Gestion des envois de formulaire
        $form->handleRequest($request);

        // condition si c'est envoyer si c'est valide
        if ($form->isSubmitted() && $form->isValid()) {

            // object manager
            $om->persist($user);
            $om->flush();

            // Flash message
            $this->addFlash('success', 'Tes modifications ont bien été enregistrées.');

            // redirection sur la page home
            return $this->redirectToRoute('home');
        }
        
        return $this->render('user/edit.html.twig',[
            'form' => $form->createView(),
            'user' => $user,
            // Basket
            'basketCountQuantity' => $basketService->countQuantity(),
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
     * Adresse mail pour changement du mot de passe
     * 
     * @Route("/forgotten_password", name="app_forgotten_password")
     */
    public function forgottenPassword(Request $request, UserPasswordEncoderInterface $encoder, \Swift_Mailer $mailer, TokenGeneratorInterface $tokenGenerator, BasketService $basketService)
    {
        // condition si la methode est 'POST'
        if ($request->isMethod('POST')) {

            // email est = a l'adresse mail qui a etait soumis
            $email = $request->request->get('email');

            // je demande a doctrine le manager
            $entityManager = $this->getDoctrine()->getManager();

            // recupération des utilisateur par email
            $user = $entityManager->getRepository(User::class)->findOneByEmail($email);

            // condition si l'uilisateur est NULL
            if ($user === null) {
                // addFlash mail inconnu
                $this->addFlash('danger', 'Email Inconnu');
                return $this->redirectToRoute('home');
            }

            // generation du token
            $token = $tokenGenerator->generateToken();

            // try catch
            try{
                // reset du token
                $user->setResetToken($token);
                // on demande au manager de flush
                $entityManager->flush();

            } catch (\Exception $e) {
                // addFlash Warning 
                $this->addFlash('warning', $e->getMessage());
                // redirection sur le home
                return $this->redirectToRoute('home');
            }
            // Génère une URL absolue
            $url = $this->generateUrl('app_reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);
            // envoi du mail
            $message = (new \Swift_Message('mots de passe oublier'))
                // de wf3tshirt@gmail.com
                ->setFrom('wf3tshirt@gmail.com')
                // a l'adresse mail qui a etait entrée
                ->setTo($user->getEmail())
                // contenue du mail
                ->setBody(
                    "Modifier votre mot de passe : " . $url,
                    'text/html'
                );
            // envoi du mail
            $mailer->send($message);
            // addflash success
            $this->addFlash('success', 'Mail envoyé');
            // redirection sur le home
            return $this->redirectToRoute('home');
        }
        // render de la page mots de passe oublier
        return $this->render('user/forgotten_password.html.twig', [
            // Basket
            'basketCountQuantity' => $basketService->countQuantity(),
        ]);
    }



/////////////////////////////////////////////////////////////////////////////////////////


    /**
     * Nouveau mot de passe
     * 
     * @Route("/reset_password/{token}", name="app_reset_password")
     */
    public function resetPassword(Request $request, string $token, UserPasswordEncoderInterface $passwordEncoder, BasketService $basketService)
    {
        // condition si la methode est 'POST'
        if ($request->isMethod('POST')) {
            // je demande a doctrine le manager
            $entityManager = $this->getDoctrine()->getManager();
            // j'attribue a l'utilisateur son token
            $user = $entityManager->getRepository(User::class)->findOneByResetToken($token);
            // condition si le token de l'utilisateur = a l'utilisateur en question
            if ($user === null) {
                // addFlash token inconnu
                $this->addFlash('danger', 'Token Inconnu');
                // redirection sur le home
                return $this->redirectToRoute('home');
            }
            // reset le token a null
            $user->setResetToken(null);
            // encode le mot de passe
            $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));
            // envoi la modification sur la BDD
            $entityManager->flush();

            // redirection sur le home
            return $this->redirectToRoute('home');
            // add flash mot de passe mis a jour
            $this->addFlash('notice', 'Mot de passe mis à jour');
        } else {
            // render sur la page resetpassword
            return $this->render('user/reset_password.html.twig', [
                'token' => $token,
                // Basket
                'basketCountQuantity' => $basketService->countQuantity(),
            ]);
        }

    }
        
}