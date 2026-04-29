<?php
// controller/MaccbookController.php

require_once __DIR__ . '/../database/DatabaseSingleton.php';
require_once __DIR__ . '/../model/Product.php';
require_once __DIR__ . '/../repository/ProductRepository.php';

class MacbookController
{
    public function displayMacbooks()
    {
        $db = DatabaseSingleton::getInstance();
        $productRepository = new ProductRepository($db);

        // fetch all products using repository method
        $allProducts = $productRepository->findAll();

        // filter only iPhones (categoryId = 5)
        $products = array_filter($allProducts, function($product) {
            return $product->getCategoryId() == 7;
        });

        include __DIR__ . '/../view/macbook.php';
    }
}