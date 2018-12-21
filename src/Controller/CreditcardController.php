<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\BasketService;

class CreditcardController extends AbstractController
{

       /**
     * CreditCard
     * 
     * @Route("basket/payment/creditcard", name="creditcard")
     * 
     * @return render
     * 
     */
    public function creditcard(BasketService $basketService)
    {
        return $this->render('basket/creditcard.html.twig', [
            'controller_name' => 'Paiement par carte bancaire',
            // Basket
            'basketCountQuantity' => $basketService->countQuantity(),
        ]);
    }

}
