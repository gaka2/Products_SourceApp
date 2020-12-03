<?php

namespace App\Service\Exception;

class ProductNotFoundException extends \InvalidArgumentException {
    public function __construct(string $id) {
        parent::__construct("Product not found. ID = {$id}");
    }
}