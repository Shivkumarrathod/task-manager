<?php

require_once __DIR__ . '/../Models/Task.php';

class Auth
{
    private Task $taskModel;

    public function __construct()
    {
        $this->taskModel = new Task();
    }

    
    public function create(): void
    {
        require __DIR__ . '/../Views/auth/create.php';
    }

    public function store(): void
    {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($email === '' || $password === '') {
            $error = 'Email and password are required.';
            require __DIR__ . '/../Views/auth/create.php';
            return;
        }

        // Hash password before storing
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->taskModel->createUser($name, $email, $hashedPassword);
        header('Location: /login');
        exit;
    }

    public function showLogin(): void
    {
        require __DIR__ . '/../Views/auth/login.php';
    }

    public function login(): void
    {
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($email === '' || $password === '') {
            $error = 'Email and password are required.';
            require __DIR__ . '/../Views/auth/login.php';
            return;
        }

        $success = $this->taskModel->loginUser($email, $password);
        if ($success) {
            // Set session for user
            $_SESSION['user'] = $email;
            header('Location: /');
            exit;
        } else {
            $error = 'Invalid email or password.';
            require __DIR__ . '/../Views/auth/login.php';
        }
    }

    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();
        header('Location: /login');
        exit;
    }

}
