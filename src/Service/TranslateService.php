<?php

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;

class TranslateService {

    public function __construct () {}

    // NO TIME for translate !!! (To convert in arrays)
    // Translate English to French to display
    public function translateXXtoYY( $wordXX ) {

        $wordYY = '';

        // Genre (Homme/Femme)
        switch ( $wordXX )
        {
            case 'woman':
                $wordYY = 'femme'; break;
            case 'man':
                $wordYY = 'homme'; break;
        }

        switch ( $wordXX )
        {
            case 'femme':
                $wordYY = 'woman'; break;
            case 'homme':
                $wordYY = 'man'; break;
        }


        // Couleur
        switch ( $wordXX )
        {
            case 'blue':
                $wordYY = 'bleu'; break;
            case 'yellow':
                $wordYY = 'jaune'; break;
            case 'green':
                $wordYY = 'vert'; break;
            case 'red':
                $wordYY = 'rouge'; break;
            case 'black':
                $wordYY = 'noir'; break;
            case 'purple':
                $wordYY = 'violet'; break;
        }

        switch ( $wordXX )
        {
            case 'bleu':
                $wordYY = 'blue'; break;
            case 'jaune':
                $wordYY = 'yellow'; break;
            case 'vert':
                $wordYY = 'green'; break;
            case 'rouge':
                $wordYY = 'red'; break;
            case 'noir':
                $wordYY = 'black'; break;
            case 'violet':
                $wordYY = 'purple'; break;
        }

        // Autres
        switch ( $wordXX )
        {
            case 't-shirt':
                $wordYY = TshirtService::_PRODUCT; break;
        }


        return $wordYY;
    }


    public function arrayPushTanslate( $languageOutput, $arrInput, $arrColumnsXX ) {
        
        $arrOutput = [];
        foreach( $arrInput as $keyInput => $valueInput ) {

            $arrColumn = [];
            foreach( $valueInput as $keyColumn => $valueColumn) {

                // Nom de colonne
                $arrColumn[$keyColumn] = $valueColumn;
                
                foreach( $arrColumnsXX as $keyColumnXX => $columnNameXX ) {
                        
                        // Declaration d'une nouvelle colonne
                        $columnNameYY = $columnNameXX.$languageOutput;
                        
                        // Traduction
                        $valueXX = $valueInput[$columnNameXX];
                        $valueYY = $this->translateXXtoYY($valueInput[$columnNameXX]);
                        
                        // Ajout d'une nouvelle colonne
                        $arrColumn[$columnNameYY] = $valueYY;
                }

            }
            // Ajout d'un tableau d'enregistrement au tableau d'enregistrement principal 
            array_push( $arrOutput, $arrColumn );
        }
        
        return $arrOutput;
    }

}