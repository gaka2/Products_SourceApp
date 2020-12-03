<?php

namespace App\Service;

use App\Entity\Product;
use App\DataTransferObject\ProductDTO;
use App\Repository\ProductRepository;
use App\Service\Exception\ProductNotFoundException;

class ProductService implements ProductServiceInterface {
    
    private $productRepository;
    
    public function __construct(ProductRepository $productRepository) {
        $this->productRepository = $productRepository;
    }
    
    private function transformDtoToEntity(ProductDTO $productDto, Product $product) : Product {
        $product->setName($productDto->getName());
        $product->setAmount($productDto->getAmount());
        return $product;
    }
    
    public function create(ProductDTO $productDto): Product {

        $product = $this->transformDtoToEntity($productDto, new Product());
        $this->productRepository->save($product);
        return $product;
    }
    
    public function update(int $id, ProductDTO $productDto): Product {

        $product = $this->transformDtoToEntity($productDto, $this->get($id));
        $this->productRepository->save($product);
        return $product;
    }
    
    public function get(int $id): Product {

        $product = $this->productRepository->find($id);

        if ($product === null) {
            throw new ProductNotFoundException($id);
        }

        return $product;
    }
    
    public function getAll() : array {
        return $this->productRepository->findAll();
    }

    public function delete(int $id): void {
        $product = $this->get($id);
        $this->productRepository->delete($product);
    }
}
