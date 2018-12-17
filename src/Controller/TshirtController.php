<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use App\Service\TshirtService;
use App\Service\TranslateService;

class TshirtController extends AbstractController
{
    /**
     * Gallerie homme
     * 
     * @Route("/gallery/{product_type}/{genderEN}/{color_id}/{logo_id}", name="gallery")
     * 
     * @return render
     * 
     */
    public function displayTshirtGallery( TshirtService $products, TranslateService $translate, $product_type = 'tshirt', $genderEN , $color_id, $logo_id)
    {
        // A défaut de translate pour le moment ! (manque de temps)
        $genderFR = $translate->translateENtoFR( $genderEN );

        $promo = 20/100;

        return $this->render( $product_type .'/gallery.html.twig', [
            'controller_name' => $genderFR,
            $genderEN.'GalleryNav' => true,
            'product_type' => $product_type,
            'genderEN' => $genderEN,
            'color_id' => $color_id,
            'promo' => $promo,
            'logo_id' => $logo_id,
            'products' => $products->getAllGender( $product_type, $genderFR, $color_id, $logo_id),
            'colors' => $products->getAllColorsFR( $product_type ),
        ]);
    }

  

    /**
     * Affichage detail d'un tshirt
     * 
     * @Route("detail/{product_type}/{genderEN}/{color_id}/{logo_id}", name="tshirtdetail")
     *
     * @return render
     */
    public function displayTshirtDetail( TshirtService $products, TranslateService $translate, $product_type = 'tshirt', $genderEN, $color_id, $logo_id )
    {
        // A défaut de translate pour le moment ! (manque de temps)
        $genderFR = $translate->translateENtoFR( $genderEN );

        $promo = 20/100;

        return $this->render( $product_type .'/single_'. $product_type .'.html.twig', [
            // a modifier avec le nom du model quand il seront creer sur la BDD
            'controller_name' => 'Tshirt '.$genderFR,
            $genderEN.'SingleNav' => true,
            'product_type' => $product_type,
            'genderEN' => $genderEN,
            'color_id' => $color_id,
            'logo_id' => $logo_id,
            'promo' => $promo,
            'product' => $products->getAllGenderDetail( $product_type, $genderFR, $color_id, $logo_id )[0],
            'colors' => $products->getAllTshirtColor( $product_type ),
            'sizes' => $products->getAllTshirtSize($product_type),
            'productsRand' => $products->getRandomTshirtGender( $product_type, $genderFR, 4 ),
        ]);
    }


    /**
     * @Route("gallery/man/visual", name="manvisual")
     */
    public function manVisual( TshirtService $tshirtService, $genderFR='homme', $color='#18a4d2', $motif='game_hover')
    {
        return new Response( $tshirtService->generateTshirt($genderFR, $color, $motif), 200, array( 'Content-Type' => 'image/jpeg' ) );
    }

    /**
     * @Route("gallery/woman/visual", name="womanvisual")
     */
    public function womanVisual( TshirtService $tshirtService, $genderFR='femme', $color='#18a4d2', $motif='game_hover')
    {
        return new Response( $tshirtService->generateTshirt($genderFR, $color, $motif), 200, array( 'Content-Type' => 'image/jpeg' ) );
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
     * Gallerie RPOMOS
     * 
     * @Route("/gallery/{product_type}/promos/{genderEN}/{color_id}/{logo_id}", name="promos")
     * 
     * @return render
     * 
     */
    public function promos(TshirtService $products, TranslateService $translate, $product_type = 'tshirt', $genderEN, $color_id, $logo_id )
    {
        // A défaut de translate pour le moment ! (manque de temps)
        $genderFR = $translate->translateENtoFR( $genderEN );

        $promo = 20/100;

        return $this->render( $product_type .'/promos.html.twig', [
            'controller_name' => 'Tshirt '.$genderFR,
            'evenement' => 'Noël',
            'rubrique' => 'promos',
            'promosNav' => true,
            'promo' => $promo,
            $genderEN.'PromosNav' => true,
            'product_type' => $product_type,
            'genderEN' => $genderEN,
            'color_id' => $color_id,
            'logo_id' => $logo_id,
            'products' => $products->getAllGender( $product_type, $genderFR, $color_id, $logo_id),
            'colors' => $products->getAllColorsFR( $product_type ),
        ]);
    }

}
