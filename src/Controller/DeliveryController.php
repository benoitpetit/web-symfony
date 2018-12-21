<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use App\Service\BasketService;

class DeliveryController extends AbstractController
{

       /**
     * Livraison
     * 
     * @Route("/basket/delivery", name="delivery")
     * @IsGranted("ROLE_BUYER")
     * 
     * @return render
     * 
     */
    public function delivery(BasketService $basketService)
    {
        return $this->render('basket/delivery.html.twig', [
            'controller_name' => 'Livraison',
            // Basket
            'basketCountQuantity' => $basketService->countQuantity(),
        ]);
    }


    
       /**
     * Mondial Relay
     * 
     * @Route("/basket/mondialrelay", name="mondialrelay")
     * 
     * @return render
     * 
     */
    public function mondialrelay(BasketService $basketService)
    {
        return $this->render('basket/mondialrelay.html.twig', [
            'controller_name' => 'mondialrelay',
            // Basket
            'basketCountQuantity' => $basketService->countQuantity(),
        ]);
    }
}

