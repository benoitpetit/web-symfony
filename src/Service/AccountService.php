<?php

namespace App\Service;

use App\Repository\SQLViewsRepository;
Use App\Service\TranslateService;

use Doctrine\Common\Persistence\ObjectManager;

class AccountService {
    
    // Object Manager global
    private $om;
    
    public function __construct( ObjectManager $om ) {
        $this->om = $om->getConnection();
    }

    // $product est le type de produit qui est intégré dans le nom de la vue sur la base de données
    public function getAllOrders( $user_id )
    {
        $viewSql = "vOrders_tshirt";
        $rawSql = "SELECT v.* FROM ". $viewSql ." v WHERE v.user_id = :user_id";
        $paramSql = [ ':user_id' => $user_id ];

        $stmt = $this->om->prepare( $rawSql );
        $stmt->execute( $paramSql );
        
        return $stmt->fetchAll();
    }

    // $product est le type de produit qui est intégré dans le nom de la vue sur la base de données
    public function getAllOrderLines( $user_id )
    {
        $viewSql = "vOrderLines_tshirt";
        $rawSql = "SELECT v.* FROM ". $viewSql ." v WHERE v.user_id = :user_id";
        $paramSql = [ ':user_id' => $user_id ];

        $stmt = $this->om->prepare( $rawSql );
        $stmt->execute( $paramSql );
        
        return $stmt->fetchAll();
    }

}
 
?>