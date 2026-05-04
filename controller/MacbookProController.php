<?php

require_once __DIR__ . '/../database/DatabaseSingleton.php';
require_once __DIR__ . '/../model/Product.php';
require_once __DIR__ . '/../repository/ProductRepository.php';

class MacbookProController
{
    public function displayMacbookPro()
    {
        $db = DatabaseSingleton::getInstance();
        $productRepository = new ProductRepository($db);

        $allProducts = $productRepository->findAll();

         // change category number to Apple Watch category
        $products = array_filter($allProducts, function($product) {
            return $product->getProductId() == 22; // change if needed
        });

        include __DIR__ . '/../view/macbookpro.php';
    }
}