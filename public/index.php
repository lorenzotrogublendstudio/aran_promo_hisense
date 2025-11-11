<?php

declare(strict_types=1);

require dirname(__DIR__) . '/src/bootstrap.php';

use App\Controllers\LandingController;
use App\Controllers\SubscriptionController;
use App\Core\Router;

$router = new Router();
$router->get('/', [LandingController::class, 'index']);
$router->post('/api/subscriptions', [SubscriptionController::class, 'store']);

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router->dispatch($method, $uri ?? '/');
