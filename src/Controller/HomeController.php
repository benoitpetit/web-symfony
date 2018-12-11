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
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'Accueil',
        ]);
    }


    // dans le homeController ou dans un nouveau controller ?
    // (ca fait beaucoup ^^)
    // - A propos de nous
    // - Nos designers
    // - Modes de livraison
    // - Modes de paiement
    // - Garantie Satisfaction
    // - Protection des données
    // - CGV
    // - Mentions légales
}
