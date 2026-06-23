<?php

// controller/RegistrationController.php

require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../service/RegistrationService.php';

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
        $user = $this->currentUser; // pass user to view
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
        // limit password length 
        if (strlen($password) > 20) {
            $errors['password'] = 'Password is too long. Max 20 characters.';
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

        // ================= LENGTH VALIDATION =================

        // username (VARCHAR 20)
        if (strlen($username) > 20) {
            $errors['username'] = 'Username too long. Max 20 characters.';
        }

        // password (VARCHAR 20)
        if (strlen($password) > 20) {
            $errors['password'] = 'Password too long. Max 20 characters.';
        }

        // firstName (VARCHAR 50)
        if (strlen($firstName) > 50) {
            $errors['firstName'] = 'First name too long. Max 50 characters.';
        }

        // lastName (VARCHAR 50)
        if (strlen($lastName) > 50) {
            $errors['lastName'] = 'Last name too long. Max 50 characters.';
        }

        // street (VARCHAR 100)
        if (strlen($street) > 100) {
            $errors['street'] = 'Street too long. Max 100 characters.';
        }

        // town (VARCHAR 100)
        if (strlen($town) > 100) {
            $errors['town'] = 'Town too long. Max 100 characters.';
        }

        // state (VARCHAR 10)
        if (strlen($state) > 10) {
            $errors['state'] = 'State too long. Max 10 characters.';
        }

        // postcode (VARCHAR 4)
        if (strlen($postcode) > 4) {
            $errors['postcode'] = 'Postcode too long. Max 4 characters.';
        }

        // phone (VARCHAR 12)
        if (strlen($phone) > 12) {
            $errors['phone'] = 'Phone too long. Max 12 characters.';
        }

        // email (VARCHAR 30)
        if (strlen($email) > 30) {
            $errors['email'] = 'Email too long. Max 30 characters.';
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

            header("Location: index.php?page=home");
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

        $errors = [];

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

        // validate password ONLY if entered
        if ($password !== '') {
            if (strlen($password) > 20) {
                $errors['password'] = 'Password is too long. Max 20 characters.';
            }

            if (strlen($password) < 6) {
                $errors['password'] = 'Password must be at least 6 characters.';
            }

            // set password ONLY if valid
            if ($password !== '' && empty($errors['password'])) {
                $user->setPassword($password);
            }
        }

        //  if errors → show page again
        if (!empty($errors)) {
            $this->showRegisterForm($errors, $_POST);
            return;
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

        header("Location: index.php");
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