<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

// use Symfony\Bundle\FrameworkBundle\Controller\TshitController;
// use App\Service\TshirtService;


class BasketController extends AbstractController
{
    /**
     * @Route("/basket", name="basket")
     */
    public function index()
    {

        return $this->render('basket/index.html.twig', [
            'controller_name' => 'Panier',

    
        ]);
    }


    // /**
    //  * Ajout d'un article dans le panier 
    //  * @param array $select variable tableau associatif contenant les valeurs de l'article 
    //  * 
    //  * @Route("/add/{id}", name="add_basket")
    //  */
    // public function add ($select)
    // {
    //     /* On vérifie l'existence du panier, sinon, on le crée */ 
    //     if(!isset($_SESSION['basket'])) 
    //     { 
    //         /* Initialisation du panier */ 
    //         $_SESSION['basket'] = array(); 
    //         /* Subdivision du panier */ 
    //         $_SESSION['basket']['product.id'] = array();
    //         $_SESSION['basket']['logo'] = array();  
    //         $_SESSION['basket']['color'] = array(); 
    //         $_SESSION['basket']['size'] = array(); 
    //         $_SESSION['basket']['quantity'] = array(); 
    //         $_SESSION['basket']['price'] = array(); 
    //     } 
    //     /* Article exemple */ 
    //     $select = array(); 
    //     $select['id'] = "phlevis501"; 
    //     $select['quantity'] = 2; 
    //     $select['size'] = "s"; 
    //     $select['prix'] = 20; 
    //     add($select);
    

    // array_push($_SESSION['panier']['id_article'],$select['id']); 
    // array_push($_SESSION['panier']['qte'],$select['qte']); 
    // array_push($_SESSION['panier']['taille'],$select['taille']); 
    // array_push($_SESSION['panier']['prix'],$select['prix']); 

        
    //     return $this->redirect($this->generateUrl('basket'));
    // }


    // /**
    //  * @Route("/delete/{id}", name="delete_basket")
    //  */
    // public function delete ($id)
    // {

    //     return $this->redirect($this->generateUrl('basket'));        
    // }
    
    
}
