<?php

declare(strict_types=1);

use App\Core\App;
use App\Core\Config;
use App\Core\Database;
use App\Services\MailService;

define('BASE_PATH', dirname(__DIR__));

spl_autoload_register(function (string $class): void {
    $prefix = 'App\\';
    if (str_starts_with($class, $prefix)) {
        $relative = substr($class, strlen($prefix));
        $path = BASE_PATH . '/src/' . str_replace('\\', '/', $relative) . '.php';
        if (file_exists($path)) {
            require $path;
        }
    }
});

date_default_timezone_set('Europe/Rome');

$config = [
    'database' => require BASE_PATH . '/config/database.php',
    'mail' => require BASE_PATH . '/config/mail.php',
];

$configRepository = new Config($config);
App::bind('config', $configRepository);
App::bind(Config::class, $configRepository);

$database = new Database($config['database']);
$database->migrate();
App::bind('db', $database);
App::bind(Database::class, $database);

$mailer = new MailService($config['mail'], BASE_PATH . '/storage/mail.log');
App::bind('mailer', $mailer);
App::bind(MailService::class, $mailer);
