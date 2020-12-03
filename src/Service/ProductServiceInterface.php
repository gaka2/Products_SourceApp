<?php

namespace App\Service;

use App\Entity\Product;
use App\DataTransferObject\ProductDTO;

interface ProductServiceInterface {

    function create(ProductDTO $productDto): Product;

    function update(int $id, ProductDTO $productDto): Product;

    function get(int $id): Product;

    function getAll() : array;

    function delete(int $id): void;

}