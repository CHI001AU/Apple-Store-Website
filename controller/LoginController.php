<?php

// Controller/LoginController.php

require_once __DIR__ . '/../database/DatabaseSingleton.php';

// Require Models 
require_once __DIR__ . '/../model/User.php';

// Require Services - if complex/complicated multitable access

// Require Repositories - for standalone table access
require_once __DIR__ . '/../repository/UserRepository.php';


class LoginController {

    // Declare the repositories or services that support the Login process
    private UserRepository $userRepository;

    public function __construct() {
        $db = DatabaseSingleton::getInstance();
        $userRepository = new UserRepository($db);        
        $this->userRepository = $userRepository;    }

    // Allow Login Controller to do multiple functions
    public function handleRequest(string $action = 'login') {
        switch ($action) {
            case 'login':
                // Show the login form
                $this->showLoginForm();
                break;
            case 'process':
                // get data from form and process login
                $this->processLogin();
                break;
            case 'logout':
                // kill the session
                $this->logout();
                break;
            default:
                // When in doubt - show the login form
                $this->showLoginForm();
                break;
        }
    }

    /**
     * Show Login Form simple displays the Login View
     */
    private function showLoginForm(array $errors = [], array $formData = []) {
        require __DIR__ . '/../view/login.php';
    }

    /**
     * Process Login
     * - Gets the form fields - username and password
     * - retrieves the User using the username
     * - checks the hashed password vs the entered password
     */
    private function processLogin() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
    
        $user = $this->userRepository->findByUsername($username);

        // Verify user exists and password matches hash
        if ($user && ($password===$user->getPassword())) {
            // Login Success: Store User object in session
            // This tells us the user is logged in.
            $_SESSION['user'] = SERIALIZE($user);
            
            header("Location: index.php");
            exit;
        } else {
            $this->showLoginForm(['login' => 'Invalid username or password.'], ['username' => $username]);
        }
    }

    /** 
     * Process Logout - destroy the current user's session
     */
    private function logout() {
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit;
    }
} 

?>