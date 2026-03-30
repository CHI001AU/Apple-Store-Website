<?php
// Repository/ProductRepository.php

// Load the Product business model, as the Repository must instantiate and return Product objects.
require_once __DIR__ . '/../model/Product.php';

// Load the DatabaseSingleton, as the Repository needs its generic query execution methods.
require_once __DIR__ . '/../database/DatabaseSingleton.php';

class ProductRepository {

    // Dependency Injection: The Repository requires the Database access object.
    private DatabaseSingleton $db;

    public function __construct(DatabaseSingleton $db) {
        $this->db = $db;
    }

    /**
     * Converts a raw database array row into a Product Model object.
     * This is the bridge between the Data Access Layer (Repository) and the
     * Business Logic Layer (Model).
     */
    private function createModelFromRow(array $row): Product {
        return new Product(
            (int)$row['productId'],
            $row['productName'],
            $row['productDescription'] ?? null,
            isset($row['categoryId']) ? (int)$row['categoryId'] : null,
            isset($row['stockLevels']) ? (int)$row['stockLevels'] : null,
            $row['productImage'] ?? null,
            isset($row['price']) ? (float)$row['price'] : null
        );
    }

    // ----------------------------------------------------------------------
    //                           FETCH METHODS
    // ----------------------------------------------------------------------

    /**
     * Finds a single Product by its primary key ID.
     */
    public function findById(int $id): ?Product {
        $sql = "SELECT * FROM `products` WHERE `productId` = :id";

        $results = $this->db->query($sql, ['id' => $id]);

        if (empty($results)) {
            return null;
        }

        // Convert the raw data to a single Product object
        return $this->createModelFromRow($results[0]);
    }

    /**
     * Finds all products in the database.
     * @return Product[] An array of Product objects.
     */
    public function findAll(): array {
        $sql = "SELECT * FROM `products` ORDER BY `productName` ASC";
        $results = $this->db->query($sql);

        // Convert all raw results into an array of Product objects
        return array_map(fn($row) => $this->createModelFromRow($row), $results);
    }

    /**
     * Returns a random set of Movie Model objects, limited by the quantity passed in.
     * @param int $limit The maximum number of random movies to return.
     * @return Movie[] An array of Movie objects.
     */
    public function findRandom(int $limit = 4): array {
        // Uses the SQL ORDER BY RAND() function.
        $sql = "SELECT
                    productId, productName, productDescription, categoryId, stockLevels, productImage, price
                FROM products
                ORDER BY RAND()
                LIMIT :limit";

        // The parameter is passed to the generic query method for safe execution.
        $params = ['limit' => $limit];

        $results = $this->db->query($sql, $params);

        return array_map(fn($row) => $this->createModelFromRow($row), $results);
    }

    // ----------------------------------------------------------------------
    //                           PERSISTENCE METHOD
    // ----------------------------------------------------------------------

    /**
     * Saves a Product Model to the database, handling either INSERT or UPDATE.
     */
    public function save(Product $product): bool {
        if ($product->productId === null) {
            // INSERT (New Product)
            $sql = "INSERT INTO `products` (`productName`, `productDescription`, `categoryId`, `stockLevels`, `productImage`, `price`)
                    VALUES (:name, :desc, :cat, :stock, :image, :price)";

            $params = [
                'name' => $product->getProductName(),
                'desc' => $product->getProductDescription(),
                'cat' => $product->getCategoryId(),
                'stock' => $product->getStockLevels(),
                'image' => $product->getProductImageAttr(),
                'price' => $product->getPrice()
            ];

            // Execute the insertion
            $success = $this->db->execute($sql, $params) > 0;

            // [Unverified] A complete solution would update $product->productId with the last inserted ID.

            return $success;

        } else {
            // UPDATE (Existing Product)
            $sql = "UPDATE `products` SET
                    `productName` = :name,
                    `productDescription` = :desc,
                    `categoryId` = :cat,
                    `stockLevels` = :stock,
                    `productImage` = :image,
                    `price` = :price
                    WHERE `productId` = :id";

            $params = [
                'name' => $product->getProductName(),
                'desc' => $product->getProductDescription(),
                'cat' => $product->getCategoryId(),
                'stock' => $product->getStockLevels(),
                'image' => $product->getProductImageAttr(),
                'price' => $product->getPrice(),
                'id' => $product->getProductId()
            ];

            // Execute the update
            return $this->db->execute($sql, $params) >= 0; // Return true even if 0 rows affected (data was unchanged)
        }
    }
}
?>