<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\BasketService;

class PaymentController extends AbstractController
{

       /**
     * Paiement
     * 
     * @Route("basket/payment", name="payment")
     * 
     * @return render
     * 
     */
    public function payment(BasketService $basketService)
    {
        return $this->render('basket/payment.html.twig', [
            'controller_name' => 'Paiement',
            // Basket
            'basketCountQuantity' => $basketService->countQuantity(),
        ]);
    }

}
