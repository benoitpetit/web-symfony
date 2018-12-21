<?php

namespace App\Service;

class BasketService {

    public function __construct () {}

    public function countQuantity() {
        if ( !isset($_SESSION['basket']) ) {
            return 0;
        } else {
            return count( $_SESSION['basket'] );
        }
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