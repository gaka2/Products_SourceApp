<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ProductServiceInterface;
use App\Api\ResponseFactory;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\DataTransferObject\ProductDTO;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/api/products", name="api.products.")
 */
class ApiController extends AbstractFOSRestController {

    private $productService;
    private $responseFactory;
    
    public function __construct(ProductServiceInterface $productService, ResponseFactory $responseFactory) {
        $this->productService = $productService;
        $this->responseFactory = $responseFactory;
    }

    /**
     * @Rest\Post("/", name="add")
     * @ParamConverter("productDTO", converter="fos_rest.request_body")
     */
    public function addProduct(ProductDTO $productDTO) {
        $product = $this->productService->create($productDTO);
        return $this->responseFactory->responseForCreate($product);
    }

    /**
     * @Rest\Put("/{id}", name="edit", requirements={"id"="\d+"})
     * @ParamConverter("productDTO", converter="fos_rest.request_body")
     */
    public function editProduct(int $id, ProductDTO $productDTO) {
        $product = $this->productService->update($id, $productDTO);
        return $this->responseFactory->responseCorrect($product);
    }

    /**
     * @Rest\Delete("/{id}", name="delete", requirements={"id"="\d+"})
     */
    public function deleteProduct(int $id) {
        $product = $this->productService->delete($id);
        return $this->responseFactory->responseForDelete();
    }

    /**
     * @Rest\Get("/{id}", name="get", requirements={"id"="\d+"})
     */
    public function getProduct(int $id) {
        $product = $this->productService->get($id);
        return $this->responseFactory->responseCorrect($product);
    }

    /**
     * @Rest\Get("/", name="get_all")
     */
    public function getAllProducts() {
        $products = $this->productService->getAll();
        return $this->responseFactory->responseCorrect($products);
    }
}