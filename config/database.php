<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Connessione MySQL
    |--------------------------------------------------------------------------
    |
    | Aggiorna host, database o credenziali se l'ambiente differisce.
    | La chiave `dsn` viene letta direttamente dal Database core.
    |
    */
    'driver' => 'mysql',
    'host' => '127.0.0.1',
    'port' => 3306,
    'database' => 'aran_promo',
    'username' => 'root',
    'password' => 'Lorenzo2003',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'dsn' => 'mysql:host=127.0.0.1;port=3306;dbname=aran_promo;charset=utf8mb4',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ],
];
