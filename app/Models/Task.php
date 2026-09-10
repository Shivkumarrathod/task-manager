<?php

require_once __DIR__ . '/../../core/Database.php';

class Task
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function all(int $userId): array
    {
        $stmt = $this->db->prepare('SELECT * FROM tasks WHERE user_id = ? ORDER BY created_at DESC');
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function find(int $id, int $userId): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM tasks WHERE id = ? AND user_id = ?');
        $stmt->execute([$id, $userId]);
        $task = $stmt->fetch();
        return $task ?: null;
    }

    public function create(string $title, string $description, string $status, int $userId): bool
    {
        $stmt = $this->db->prepare(
            'INSERT INTO tasks (title, description, status, user_id) VALUES (?, ?, ?, ?)'
        );
        return $stmt->execute([$title, $description, $status, $userId]);
    }
    public function createUser(string $name, string $email, string $password): bool
    {
        $stmt = $this->db->prepare(
            'INSERT INTO users (email, name, password) VALUES (?, ?, ?)'
        );
        return $stmt->execute([$email, $name, $password]);
    }

    public function loginUser(string $email, string $password):bool{
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            // Successful login
            $_SESSION['name'] = $user['name']; 
            $_SESSION['email'] = $user['email'];
            $_SESSION['user_id'] = $user['id'];
            return true;
        } else {
            // Invalid credentials
            return false;
        }
    }

    public function update(int $id, string $title, string $description, string $status, int $userId): bool
    {
        $stmt = $this->db->prepare(
            'UPDATE tasks SET title = ?, description = ?, status = ? WHERE id = ? AND user_id = ?'
        );
        return $stmt->execute([$title, $description, $status, $id, $userId]);
    }

    public function delete(int $id, int $userId): bool
    {
        $stmt = $this->db->prepare('DELETE FROM tasks WHERE id = ? AND user_id = ?');
        return $stmt->execute([$id, $userId]);
    }
    public function getAllUsers(): array
    {
        $stmt = $this->db->query('SELECT id, name, email FROM users');
        return $stmt->fetchAll();
    }

}
