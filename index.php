<?php
// index.php - Front Controller

require_once __DIR__ . '/model/User.php';
require_once __DIR__ . '/utilities/sessionManagement.php';

require_once __DIR__ . '/database/DatabaseSingleton.php';
require_once __DIR__ . '/repository/UserRepository.php';

$db = DatabaseSingleton::getInstance();
$userRepository = new UserRepository($db);

// Simple router based on ?page=...
$page = $_GET['page'] ?? 'home';

// Check if user is logged in. If not, force to login page (allow registration)
$allowed_pages = array('home','login','registration');
if ($forceLogin && !(in_array($page, $allowed_pages))) {
    $page = 'login';
    $user = "null";
} 


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

    case 'macbookneo':
        require_once __DIR__ . '/controller/MacbookNeoController.php';
        $controller = new MacbookNeoController();
        $controller->displayMacbookneo();
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

    case 'iphone17pro':
        require_once __DIR__ . '/controller/Iphone17proController.php';
        $controller = new Iphone17proController();
        $controller->displayIphone17pro();
        break;

    case 'applewatch11':
        require_once __DIR__ . '/controller/applewatch11Controller.php';
        $controller = new Applewatch11Controller();
        $controller->displayApplewatch11();
        break;

    case 'applewatchultra3':
        require_once __DIR__ . '/controller/applewatchultra3Controller.php';
        $controller = new ApplewatchUltra3Controller();
        $controller->displayApplewatchUltra3();
        break;

    case 'macbooks':
        require_once __DIR__ . '/controller/MacbookController.php';
        $controller = new MacbookController();
        $controller->displayMacbooks();
        break;

    case 'macbookair':
        require_once __DIR__ . '/controller/MacbookAirController.php';
        $controller = new MacbookAirController();
        $controller->displayMacbookAir();
        break;

    case 'macbookpro':
        require_once __DIR__ . '/controller/MacbookProController.php';
        $controller = new MacbookProController();
        $controller->displayMacbookPro();
        break;

    case 'login':
        require_once __DIR__ . '/controller/LoginController.php';
        $controller = new LoginController();
        $controller->handleRequest($_GET['action'] ?? 'logout');
        break;

    case 'registration':
        require_once __DIR__ . '/controller/RegistrationController.php';
        $controller = new RegistrationController($userRepository, $user);
        $controller->handleRequest($_GET['action'] ?? 'register');
        break;



    default:
        http_response_code(404);
        echo 'Page not found.';
        break;
}
?>