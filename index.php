<?php
// index.php - Front Controller

// Simple router based on ?page=...
$page = $_GET['page'] ?? 'home';

switch ($page) {
    // Home Page
    case 'home':
        require_once __DIR__ . '/controller/HomeController.php';
        $controller = new HomeController();
        $controller->displayHome();
        break;

    case 'iphones':
        require_once __DIR__ . '/controller/IphoneController.php';
        $controller = new IphoneController();
        $controller->displayIphones();
        break;

    case 'applewatch':
        require_once __DIR__ . '/controller/AppleWatchController.php';
        $controller = new AppleWatchController();
        $controller->displayWatches();
        break;

    case 'accessories':
        require_once __DIR__ . '/controller/AccessoriesController.php';
        $controller = new AccessoriesController();
        $controller->displayAccessories();
        break;

    case 'macbook':
    require_once __DIR__ . '/controller/MacbookController.php';
    $controller = new MacbookController();
    $controller->displayMacbooks();
    break;

    case 'applewatchse':
    require_once __DIR__ . '/controller/ApplewatchseController.php';
    $controller = new AppleWatchSeController();
    $controller->displayApplewatchse();
    break;

    case 'iphone17':
    require_once __DIR__ . '/controller/Iphone17Controller.php';
    $controller = new Iphone17Controller();
    $controller->displayIphone17();
    break;


    default:
        http_response_code(404);
        echo 'Page not found.';
        break;
}
?>