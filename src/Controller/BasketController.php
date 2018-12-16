<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BasketController extends AbstractController
{
    /**
     * @Route("/basket", name="basket")
     */
    public function index()
    {
        return $this->render('basket/index.html.twig', [
            'controller_name' => 'Panier',
        ]);
    }


    
}
