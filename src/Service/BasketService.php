<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class BasketService {

    private $session;

    public function __construct ( SessionInterface $session ) {
        if ( $session->get('basket') == null )
            $session->set( 'basket', [] );
        $this->session = $session;
    }

    public function getProducts() {
        return $this->session->get( 'basket' );
    }

    public function addProduct( $product) {
        $products = $this->session->get( 'basket' );

        // Add product in products temp's basket
        array_push( $products, $product );

        // Add order line at basket temp (session)
        $this->session->set( 'basket', $products );

        // add flash produit -> panier
        $this->session->getFlashBag()->add('notice', 'Votre produit a été ajouté à votre panier.');
    }

    public function clearProducts() {
        $session->set( 'basket', [] );
    }

    public function countQuantity() {
            return count( $this->session->get('basket') );
    }


    // /** 
    // * Calcul du montant total pour chaque ligne de commande du panier (article) 
    // * @return Double 
    // */ 
    // public function basketTotal() 
    // { 
    //     // On initialise le montant 
    //     $total = 0; 
    //     // On  compte les articles du panier 
    //     $ProductQuantity = count($basket['product_type']); 

    //     // On calcule le total par article  
    //     for($i = 0; $i < $nb_articles; $i++) 
    //     { 
    //         $total += $basket['quantity'][$i] * $basket['price_unit_ttc'][$i]; 
    //     } 
        
    //     return $total; 
    // } 

}