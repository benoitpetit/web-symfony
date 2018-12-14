<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class HomeController extends AbstractController
{
    /**
     * Page d'accueil du site
     * 
     * @Route("/", name="home")
     * 
     * @return render
     */
    public function index(SessionInterface $session)  
    {  // Ouverture de session à l'arrivée sur le site
        $session->set('foo', 'bar');  
        $session->get('foo');

        return $this->render('home/index.html.twig', [
            'controller_name' => 'Accueil',
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
}
