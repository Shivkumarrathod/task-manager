<?php
// Central place for config values. Never hardcode credentials elsewhere.
return [
    'db' => [
        'host' => getenv('DB_HOST') ?: 'localhost',
        'name' => getenv('DB_NAME') ?: 'taskflow',
        'user' => getenv('DB_USER') ?: 'root',
        'pass' => getenv('DB_PASS') ?: '',
        // Path to CA bundle, required by Azure Database for MySQL Flexible Server
        'ssl_ca' => getenv('DB_SSL_CA') ?: null,
    ],
];
