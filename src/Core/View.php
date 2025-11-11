<?php

declare(strict_types=1);

namespace App\Core;

use RuntimeException;

class View
{
    public static function render(string $view, array $data = []): void
    {
        $viewPath = BASE_PATH . '/src/Views/' . $view . '.php';

        if (!file_exists($viewPath)) {
            throw new RuntimeException("View {$view} non trovata.");
        }

        extract($data, EXTR_SKIP);

        require $viewPath;
    }
}
