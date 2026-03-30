<?php
//service/ProductListingService.php


require_once __DIR__ . '/../database/DatabaseSingleton.php';
require_once __DIR__ . '/../repository/ProductRepository.php';
require_once __DIR__ . '/../repository/CategoryRepository.php';

class ProductListingService {

    private ProductRepository $productRepository;
    private CategoryRepository $categoryRepository;

    public function __construct() {
        $db = DatabaseSingleton:: getInstance();
        $this->productRepository = new ProductRepository($db);
        $this->categoryRepository
    }
}