<?php

require_once __DIR__ . '/../database/DatabaseSingleton.php';
require_once __DIR__ . '/../model/Product.php';
require_once __DIR__ . '/../repository/ProductRepository.php';

class MacbookController
{
    public function displayMacbooks()
    {
        $db = DatabaseSingleton::getInstance();
        $productRepository = new ProductRepository($db);

        $allProducts = $productRepository->findAll();

        // change category number to Macbook category
        $products = array_filter($allProducts, function($product) {
            return $product->getCategoryId() == 7; // change if needed
        });

        include __DIR__ . '/../view/macbook.php';
    }
}