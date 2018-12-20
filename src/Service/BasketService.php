<?php

namespace App\Service;

class BasketService {

    public function __construct () {}

    public function countQuantity() {
        return count( $_SESSION['basket'] );
    }
}