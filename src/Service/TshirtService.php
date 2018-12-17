<?php

namespace App\Service;

use App\Repository\SQLViewsRepository;


// include composer autoload
// require 'assets/vendor/intervention/vendor/autoload.php';

// import the Intervention Image Manager Class
use Doctrine\Common\Persistence\ObjectManager;
use Intervention\Image\ImageManager;
use Intervention\Image\Image;

class TshirtService {
    
    private $image;
    
    // Object Manager global
    private $om;
    
    public function __construct( ObjectManager $om ) {
        $this->om = $om->getConnection();
    }

    // générer le t-shirt
    public function generateTshirt( string $gender, string $color, string $motif)
    {
        // Va me permettre de gérer nos images
        $manager = new ImageManager();
        
        //chemin vers mon image
        $image = $manager->canvas(600, 700, $color);
        $image->fill('assets/images/'. $gender .'/tshirt_'. $gender .'_'. $motif .'.png');
        
        return $image->response('jpg',90);
        
    }

    
    // // générer le t-shirt homme
    // public function manTshirt( string $color, string $motif)
    // {
    //     // Va me permettre de gérer nos images
    //     $manager = new ImageManager();
        
    //     //chemin vers mon image
    //     $image = $manager->canvas(600, 700, $color);
    //     $image->fill('assets/images/man/tshirt_man_'. $motif .'.png');
        
    //     return $image->response('jpg',90);
        
    // }
    
    // // générer le t-shirt Femme
    // public function womanTshirt( string $color, string $motif)
    // {
    //     // Va me permettre de gérer nos images
    //     $manager = new ImageManager();
        
    //     //chemin vers mon image
    //     $image = $manager->canvas(600, 700, $color);
    //     $image->fill('assets/images/woman/tshirt_woman_'. $motif .'.png');
        
    //     return $image->response('jpg',90);
        
    // }

    // $product est le type de produit qui est intégré dans le nom de la vue sur la base de données
    public function getAll( $product )
    {
        $rawSql = "SELECT v.* FROM vProduct_".$product." v";
        $stmt = $this->om->prepare($rawSql);
        $stmt->execute([]);
        
        return $stmt->fetchAll();
    }

    // $product est le type de produit qui est intégré dans le nom de la vue sur la base de données
    public function getAllGender( $product, $gender )
    {
        $rawSql = "SELECT v.* FROM vProduct_".$product." v WHERE v.name = '".$gender."' ORDER BY v.logo_id, v.color_id";
        $stmt = $this->om->prepare($rawSql);
        $stmt->execute([]);
        
        return $stmt->fetchAll();
    }

    // $product est le type de produit qui est intégré dans le nom de la vue sur la base de données
    public function getAllGenderDetail( $product, $gender, $color_id, $logo_id )
    {
        $rawSql = "SELECT v.* FROM vProduct_".$product." v WHERE v.name = '".$gender."' AND v.color_id = ". $color_id ." AND v.logo_id = ". $logo_id;
        $stmt = $this->om->prepare($rawSql);
        $stmt->execute([]);
        
        return $stmt->fetchAll();
    }


}

?>