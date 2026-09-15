<?php

require_once __DIR__ . '/../Models/Task.php';

class TaskController
{
    private Task $taskModel;

    public function __construct()
    {
        $this->taskModel = new Task();
    }

    public function index(): void
    {
        // Check if user is logged in
        if (!isset($_SESSION['user'])) {
            header('Location: /create-account');
            exit;
        }

        $dbStatus = 'connected';
        $isHealthy = true;

        try {
            $db = Database::getConnection();
            $db->query('SELECT 1');
        } catch (Throwable $e) {
            $dbStatus = 'unreachable';
            $isHealthy = false;
        }

        $health = json_encode([
            'status' => $isHealthy ? 'healthy' : 'unhealthy',
            'timestamp' => date('c'),
            'services' => [
                'app' => 'running',
                'database' => $dbStatus,
            ],
        ], JSON_PRETTY_PRINT);

        $tasks = $this->taskModel->all((int) $_SESSION['user_id']);
        require __DIR__ . '/../Views/tasks/index.php';
    }

    public function create(): void
    {
        // Check if user is logged in
        if (!isset($_SESSION['user'])) {
            header('Location: /create-account');
            exit;
        }
        
        require __DIR__ . '/../Views/tasks/add.php';
    }

    public function store(): void
    {
        // Check if user is logged in
        if (!isset($_SESSION['user'])) {
            header('Location: /create-account');
            exit;
        }
        
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $status = $_POST['status'] ?? 'pending';

        if ($title === '') {
            $error = 'Title is required.';
            require __DIR__ . '/../Views/tasks/add.php';
            return;
        }

        $this->taskModel->create($title, $description, $status, (int) $_SESSION['user_id']);
        header('Location: /');
        exit;
    }

    public function edit(): void
    {
        // Check if user is logged in
        if (!isset($_SESSION['user'])) {
            header('Location: /create-account');
            exit;
        }
        
        $id = (int) ($_GET['id'] ?? 0);
        $task = $this->taskModel->find($id, (int) $_SESSION['user_id']);

        if (!$task) {
            http_response_code(404);
            echo 'Task not found.';
            return;
        }

        require __DIR__ . '/../Views/tasks/edit.php';
    }

    public function update(): void
    {
        // Check if user is logged in
        if (!isset($_SESSION['user'])) {
            header('Location: /create-account');
            exit;
        }
        
        $id = (int) ($_GET['id'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $status = $_POST['status'] ?? 'pending';

        if ($title === '') {
            $error = 'Title is required.';
            $task = ['id' => $id, 'title' => $title, 'description' => $description, 'status' => $status];
            require __DIR__ . '/../Views/tasks/edit.php';
            return;
        }

        $this->taskModel->update($id, $title, $description, $status, (int) $_SESSION['user_id']);
        header('Location: /');
        exit;
    }

    public function delete(): void
    {
        // Check if user is logged in
        if (!isset($_SESSION['user'])) {
            header('Location: /create-account');
            exit;
        }
        
        $id = (int) ($_GET['id'] ?? 0);
        $this->taskModel->delete($id, (int) $_SESSION['user_id']);
        header('Location: /');
        exit;
    }
}
