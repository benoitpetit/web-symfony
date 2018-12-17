<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use App\Service\TshirtService;

class TshirtController extends AbstractController
{

    private $genderFR;

    // NO TIME for translate !!!
    // Translate English to French to display
    private function translateENtoFR( $wordEN ) {
        if ( $wordEN == 'woman' )
            $wordFR = 'femme';
        elseif ( $wordEN == 'man')
            $wordFR = 'homme';
        else $wordFR = null;

        return $wordFR;
    }

    /**
     * Gallerie homme
     * 
     * @Route("/gallery/{product_type}/{genderEN}/{color_id}", name="gallery")
     * 
     * @return render
     * 
     */
    public function displayTshirtGallery( TshirtService $products, $product_type = 'tshirt', $genderEN , $color_id)
    {
        // A défaut de translate pour le moment ! (manque de temps)
        $this->genderFR = $this->translateENtoFR( $genderEN );

        return $this->render( $product_type .'/gallery.html.twig', [
            'controller_name' => $this->genderFR,
            $genderEN.'GalleryNav' => true,
            'product_type' => $product_type,
            'genderEN' => $genderEN,
            'color_id' => $color_id,
            'products' => $products->getAllGender( $product_type, $this->genderFR, $color_id),
        ]);
    }

    /**
     * Affichage detail d'un tshirt
     * 
     * @Route("detail/{product_type}/{genderEN}/{color_id}/{logo_id}", name="tshirtdetail")
     *
     * @return render
     */
    public function displayTshirtDetail( TshirtService $products, $product_type = 'tshirt', $genderEN, $color_id, $logo_id )
    {
        // A défaut de translate pour le moment ! (manque de temps)
        $this->genderFR = $this->translateENtoFR( $genderEN );

        return $this->render( $product_type .'/single_'. $product_type .'.html.twig', [
            // a modifier avec le nom du model quand il seront creer sur la BDD
            'controller_name' => 'Tshirt '.$this->genderFR,
            $genderEN.'SingleNav' => true,
            'product_type' => $product_type,
            'genderEN' => $genderEN,
            'color_id' => $color_id,
            'logo_id' => $logo_id,
            'product' => $products->getAllGenderDetail( $product_type, $this->genderFR, $color_id, $logo_id )[0],
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

    // /**
    //  * Promo
    //  * 
    //  * @Route("/gallery/{product_type}/promos_{genderEN}/{color_name}", name="promosman")
    //  * 
    //  * @return render
    //  * 
    //  */
    // public function promos( TshirtService $products, $product_type = 'tshirt', $genderEN , $color_name )
    // {
    //     $promo = 20/100;
        
    //     return $this->render('tshirt/promos.html.twig', [
    //         'controller_name' => 'Promos',
    //         'evenement' => 'Noël',
    //         'promosNav' => true,
    //         'promo' => $promo,
    //         'genderFR' => 'homme',
    //         'product_type' => $product_type,
    //         'genderEN' => $genderEN,
    //         'color_name' => $color_name,
    //         'products' => $products->getAllGender( $product_type, $this->genderFR, $color_name),
    //     ]);
    // }

        /**
     * Gallerie homme
     * 
     * @Route("/gallery/{product_type}/promos/{genderEN}/{color_id}", name="promos")
     * 
     * @return render
     * 
     */
    public function promos( TshirtService $products, $product_type = 'tshirt', $genderEN , $color_id)
    {
        // A défaut de translate pour le moment ! (manque de temps)
        $this->genderFR = $this->translateENtoFR( $genderEN );

        $promo = 20/100;

        return $this->render( $product_type .'/promos.html.twig', [
            'controller_name' => 'Tshirt '.$this->genderFR,
            'evenement' => 'Noël',
            'rubrique' => 'promos',
            'promosNav' => true,
            'promo' => $promo,
            $genderEN.'PromosNav' => true,
            'product_type' => $product_type,
            'genderEN' => $genderEN,
            'color_id' => $color_id,
            'products' => $products->getAllGender( $product_type, $this->genderFR, $color_id),
        ]);
    }

    // /**
    //  * Promo
    //  * 
    //  * @Route("/gallery/promos_woman", name="promoswoman")
    //  * 
    //  * @return render
    //  * 
    //  */
    // public function promosWoman( TshirtService $products )
    // {
    //     $product_type = "tshirt";
    //     $genderFR = "femme";
    //     $genderEN = "woman";
    //     $colorOne = "green";
    //     $colorTwo = "red";
    //     $promo = 20/100;
        
    //     return $this->render('tshirt/promos.html.twig', [
    //         'controller_name' => 'Promos',
    //         'evenement' => 'Noël',
    //         'promosNav' => true,
    //         'product_type' => $product_type,
    //         'gender' => $genderEN,
    //         'genderEN' => $genderEN,
    //         'promo' => $promo,
    //         'genderFR' => $genderFR,
    //         'colorOne' => $colorOne,
    //         'colorTwo' => $colorTwo,
    //         'products' => $products->getAll( $product_type ),
    //     ]);
    // }
}
