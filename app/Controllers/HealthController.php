<?php

class HealthController
{
    public function check(): void
    {
        $dbStatus = 'connected';
        $isHealthy = true;

        try {
            $db = Database::getConnection();
            $db->query('SELECT 1');
        } catch (Throwable $e) {
            $dbStatus = 'unreachable';
            $isHealthy = false;
        }

        http_response_code($isHealthy ? 200 : 503);
        header('Content-Type: application/json');

        echo json_encode([
            'status' => $isHealthy ? 'healthy' : 'unhealthy',
            'timestamp' => date('c'),
            'services' => [
                'app' => 'running',
                'database' => $dbStatus,
            ],
        ], JSON_PRETTY_PRINT);
    }
}
