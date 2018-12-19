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

    // display products per page
    const MAX_ITEMS_PER_PAGE = 8;

    // Response picture
    private $image;
    
    // Object Manager global
    private $om;

    // $records
    private $records;


    public function __construct( ObjectManager $om ) {
        $this->om = $om->getConnection();
    }


    public function getRecords() {
        return $this->records;
    }


    // générer le t-shirt
    public function generateTshirt( $gender, $color, $logo )
    {
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

        // Save the records for call getRecords()
        $this->records = $resultsAddColumnTranslate;

        // For count() and others
        return $this;
    }

    // $product est le type de produit qui est intégré dans le nom de la vue sur la base de données
    public function getAllGender( $gender, $color_id, $logo_id, $page_number = 0 )
    {
        $paramSql = [];
        $criteria = '';
        $limit = '';
        if ( $color_id != 0 ) {
            $criteria = "AND v.color_id = :color_id";
            $paramSql[':color_id'] = $color_id;
        }
        if ( $logo_id != 0 ) {
            $criteria .= " AND v.logo_id = :logo_id";
            $paramSql[':logo_id'] = $logo_id;
        }
        $paramSql[':gender'] = $gender;

        if ( $page_number != 0)
            $limit = 'LIMIT '. self::MAX_ITEMS_PER_PAGE * ($page_number-1) .','. self::MAX_ITEMS_PER_PAGE;

        $viewSql = "vProduct_". self::_PRODUCT;
        $rawSql = "SELECT v.* FROM ". $viewSql ." v WHERE v.name = :gender ". $criteria ." ORDER BY v.logo_id ". $limit;

        $stmt = $this->om->prepare( $rawSql );
        $stmt->execute( $paramSql );
        $results = $stmt->fetchAll();
        
        // Translate
        $translate = new TranslateService();
        $columnToTranslate = [ 'product_type', 'name', 'color_name' ];
        $resultsAddColumnTranslate = $translate->arrayPushTanslate( 'TR', $results, $columnToTranslate );

        // Save the records for call getRecords()
        $this->records = $resultsAddColumnTranslate;

        // For count() and others
        return $this;
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

        // Save the records for call getRecords()
        $this->records = $resultsAddColumnTranslate[0];

        // For count() and others
        return $this;
    }

    // $product est le type de produit qui est intégré dans le nom de la vue sur la base de données
    public function getAllTshirtColor( $colorsPromos = '' )
    {
        $viewSql = "vProduct_". self::_PRODUCT;
        $rawSql = "SELECT c.* FROM color c WHERE c.par_type_product = :par_type_product". $colorsPromos;
        $paramSql = [ ':par_type_product' => '@'. self::_PRODUCT ];

        $stmt = $this->om->prepare( $rawSql );
        $stmt->execute( $paramSql );
        $results = $stmt->fetchAll();
        
        // Translate
        $translate = new TranslateService();
        $columnToTranslate = [ 'color_name' ];
        $resultsAddColumnTranslate = $translate->arrayPushTanslate( 'TR', $results, $columnToTranslate );

        // Save the records for call getRecords()
        $this->records = $resultsAddColumnTranslate;

        // For count() and others
        return $this;
    }

    // $product est le type de produit qui est intégré dans le nom de la vue sur la base de données
    public function getAllTshirtSize()
    {
        $rawSql = "SELECT s.*, CONCAT(s.size, ' - ', s.name) as wording FROM size s WHERE s.par_type_product = :par_type_product";
        $paramSql = [ ':par_type_product' => '@'. self::_PRODUCT ];

        $stmt = $this->om->prepare( $rawSql );
        $stmt->execute( $paramSql );
        
        // Save the records for call getRecords()
        $this->records = $stmt->fetchAll();

        // For count() and others
        return $this;
    }

    // $product est le type de produit qui est intégré dans le nom de la vue sur la base de données
    public function getAllTshirtLogo()
    {
        $rawSql = "SELECT l.* FROM logo l WHERE l.par_type_product = :par_type_product ORDER BY l.logo_name";
        $paramSql = [ ':par_type_product' => '@'. self::_PRODUCT ];
        $stmt = $this->om->prepare($rawSql);
        $stmt->execute( $paramSql );
        
        // Save the records for call getRecords()
        $this->records = $stmt->fetchAll();

        // For count() and others
        return $this;
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

        // Save the records for call getRecords()
        $this->records = $resultsAddColumnTranslate;

        // For count() and others
        return $this;
    }


    // $product est le type de produit qui est intégré dans le nom de la vue sur la base de données
    public function getAllColorsFR( $colorsPromos = '' ) {

        $colorsEN = $this->getAllTshirtColor( $colorsPromos )->getRecords();
        $colorsFR = [];
        $colorFR = [];

        // Translate to display colors
        $translate = new TranslateService();
        $colorsFR = [];
        foreach( $colorsEN as $keyColorEN => $valueColorEN ) {
            $colorFR['id'] = $colorsEN[$keyColorEN]['id'];
            $colorFR['color_name'] = $translate->translateXXtoYY( $colorsEN[$keyColorEN]['color_name'] );
            array_push( $colorsFR, $colorFR );
        }

        return $colorsFR;
    }

    // Count records
    public function count() {
        return count( $this->records );
    }

    // Number of page(s)
    public function countPageForPagination( $genderFR, $color_id, $logo_id ) {
        return floor( $this->getAllGender( $genderFR, $color_id, $logo_id )->count() / self::MAX_ITEMS_PER_PAGE ) + 1;
    }

}
 
?>