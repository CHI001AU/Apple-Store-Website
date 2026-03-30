<?php
// controller/HomeController.php
/* Controller for the home page
    - Fetches 4 random movies from the database
    - Passes them to the home view for rendering
*/

//Include any models if needed
require_once __DIR__ . '/../database/DatabaseSingleton.php';
require_once __DIR__ . '/../model/Product.php';
require_once __DIR__ . '/../repository/ProductRepository.php';

class HomeController
{
    public function displayHome()
    {
        //retrieve any data if needed
        $db = DatabaseSingleton::getInstance();
        $productRepository = new ProductRepository($db);
        $products = $productRepository->findRandom(4);

        // Views are included from the project root path (index.php runs from root)
        include __DIR__ . '/../view/home.php';
    }
}