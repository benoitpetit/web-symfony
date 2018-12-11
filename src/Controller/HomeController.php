<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * Page d'accueil du site
     * 
     * @Route("/", name="home")
     * 
     * @return render
     */
    public function index()
    {
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
            'controller_name' => 'A propos',
        ]);
    }
}
