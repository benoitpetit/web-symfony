<?php

namespace App\Controller;

// use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\BasketService;

/** @Route("/member") */
class MemberController extends AbstractController {

    /**
     * @Route("/")
     */
    public function index(BasketService $basketService) {
        return $this->render('member/index.html.twig', [
            'mainNavMember'=>true,
            'title'=>'Espace Membre',
            // Basket
            'basketCountQuantity' => $basketService->countQuantity(),
        ]);
    }

}