<?php

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;
Use App\Service\TshirtService;

class TranslateService {

    private $tshirt;

    public function __construct ( ObjectManager $om, TshirtService $tshirtService ) {
        $this->tshirt = new tshirtService( $om );
    }

    // NO TIME for translate !!!
    // Translate English to French to display
    public function translateENtoFR( $wordEN ) {

        $wordFR = '';

        // Gender
        switch ( $wordEN )
        {
            case 'woman':
                $wordFR = 'femme'; break;
            case 'man':
                $wordFR = 'homme'; break;
        }

        // Color
        switch ( $wordEN )
        {
            case 'blue':
                $wordFR = 'bleu'; break;
            case 'yellow':
                $wordFR = 'jaune'; break;
            case 'green':
                $wordFR = 'vert'; break;
            case 'red':
                $wordFR = 'rouge'; break;
            case 'black':
                $wordFR = 'noir'; break;
            case 'purple':
                $wordFR = 'violet'; break;
        }

        return $wordFR;
    }

    public function getAllColorsFR( $type_product ) {

        $colorsEN = $this->tshirt->getAllTshirtColor( $type_product );
        $colorsFR = [];

        // Translate English to French to display
        foreach( $colorsEN as $keyColorEN => $valueColorEN ) {
            array_push( $colorsFR, $this->translateENtoFR( $colorsEN[$keyColorEN]['color_name'] ) );
        }

        return $colorsFR;
    }

}