<?php

namespace App\Service;

// include composer autoload
require 'assets/vendor/intervention/vendor/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;
use Intervention\Image\Image;

class TshirtService {

    private $image;

    // générer le t-shirt homme
    public function menTshirt( string $color)
    {
        // Va me permettre de gérer nos images
        $manager = new ImageManager();

        //chemin vers mon image
        $image = $manager->canvas(600, 700, $color);
        $image->fill('assets/images/homme/tshirt_homme_background.png');

        return $image->response('jpg',90);

    }

    // générer le t-shirt Femme
    public function womenTshirt( string $color)
    {
        // Va me permettre de gérer nos images
        $manager = new ImageManager();

        //chemin vers mon image
        $image = $manager->canvas(600, 700, $color);
        $image->fill('assets/images/femme/tshirt_femme_background.png');

        return $image->response('jpg',90);

    }

}

?>