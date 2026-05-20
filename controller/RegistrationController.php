<?php

// controller/RegistrationController.php

require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class RegistrationController {

    private UserRepository $userRepository;
    private ?User $currentUser;

    public function __construct(UserRepository $userRepository, ?User $currentUser = null) {
        $this->userRepository = $userRepository;
        $this->currentUser = $currentUser;
    }

    public function handleRequest(string $action = 'register') {

        switch ($action) {

            case 'register':
                $this->showRegisterForm();
                break;

            case 'process':
                $this->processRegister();
                break;

            
            case 'update':
                $this->processUpdate();
                break;

            
            case 'delete':
                $this->processDelete();
                break;

            case 'maintain':
                $this->showRegisterForm();
                break;

            default:
                $this->showRegisterForm();
                break;
        }
    }

    private function showRegisterForm(array $errors = [], array $formData = [])
    {
        $user = $this->currentUser; // ✅ pass user to view
        require __DIR__ . '/../view/registration.php';
    }

    // ================= REGISTER =================
    private function processRegister()
    {
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $firstName = trim($_POST['firstName'] ?? '');
        $lastName = trim($_POST['lastName'] ?? '');
        $street = trim($_POST['street'] ?? '');
        $town = trim($_POST['town'] ?? '');
        $state = trim($_POST['state'] ?? '');
        $postcode = trim($_POST['postcode'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $email = trim($_POST['email'] ?? '');

        $errors = [];

        if ($username === '') {
            $errors['username'] = 'Username is required.';
        }

        if ($password === '') {
            $errors['password'] = 'Password is required.';
        }

        if ($firstName === '') {
            $errors['firstName'] = 'First name is required.';
        }

        if ($lastName === '') {
            $errors['lastName'] = 'Last name is required.';
        }

        if ($username !== '' && $this->userRepository->existsByUsername($username)) {
            $errors['username'] = 'That username already exists.';
        }

        $formData = [
            'username' => $username,
            'firstName' => $firstName,
            'lastName' => $lastName
        ];

        if (!empty($errors)) {
            $this->showRegisterForm($errors, $formData);
            return;
        }

        $user = new User(
            null,
            $username,
            $password,
            $firstName,
            $lastName,
            $street,
            $town,
            $state,
            $postcode,
            $phone,
            $email
        );

        if ($this->userRepository->insert($user)) {

            $_SESSION['user'] = serialize($user);
            $_SESSION['LastActivity'] = time();

            header("Location: index.php?page=registration");
            exit;
        }

        $this->showRegisterForm(
            ['general' => 'Registration failed. Please try again.'],
            $formData
        );
    }

    // ================= UPDATE =================
    private function processUpdate()
    {
        if ($this->currentUser === null) {
            header("Location: index.php?page=home");
            exit;
        }

        $user = $this->currentUser;

        $username = trim($_POST['username'] ?? '');
        $firstName = trim($_POST['firstName'] ?? '');
        $lastName = trim($_POST['lastName'] ?? '');
        $password = trim($_POST['password'] ?? '');

        $street = trim($_POST['street'] ?? '');
        $town = trim($_POST['town'] ?? '');
        $state = trim($_POST['state'] ?? '');
        $postcode = trim($_POST['postcode'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $email = trim($_POST['email'] ?? '');
        

        // username update
        if ($username !== '' && $username !== $user->getUsername()) {
            if ($this->userRepository->existsByUsername($username)) {
                $this->showRegisterForm(['username' => 'Username already taken']);
                return;
            }
            $user->setUsername($username);
        }

        // name updates
        if ($firstName !== '') {
            $user->setFirstName($firstName);
        }

        if ($lastName !== '') {
            $user->setLastName($lastName);
        }

        // password update
        if ($password !== '') {
            $user->setPassword($password);
        }
        // address + contact updates
        if ($street !== '') {
            $user->setStreet($street);
        }

        if ($town !== '') {
            $user->setTown($town);
        }

        if ($state !== '') {
            $user->setState($state);
        }

        if ($postcode !== '') {
            $user->setPostcode($postcode);
        }

        if ($phone !== '') {
            $user->setPhone($phone);
        }

        if ($email !== '') {
            $user->setEmail($email);
        }

        // save
        if (!$this->userRepository->update($user)) {
            $this->showRegisterForm(['general' => 'Update failed.']);
            return;
        }

        $_SESSION['user'] = serialize($user);

        header("Location: index.php?page=home");
        exit;
    }

    // ================= DELETE =================
    private function processDelete()
    {
        if ($this->currentUser === null) {
            header("Location: index.php");
            exit;
        }

        $this->userRepository->delete($this->currentUser->getUserId());

        session_unset();
        session_destroy();

        header("Location: index.php");
        exit;
    }
}