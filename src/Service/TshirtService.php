<?php

namespace App\Service;

use App\Repository\SQLViewsRepository;
Use App\Service\TranslateService;

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
        $translate = new TranslateService();

        $viewSql = "vProduct_".$product;
        $rawSql = "SELECT v.* FROM ". $viewSql ." v";
        $stmt = $this->om->prepare( $rawSql );
        $stmt->execute( [] );
        
        return $translate->arrayPushTanslateXXtoYY( "YY", $stmt->fetchAll(), [ 'name', 'color_name' ] );
    }

    // $product est le type de produit qui est intégré dans le nom de la vue sur la base de données
    public function getAllGender( $product, $gender, $color_id, $logo_id)
    {
        $translate = new TranslateService();

        $paramSql = [];
        $criteria = "";
        if ( $color_id != 0 ) {
            $criteria = "AND v.color_id = :color_id";
            $paramSql[':color_id'] = $color_id;
        }
        if ( $logo_id != 0 ) {
            $criteria .= " AND v.logo_id = :logo_id";
            $paramSql[':logo_id'] = $logo_id;
        }
        $paramSql[':gender'] = $gender;

        $viewSql = "vProduct_".$product;
        $rawSql = "SELECT v.* FROM ". $viewSql ." v WHERE v.name = :gender ". $criteria ." ORDER BY v.logo_id";

        $stmt = $this->om->prepare( $rawSql );
        $stmt->execute( $paramSql );

        return $translate->arrayPushTanslateXXtoYY( "YY", $stmt->fetchAll(), [ 'name', 'color_name' ] );
    }

    // $product est le type de produit qui est intégré dans le nom de la vue sur la base de données
    public function getAllGenderDetail( $product, $gender, $color_id, $logo_id )
    {
        $translate = new TranslateService();

        $viewSql = "vProduct_".$product;
        $rawSql = "SELECT v.* FROM ". $viewSql ." v WHERE v.name = :gender AND v.color_id = :color_id AND v.logo_id = :logo_id";
        $paramSql = [ ':gender' => $gender,
                      ':color_id' => $color_id,
                      ':logo_id' => $logo_id,
        ];

        $stmt = $this->om->prepare( $rawSql );
        $stmt->execute( $paramSql );
        
        return $translate->arrayPushTanslateXXtoYY( "YY", $stmt->fetchAll(), [ 'name', 'color_name' ] );
    }

    // $product est le type de produit qui est intégré dans le nom de la vue sur la base de données
    public function getAllTshirtColor( $product )
    {
        $translate = new TranslateService();

        $viewSql = "vProduct_".$product;
        $rawSql = "SELECT c.* FROM color c WHERE c.par_type_product = :par_type_product";
        $paramSql = [ ':par_type_product' => '@'.$product ];

        $stmt = $this->om->prepare( $rawSql );
        $stmt->execute( $paramSql );
        
        return $translate->arrayPushTanslateXXtoYY( "YY", $stmt->fetchAll(), [ 'color_name' ] );
    }

    // $product est le type de produit qui est intégré dans le nom de la vue sur la base de données
    public function getAllTshirtSize( $product )
    {
        $rawSql = "SELECT s.*, CONCAT(s.size, ' - ', s.name) as wording FROM size s WHERE s.par_type_product = :par_type_product";
        $paramSql = [ ':par_type_product' => '@'.$product ];

        $stmt = $this->om->prepare( $rawSql );
        $stmt->execute( $paramSql );
        
        return $stmt->fetchAll();
    }

    // $product est le type de produit qui est intégré dans le nom de la vue sur la base de données
    public function getAllTshirtLogo( $product )
    {
        $rawSql = "SELECT l.* FROM logo l WHERE l.par_type_product = '@". $product ."' ORDER BY l.logo_name";
        $stmt = $this->om->prepare($rawSql);
        $stmt->execute([]);
        
        return $stmt->fetchAll();
    }


    // $product est le type de produit qui est intégré dans le nom de la vue sur la base de données
    public function getRandomTshirtGender( $product, $genderFR, $randNumber)
    {
        $translate = new TranslateService();

        $criteria = '';
        $paramSql = [];

        if ( $genderFR != 'All' ) {
            $criteria = 'WHERE v.name = :genderFR ';
            $paramSql = [ ':genderFR' => $genderFR ];
        }

        $viewSql = "vProduct_".$product;
        $rawSql = "SELECT v.* FROM ".$viewSql." v ORDER BY RAND() LIMIT ".$randNumber;

        $stmt = $this->om->prepare( $rawSql );
        $stmt->execute( $paramSql );
        
        return $translate->arrayPushTanslateXXtoYY( "YY", $stmt->fetchAll(), [ 'name', 'color_name' ] );
    }


    // $product est le type de produit qui est intégré dans le nom de la vue sur la base de données
    public function getAllColorsFR( $type_product ) {

        $translate = new TranslateService();

        $colorsEN = $this->getAllTshirtColor( $type_product );
        $colorsFR = [];

        // Translate English to French to display
        foreach( $colorsEN as $keyColorEN => $valueColorEN ) {
            array_push( $colorsFR, $translate->translateXXtoYY( $colorsEN[$keyColorEN]['color_name'] ) );
        }

        return $colorsFR;
    }

}
 
?>