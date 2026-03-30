<?php

require_once __DIR__ . '/../database/DatabaseSingleton.php';
require_once __DIR__ . '/../model/Product.php';
require_once __DIR__ . '/../repository/ProductRepository.php';

class AccessoriesController
{
    public function displayAccessories()
    {
        $db = DatabaseSingleton::getInstance();
        $productRepository = new ProductRepository($db);

        $allProducts = $productRepository->findAll();

        // change category number to Accessories category
        $products = array_filter($allProducts, function($product) {
            return $product->getCategoryId() == 3; // change if needed
        });

        include __DIR__ . '/../view/accessories.php';
    }
}