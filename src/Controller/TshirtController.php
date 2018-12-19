<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use App\Service\TshirtService;
use App\Service\TranslateService;

use App\Repository\ColorRepository;
use App\Repository\LogoRepository;


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
    public function displayTshirtGallery( TshirtService $products, TranslateService $translate, $product_type = TshirtService::_PRODUCT, $genderEN , $color_id, $logo_id)
    {
        // A défaut de translate pour le moment ! (manque de temps)
        $genderFR = $translate->translateXXtoYY( $genderEN );

        $promo = 20/100;

        return $this->render( TshirtService::_PRODUCT .'/gallery.html.twig', [
            'controller_name' => $genderFR,
            $genderEN.'GalleryNav' => true,
            'product_type' => $product_type,
            'genderEN' => $genderEN,
            'color_id' => $color_id,
            'promo' => $promo,
            'logo_id' => $logo_id,
            'logos' => $products->getAllTshirtLogo(),
            'products' => $products->getAllGender( $genderFR, $color_id, $logo_id ),
            'colors' => $products->getAllColorsFR(),
        ]);
    }

  

    /**
     * Affichage detail d'un tshirt
     * 
     * @Route("detail/{product_type}/{genderEN}/{color_id}/{logo_id}", name="tshirtdetail")
     *
     * @return render
     */
    public function displayTshirtDetail( TshirtService $products, TranslateService $translate, $product_type = TshirtService::_PRODUCT, $genderEN, $color_id, $logo_id )
    {
        // A défaut de translate pour le moment ! (manque de temps)
        $genderFR = $translate->translateXXtoYY( $genderEN );

        $promo = 20/100;

        return $this->render( TshirtService::_PRODUCT .'/single_'. $product_type .'.html.twig', [
            // a modifier avec le nom du model quand il seront creer sur la BDD
            'controller_name' => TshirtService::_PRODUCT.$genderFR,
            $genderEN.'SingleNav' => true,
            'product_type' => $product_type,
            'genderEN' => $genderEN,
            'color_id' => $color_id,
            'logo_id' => $logo_id,
            'promo' => $promo,
            'product' => $products->getAllGenderDetail( $genderFR, $color_id, $logo_id ),
            'colors' => $products->getAllTshirtColor(),
            'sizes' => $products->getAllTshirtSize(),
            'productsRand' => $products->getRandomTshirtGender( $genderFR, 4 ),
        ]);
    }


    /**
     * @Route("single/{genderEN}/visual/{color_id}/{logo_id}", name="visual")
     */
    public function manVisual( TshirtService $tshirtService, $genderEN, $color_id, $logo_id, ColorRepository $colorRepository, LogoRepository $logoRepository)
    {
        return new Response( $tshirtService->generateTshirt( $genderEN,
                                                             $colorRepository->findOneById( $color_id )->getColorHexa(),
                                                             $logoRepository->findOneById( $logo_id )->getSlug()
                                                           ),
                             200,
                             array( 'Content-Type' => 'image/jpeg' )
        );
    }


    /**
     * Gallerie RPOMOS
     * 
     * @Route("/gallery/{product_type}/promos/{genderEN}/{color_id}/{logo_id}", name="promos")
     * 
     * @return render
     * 
     */
    public function promos(TshirtService $products, TranslateService $translate, $product_type = TshirtService::_PRODUCT, $genderEN, $color_id, $logo_id )
    {
        // A défaut de translate pour le moment ! (manque de temps)
        $genderFR = $translate->translateXXtoYY( $genderEN );

        $promo = 20/100;

        return $this->render( TshirtService::_PRODUCT .'/promos.html.twig', [
            'controller_name' => $genderFR,
            'evenement' => 'Noël',
            'rubrique' => 'promos',
            'promosNav' => true,
            'promo' => $promo,
            $genderEN.'PromosNav' => true,
            'product_type' => $product_type,
            'genderEN' => $genderEN,
            'color_id' => $color_id,
            'logo_id' => $logo_id,
            'logos' => $products->getAllTshirtLogo(),
            'products' => $products->getAllGender( $genderFR, $color_id, $logo_id),
            'colors' => $products->getAllColorsFR(),
        ]);
    }


}
