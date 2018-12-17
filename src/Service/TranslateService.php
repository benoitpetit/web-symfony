<?php

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;

class TranslateService {

    public function __construct () {}

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

}