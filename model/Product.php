<?php
// Model/Product.php

class Product {
    // Properties match the database columns for data storage
    // Note:
    //  ? at type indicates the property can be null
    public ?int $productId;
    public string $productName;
    public ?string $productDescription;
    public ?int $categoryId;
    public ?int $stockLevels;
    public ?string $productImage;
    public ?float $price;

    public function __construct(
        ?int $productId,
        string $productName,
        ?string $productDescription = null,
        ?int $categoryId = null,
        ?int $stockLevels = null,
        ?string $productImage = null,
        ?float $price = null
    ) {
        $this->productId = $productId;
        $this->productName = $productName;
        $this->productDescription = $productDescription;
        $this->categoryId = $categoryId;
        $this->stockLevels = $stockLevels;
        $this->productImage = $productImage ?? "default.png";
        $this->price = $price;
    }

    // Getters
    public function getProductId(): ?int {
        return $this->productId;
    }

    public function getProductName(): string {
        return $this->productName;
    }

    public function getProductDescription(): ?string {
        return $this->productDescription;
    }

    public function getCategoryId(): ?int {
        return $this->categoryId;
    }

    public function getStockLevels(): ?int {
        return $this->stockLevels;
    }

    public function getProductImage(): string {
        return $this->productImage ?? "default.png";
    }

    public function getPrice(): ?float {
        return $this->price;
    }

    // Setters
    public function setProductId(?int $productId): void {
        $this->productId = $productId;
    }

    public function setProductName(string $productName): void {
        $this->productName = $productName;
    }

    public function setProductDescription(?string $productDescription): void {
        $this->productDescription = $productDescription;
    }

    public function setCategoryId(?int $categoryId): void {
        $this->categoryId = $categoryId;
    }

    public function setStockLevels(?int $stockLevels): void {
        $this->stockLevels = $stockLevels;
    }

    public function setProductImage(?string $productImage): void {
        $this->productImage = $productImage ?? "default.png";
    }

    public function setPrice(?float $price): void {
        $this->price = $price;
    }
}