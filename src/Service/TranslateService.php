<?php

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;

class TranslateService {

    public function __construct () {}

    // NO TIME for translate !!! (To convert in arrays)
    // Translate English to French to display
    public function translateXXtoYY( $wordXX ) {

        $wordYY = '';

        // Gender
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


        // Color
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


        return $wordYY;
    }


    public function arrayPushTanslate( $languageOutput, $arrInput, $arrColumnsXX ) {
        // var_dump($arrInput);
        $arrOutput = [];
        foreach( $arrInput as $keyInput => $valueInput ) {

            $arrColumn = [];
            foreach( $valueInput as $keyColumn => $valueColumn) {

                // Column name
                $arrColumn[$keyColumn] = $valueColumn;
                
                foreach( $arrColumnsXX as $keyColumnXX => $columnNameXX ) {
                        
                        // Declaration of new column
                        $columnNameYY = $columnNameXX.$languageOutput;
                        
                        // Translate
                        $valueXX = $valueInput[$columnNameXX];
                        $valueYY = $this->translateXXtoYY($valueInput[$columnNameXX]);
                        
                        // Add column
                        $arrColumn[$columnNameYY] = $valueYY;
                }

            }
            // Add array record to main array records
            array_push( $arrOutput, $arrColumn );
        }
        // var_dump($arrOutput);
        return $arrOutput;
    }

}