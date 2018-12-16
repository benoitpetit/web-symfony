<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use App\Service\TshirtService;

class TshirtController extends AbstractController
{


    /**
     * Gallerie homme
     * 
     * @Route("/gallery/man", name="mangallery")
     * 
     * @return render
     * 
     */
    public function manGallery( TshirtService $products )
    {
        $product_type = "tshirt";
        $genderFR = "homme";
        $genderEN = "man";

        return $this->render('tshirt/gallery.html.twig', [
            'controller_name' => $genderFR,
            'gender' => $genderEN,
            'manGalleryNav' => true,
            'products' => $products->getAllGender( $product_type, $genderFR ),
        ]);
    }

    /**
     * Gallerie femme
     * 
     * @Route("/gallery/woman", name="womangallery")
     * 
     * @return render
     * 
     */
    public function womanGallery( TshirtService $products )
    {
        $product_type = "tshirt";
        $genderFR = "femme";
        $genderEN = "woman";

        return $this->render('tshirt/gallery.html.twig', [
            'controller_name' => $genderFR,
            'gender' => $genderEN,
            'womanGalleryNav' => true,
            'products' => $products->getAllGender( $product_type, $genderFR ),
        ]);
    }

    /**
     * Affichage detail d'un tshirt homme
     * 
     * [todo] la route sera modifier en ("gallery/man/detail/{id}" quand la BDD sera creer)
     * @Route("gallery/man/detail", name="mansingle")
     *
     * @return render
     */
    public function manSingle( )
    {
        return $this->render('tshirt/man_single_tshirt.html.twig', [
            // a modifier avec le nom du model quand il seront creer sur la BDD
            'controller_name' => 'Tshirt ',
            'manSingleNav' => true,
        ]);
    }

    
    /**
     * @Route("gallery/man/visual", name="manvisual")
     */
    public function manVisual( TshirtService $tshirtService, $color='#18a4d2', $motif='game_hover')
    {
        return new Response( $tshirtService->manTshirt($color, $motif), 200, array( 'Content-Type' => 'image/jpeg' ) );
    }

    /**
     * @Route("gallery/woman/visual", name="womanvisual")
     */
    public function womanVisual( TshirtService $tshirtService, $color='#18a4d2', $motif='game_hover')
    {
        return new Response( $tshirtService->womanTshirt($color, $motif), 200, array( 'Content-Type' => 'image/jpeg' ) );
    }


    /**
     * Affichage detail d'un tshirt femme
     * 
     * [todo] la route sera modifier en ("gallery/woman/detail/{id}" quand la BDD sera creer)
     * @Route("gallery/woman/detail", name="womansingle")
     *
     * @return render
     */
    public function womanSingle()
    {
        return $this->render('tshirt/woman_single_tshirt.html.twig', [
            // a modifier avec le nom du model quand il seront creer sur la BDD
            'controller_name' => 'Tshirt',
            'womanSingleNav' => true,
        ]);
    }

    /**
     * Promo
     * 
     * @Route("/gallery/promos_man", name="promosman")
     * 
     * @return render
     * 
     */
    public function promos( TshirtService $products )
    {
        $product_type = "tshirt";
        $genderFR = "homme";
        $genderEN = "man";
        $colorOne = "green";
        $colorTwo = "red";
        $promo = 20/100;
        
        return $this->render('tshirt/promos.html.twig', [
            'controller_name' => 'Promos',
            'evenement' => 'Noël',
            'promosNav' => true,
            'gender' => $genderEN,
            'genderFR' => $genderFR,
            'promo' => $promo,
            'colorOne' => $colorOne,
            'colorTwo' => $colorTwo,
            'products' => $products->getAllGender( $product_type, $genderFR ),
        ]);
    }

    /**
     * Promo
     * 
     * @Route("/gallery/promos_woman", name="promoswoman")
     * 
     * @return render
     * 
     */
    public function promoswoman( TshirtService $products )
    {
        $product_type = "tshirt";
        $genderFR = "femme";
        $genderEN = "woman";
        $colorOne = "green";
        $colorTwo = "red";
        $promo = 20/100;
        
        return $this->render('tshirt/promos.html.twig', [
            'controller_name' => 'Promos',
            'evenement' => 'Noël',
            'promosNav' => true,
            'gender' => $genderEN,
            'promo' => $promo,
            'genderFR' => $genderFR,
            'colorOne' => $colorOne,
            'colorTwo' => $colorTwo,
            'products' => $products->getAllGender( $product_type, $genderFR ),
        ]);
    }
}
