<?php

declare(strict_types=1);

use App\Core\App;
use App\Core\Config;
use App\Core\Database;
use App\Services\MailService;

define('BASE_PATH', dirname(__DIR__));

if (!function_exists('loadEnv')) {
    function loadEnv(string $path): void
    {
        if (!file_exists($path)) {
            return;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
                continue;
            }

            [$name, $value] = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            if (($value[0] ?? '') === '"' && (str_ends_with($value, '"'))) {
                $value = substr($value, 1, -1);
            } elseif (($value[0] ?? '') === "'" && (str_ends_with($value, "'"))) {
                $value = substr($value, 1, -1);
            }

            $_ENV[$name] = $value;
            putenv("{$name}={$value}");
        }
    }
}

if (!function_exists('env')) {
    function env(string $key, mixed $default = null): mixed
    {
        $value = $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key);
        if ($value === false || $value === null) {
            return $default;
        }

        $value = trim((string) $value);
        $lower = strtolower($value);

        return match ($lower) {
            'true', '(true)' => true,
            'false', '(false)' => false,
            'empty', '(empty)' => '',
            'null', '(null)' => null,
            default => $value,
        };
    }
}

if (!function_exists('env_array')) {
    function env_array(string $key, array $default = []): array
    {
        $value = env($key);
        if ($value === null) {
            return $default;
        }

        if (is_array($value)) {
            return $value;
        }

        $parts = array_filter(array_map('trim', explode(',', (string) $value)));
        return $parts ?: $default;
    }
}

loadEnv(BASE_PATH . '/.env');

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
