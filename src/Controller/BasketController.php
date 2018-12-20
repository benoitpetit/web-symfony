<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Service\TshirtService;
use App\Service\TranslateService;

use App\Entity\BasketProduct;
use App\Form\BasketProductType;

use App\Service\BasketService;

class BasketController extends AbstractController
{
    public function __construct()
    {
        // Démarrage de la session si pas déjà démarrée 
        if (session_status() == PHP_SESSION_NONE) {
                session_start();

        }
    }


    /** 
     * Ajout d'un article dans le panier 
     * @Route("/basket/add", name="basketadd")
     */ 
    public function addBasket(Request $request, BasketService $basketService)
    { 
        // création d'une nouvelle ligne de commande dans le panier + les catégories à nourrir via les getters de BasketProduct
        $basketProduct = new BasketProduct();

        $formBasketProduct = $this->createForm( BasketProductType::class, $basketProduct );

        $formBasketProduct->handleRequest( $request );
        if ( $formBasketProduct->isSubmitted() && $formBasketProduct->isValid() ) {

            // Recherche des datas
            $productBasket = $formBasketProduct->getData();

            // Initialisation du panier si non fait
            if ( !isset( $_SESSION['basket'] )) {
                $_SESSION['basket'] = [];
            }

            // Ajout au panier de l'article sélectionné
            array_push( $_SESSION['basket'], $productBasket);
        }

        return $this->render ('basket/index.html.twig', [
            'controller_name' => 'Panier',
            'basketProducts' => $_SESSION['basket'],
            // Basket
            'basketCountQuantity' => $basketService->countQuantity(),
        ]);

    }    


    /** 
     * Affichage du panier
     * @Route("/basket/list", name="basketlist")
     */ 
    public function listBasket(BasketService $basketService)
    { 
        return $this->render ('basket/index.html.twig', [
            'controller_name' => 'Panier',
            'basketProducts' => $_SESSION['basket'],
            // Basket
            'basketCountQuantity' => $basketService->countQuantity(),
        ]);
    }



    /** 
    * Suppression d'un article du panier 
    * 
    * @param String    $basketLine      ligne de commande du panier à supprimer 
    * @return Boolean  Retourn TRUE si la suppression a bien été effectuée, FALSE sinon 
    */ 
    public function removeBasketLine($basketLine) 
    { 
    }    

    /** 
    * Calcul du montant total pour chaque ligne de commande du panier (article) 
    * @return Double 
    */ 
    public function basketTotal() 
    { 
        // On initialise le montant 
        $total = 0; 
        // On  compte les articles du panier 
        $ProductQuantity = count($basket['product_type']); 

        // On calcule le total par article  
        for($i = 0; $i < $nb_articles; $i++) 
        { 
            $total += $basket['quantity'][$i] * $basket['price_unit_ttc'][$i]; 
        } 
        
        return $total; 
    } 

}        
