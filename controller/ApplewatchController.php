<?php

require_once __DIR__ . '/../database/DatabaseSingleton.php';
require_once __DIR__ . '/../model/Product.php';
require_once __DIR__ . '/../repository/ProductRepository.php';

class AppleWatchController
{
    public function displayWatches()
    {
        $db = DatabaseSingleton::getInstance();
        $productRepository = new ProductRepository($db);

        $allProducts = $productRepository->findAll();

        // change category number to Apple Watch category
        $products = array_filter($allProducts, function($product) {
            return $product->getCategoryId() == 6; // change if needed
        });

        include __DIR__ . '/../view/applewatch.php';
    }
}