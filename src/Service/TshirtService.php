<?php

namespace App\Service;

use App\Repository\SQLViewsRepository;
Use App\Service\TranslateService;

use App\Repository\ColorRepository;
use App\Repository\LogoRepository;


// include composer autoload
// require 'assets/vendor/intervention/vendor/autoload.php';

// import the Intervention Image Manager Class
use Doctrine\Common\Persistence\ObjectManager;
use Intervention\Image\ImageManager;
use Intervention\Image\Image;

// use App\Entity\Color;
// use App\Entity\Logo;

class TshirtService {
    
    // Service & Model for product tshirt
    const _PRODUCT = 'tshirt';
    const _PICTURES = 'assets/images';

    // Response picture
    private $image;
    
    // Object Manager global
    private $om;


    public function __construct( ObjectManager $om ) {
        $this->om = $om->getConnection();
    }

    // générer le t-shirt
    public function generateTshirt( $gender, $color, $logo )
    {
// var_dump($color);
// var_dump($logo);
        // Generate pictures
        $manager = new ImageManager();
        
        // Path to pictures
        $image = $manager->canvas( 600, 700, $color );
        $image->fill( self::_PICTURES .'/'. $gender .'/'. self::_PRODUCT .'_'. $gender .'_'. $logo .'.png' );
        
        // Return response
        return $image->response( 'jpg', 90 );
    }
    

    // $product est le type de produit qui est intégré dans le nom de la vue sur la base de données
    public function getAll()
    {
        // Query
        $viewSql = 'vProduct_'. self::_PRODUCT;
        $rawSql = 'SELECT v.* FROM '. $viewSql .' v';
        $stmt = $this->om->prepare( $rawSql );
        $stmt->execute( [] );
        $results = $stmt->fetchAll();
        
        // Translate
        $translate = new TranslateService();
        $columnToTranslate = [ 'product_type', 'name', 'color_name' ];
        $resultsAddColumnTranslate = $translate->arrayPushTanslate( 'TR', $results, $columnToTranslate );

        return $resultsAddColumnTranslate;
    }

    // $product est le type de produit qui est intégré dans le nom de la vue sur la base de données
    public function getAllGender( $gender, $color_id, $logo_id )
    {
        $paramSql = [];
        $criteria = '';
        if ( $color_id != 0 ) {
            $criteria = "AND v.color_id = :color_id";
            $paramSql[':color_id'] = $color_id;
        }
        if ( $logo_id != 0 ) {
            $criteria .= " AND v.logo_id = :logo_id";
            $paramSql[':logo_id'] = $logo_id;
        }
        $paramSql[':gender'] = $gender;

        $viewSql = "vProduct_". self::_PRODUCT;
        $rawSql = "SELECT v.* FROM ". $viewSql ." v WHERE v.name = :gender ". $criteria ." ORDER BY v.logo_id";

        $stmt = $this->om->prepare( $rawSql );
        $stmt->execute( $paramSql );
        $results = $stmt->fetchAll();
        
        // Translate
        $translate = new TranslateService();
        $columnToTranslate = [ 'product_type', 'name', 'color_name' ];
        $resultsAddColumnTranslate = $translate->arrayPushTanslate( 'TR', $results, $columnToTranslate );

        return $resultsAddColumnTranslate;
    }

    // $product est le type de produit qui est intégré dans le nom de la vue sur la base de données
    public function getAllGenderDetail( $gender, $color_id, $logo_id )
    {
        $viewSql = "vProduct_". self::_PRODUCT;
        $rawSql = "SELECT v.* FROM ". $viewSql ." v WHERE v.name = :gender AND v.color_id = :color_id AND v.logo_id = :logo_id";
        $paramSql = [ ':gender' => $gender,
                      ':color_id' => $color_id,
                      ':logo_id' => $logo_id,
        ];

        $stmt = $this->om->prepare( $rawSql );
        $stmt->execute( $paramSql );
        $results = $stmt->fetchAll();
        
        // Translate
        $translate = new TranslateService();
        $columnToTranslate = [ 'product_type', 'name', 'color_name' ];
        $resultsAddColumnTranslate = $translate->arrayPushTanslate( 'TR', $results, $columnToTranslate );

        return $resultsAddColumnTranslate[0];
    }

    // $product est le type de produit qui est intégré dans le nom de la vue sur la base de données
    public function getAllTshirtColor()
    {
        $viewSql = "vProduct_". self::_PRODUCT;
        $rawSql = "SELECT c.* FROM color c WHERE c.par_type_product = :par_type_product";
        $paramSql = [ ':par_type_product' => '@'. self::_PRODUCT ];

        $stmt = $this->om->prepare( $rawSql );
        $stmt->execute( $paramSql );
        $results = $stmt->fetchAll();
        
        // Translate
        $translate = new TranslateService();
        $columnToTranslate = [ 'color_name' ];
        $resultsAddColumnTranslate = $translate->arrayPushTanslate( 'TR', $results, $columnToTranslate );

        return $resultsAddColumnTranslate;
    }

    // $product est le type de produit qui est intégré dans le nom de la vue sur la base de données
    public function getAllTshirtSize()
    {
        $rawSql = "SELECT s.*, CONCAT(s.size, ' - ', s.name) as wording FROM size s WHERE s.par_type_product = :par_type_product";
        $paramSql = [ ':par_type_product' => '@'. self::_PRODUCT ];

        $stmt = $this->om->prepare( $rawSql );
        $stmt->execute( $paramSql );
        
        return $stmt->fetchAll();
    }

    // $product est le type de produit qui est intégré dans le nom de la vue sur la base de données
    public function getAllTshirtLogo()
    {
        $rawSql = "SELECT l.* FROM logo l WHERE l.par_type_product = :par_type_product ORDER BY l.logo_name";
        $paramSql = [ ':par_type_product' => '@'. self::_PRODUCT ];
        $stmt = $this->om->prepare($rawSql);
        $stmt->execute( $paramSql );
        
        return $stmt->fetchAll();
    }


    // $product est le type de produit qui est intégré dans le nom de la vue sur la base de données
    public function getRandomTshirtGender( $gender, $randNumber )
    {
        $criteria = '';
        $paramSql = [];

        if ( $gender != 'All' ) {
            $criteria = 'WHERE v.name = :gender ';
            $paramSql[':gender'] = $gender;
        }

        $viewSql = "vProduct_". self::_PRODUCT;
        $rawSql = "SELECT v.* FROM ".$viewSql." v ORDER BY RAND() LIMIT ".$randNumber;

        $stmt = $this->om->prepare( $rawSql );
        $stmt->execute( $paramSql );
        $results = $stmt->fetchAll();
        
        // Translate
        $translate = new TranslateService();
        $columnToTranslate = [ 'product_type', 'name', 'color_name' ];
        $resultsAddColumnTranslate = $translate->arrayPushTanslate( 'TR', $results, $columnToTranslate );

        return $resultsAddColumnTranslate;
    }


    // $product est le type de produit qui est intégré dans le nom de la vue sur la base de données
    public function getAllColorsFR() {

        $colorsEN = $this->getAllTshirtColor();
        $colorsFR = [];

        // Translate to display colors
        $translate = new TranslateService();
        foreach( $colorsEN as $keyColorEN => $valueColorEN ) {
            array_push( $colorsFR, $translate->translateXXtoYY( $colorsEN[$keyColorEN]['color_name'] ) );
        }

        return $colorsFR;
    }

}
 
?>