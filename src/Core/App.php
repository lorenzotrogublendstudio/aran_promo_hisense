<?php

declare(strict_types=1);

namespace App\Core;

use RuntimeException;

/**
 * Piccolissimo contenitore di dipendenze.
 */
class App
{
    /**
     * @var array<string, mixed>
     */
    protected static array $container = [];

    public static function bind(string $key, mixed $value): void
    {
        self::$container[$key] = $value;
    }

    public static function get(string $key): mixed
    {
        if (!array_key_exists($key, self::$container)) {
            throw new RuntimeException("Nessun servizio registrato con chiave {$key}");
        }

        return self::$container[$key];
    }
}
