<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Service\BasketService;

class AboutController extends AbstractController
{

/**
     * Page a propos de nous & nos designers
     *
     * @Route("/about", name="about")
     * 
     * @return render
     */
    public function about( BasketService $basketService )
    {
        return $this->render('home/about.html.twig', [
            'controller_name' => 'Designers',
            'aboutNav' => true,
            // Basket
            'basketCountQuantity' => $basketService->countQuantity(),
        ]);
    }
}