<?php

namespace App\Service;

class BasketService {

    public function __construct () {}

    public function countQuantity() {
        if ( !isset($_SESSION['basket']) ) {
            return 0;
        } else {
            return count( $_SESSION['basket'] );
        }
    }
}