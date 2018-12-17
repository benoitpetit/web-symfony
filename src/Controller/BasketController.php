<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Service\TshirtService;
use App\Service\TranslateService;
use Symfony\Component\HttpFoundation\Request;


class BasketController extends AbstractController
{
    /**
     *      
     * @Route("/basket", name="basket")
     */
    public function index()
    {

        return $this->render('basket/index.html.twig', [
            'controller_name' => 'Panier',
        ]);
    }

    // public function addToBasket(Request $request, TshirtService $product, $genderFR, $color_id, $logo_id )
    // {

    // // On vérifie que le panier existe bien, sinon on le crée (tableau vide)
    //     if (!$session->has('basket')) {
    //         $session->set('basket', array());
    //     }

    // // Initialisation du panier       
    //     $basket = $session->get('basket');

    //     if (array_key_exists($id, $basket)) {
    //         if ($request->query->get('qty') != null) {
    //             $basket[$id] = $request->query->get('qty');
    //         }
                  
    //         $this->addFlash('success', 'Article ajouté avec succès !');
    //     }

    //     $session->set('basket', $basket);


    //         return $this->render('basket/index.html.twig', [
    //             'controller_name' => 'Panier',
    //             'product' => $product,
    //             'genderFR' => $genderFR,
    //             'color_id' => $color_id,
    //             'logo_id' => $logo_id,

    //         ]);
       
    
    //     public function deleteProductLine(TshirtService $products, $id)
    //     {
        //         $basket = $session->get('basket');
        
        //         if (array_key_exists($id, $basket))
        //         {
            //             unset($basket[$id]);
            //             $session->set('basket', $basket);
            //             $this->addFlash('success', 'Article supprimé avec succès !');
            //         }
            
            //         return $this->redirect($this->generateUrl('basket'));
            //     }
            
            
            
}




