<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DeliveryController extends AbstractController
{

       /**
     * Livraison
     * 
     * @Route("/basket/delivery", name="delivery")
     * 
     * @return render
     * 
     */
    public function delivery()
    {
        return $this->render('basket/delivery.html.twig', [
            'controller_name' => 'Livraison',
            
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
    public function mondialrelay()
    {
        return $this->render('basket/mondialrelay.html.twig', [
            'controller_name' => 'mondialrelay',
            
        ]);
    }
}

