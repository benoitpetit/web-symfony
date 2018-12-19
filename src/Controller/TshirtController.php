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
     * Gallery
     * 
     * @Route("/gallery/{product_type}/{genderEN}/{color_id}/{logo_id}/{pageNumber}", name="gallery")
     * 
     * @return render
     * 
     */
    public function displayTshirtGallery( TshirtService $products, TranslateService $translate, $product_type = TshirtService::_PRODUCT, $genderEN , $color_id, $logo_id, $pageNumber = 1 )
    {
        // A défaut de translate pour le moment ! (manque de temps)
        $genderFR = $translate->translateXXtoYY( $genderEN );
        
        // Rate promo test
        $promo = 20/100;
        
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
            ]);
        }

    /**
     * Gallery PROMOS
     * 
     * @Route("/promos/{product_type}/{genderEN}/{color_id}/{logo_id}/{pageNumber}", name="promos")
     * 
     * @return render
     * 
     */
    public function displayPromos(TshirtService $products, TranslateService $translate, $product_type = TshirtService::_PRODUCT, $genderEN, $color_id, $logo_id, $pageNumber = 1 )
    {
        // A défaut de translate pour le moment ! (manque de temps)
        $genderFR = $translate->translateXXtoYY( $genderEN );
    
        // Promo rate test
        $promo = 20/100;
    
        return $this->render( TshirtService::_PRODUCT .'/promos.html.twig', [
            'controller_name' => $genderFR,
            $genderEN.'PromosNav' => true,
            'product_type' => $product_type,
            'genderEN' => $genderEN,
            'color_id' => $color_id,
            'logo_id' => $logo_id,
            'logos' => $products->getAllTshirtLogo()->getRecords(),
            'products' => $products->getAllGender( $genderFR, $color_id, $logo_id, $pageNumber )->getRecords(),
            'colors' => $products->getAllColorsFR( ' AND c.id IN (3, 4)' ),  // Rouge et Vert
            'countPageForPagination' => $products->countPageForPagination( $genderFR, $color_id, $logo_id ),
            'pageNumber' => $pageNumber,
            // Promos
            'evenement' => 'Noël',
            'rubrique' => 'promos',
            'promosNav' => true,
            'promo' => $promo,
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
            'product' => $products->getAllGenderDetail( $genderFR, $color_id, $logo_id )->getRecords(),
            'colors' => $products->getAllTshirtColor()->getRecords(),
            'sizes' => $products->getAllTshirtSize()->getRecords(),
            'productsRand' => $products->getRandomTshirtGender( $genderFR, 4 )->getRecords(),
        ]);
    }


    /**
     * @Route("single/{genderEN}/visual/{color_id}/{logo_id}", name="visual")
     */
    public function visualTshirt( TshirtService $tshirtService, $genderEN, $color_id, $logo_id, ColorRepository $colorRepository, LogoRepository $logoRepository)
    {
        return new Response( $tshirtService->generateTshirt( $genderEN,
                                                             $colorRepository->findOneById( $color_id )->getColorHexa(),
                                                             $logoRepository->findOneById( $logo_id )->getSlug()
                                                           ),
                             200,
                             array( 'Content-Type' => 'image/jpeg' )
        );
    }

}
