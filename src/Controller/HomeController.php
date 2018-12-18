<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use App\Service\TshirtService;
use App\Service\TranslateService;

class HomeController extends AbstractController
{
    /**
     * Page d'accueil du site
     * 
     * @Route("/", name="home")
     * 
     * @return render
     */
    public function index(SessionInterface $session, AuthenticationUtils $authenticationUtils, TshirtService $products)  
    {  
        // Ouverture de session à l'arrivée sur le site
        // $session->set('foo', 'bar');  
        // $session->get('foo');

        $error = $authenticationUtils->getLastAuthenticationError();

        $auth_checker = $this->get('security.authorization_checker');

        if ($auth_checker->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('admin');
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'Accueil',
            'productsRand' => $products->getRandomTshirtGender( 'tshirt', 'All', 4 ),
        ]);
    }

    /**
     * Page a propos de nous & nos designer
     *
     * @Route("/about", name="about")
     * 
     * @return render
     */
    public function about(){
        return $this->render('home/about.html.twig', [
            'controller_name' => 'Designers',
            'aboutNav' => true,
        ]);
    }

    /**
     * Page 404
     *
     * @Route("/404", name="errorpage")
     * 
     * @return render
     */
    public function errorPage(){
        return $this->render('404/404.html.twig', [
            'controller_name' => '404',
        ]);
    }
}
