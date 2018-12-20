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
     * @Route("/basket/add/{genderEN}", name="basketadd")
     */ 
    public function addBasket(Request $request, TshirtService $products, TranslateService $translate, BasketService $basketService, $product_type = TshirtService::_PRODUCT, $genderEN = 'woman', $color_id = 0, $logo_id = 0, $pageNumber = 1)
    { 
        // A défaut de translate pour le moment ! (manque de temps)
        $genderFR = $translate->translateXXtoYY( $genderEN );
        
        // Rate promo test
        $promo = 20/100;

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

            // add flash produit -> panier
            $this->addFlash('notice', 'Votre produit a été ajouté à votre panier.');
        }

        return $this->render( TshirtService::_PRODUCT .'/gallery.html.twig', [
            'controller_name' => $genderFR,
            $genderEN.'GalleryNav' => true,
            'product_type' => $product_type,
            'genderEN' => $genderEN,
            'color_id' => $color_id,
            'logo_id' => $logo_id,
            'logos' => $products->getAllTshirtLogo()->getRecords(),
            'products' => $products->getAllGender( $genderFR, $color_id, $logo_id, $pageNumber )->getRecords(),
            'colors' => $products->getAllColorsFR(),
            'countPageForPagination' => $products->countPageForPagination( $genderFR, $color_id, $logo_id ),
            'pageNumber' => $pageNumber,
            // Promos
            'promo' => $promo,
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
