<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
    public function payment()
    {
        return $this->render('basket/payment.html.twig', [
            'controller_name' => 'Paiement',
            
        ]);
    }

}
