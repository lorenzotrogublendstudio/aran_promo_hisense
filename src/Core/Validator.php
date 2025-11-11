<?php

declare(strict_types=1);

namespace App\Core;

class Validator
{
    private array $errors = [];

    public function __construct(private array $data, private array $rules)
    {
    }

    public function passes(): bool
    {
        foreach ($this->rules as $field => $rules) {
            $value = $this->data[$field] ?? null;
            $this->applyRules($field, $value, (array) $rules);
        }

        return empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    private function applyRules(string $field, mixed $value, array $rules): void
    {
        foreach ($rules as $rule) {
            $parameters = null;
            if (is_string($rule) && str_contains($rule, ':')) {
                [$rule, $parameters] = explode(':', $rule, 2);
            }

            $method = 'validate' . ucfirst($rule);
            if (method_exists($this, $method)) {
                $this->{$method}($field, $value, $parameters);
            }
        }
    }

    private function validateRequired(string $field, mixed $value): void
    {
        if ($value === null || $value === '') {
            $this->errors[$field][] = 'Campo obbligatorio';
        }
    }

    private function validateEmail(string $field, mixed $value): void
    {
        if ($value && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field][] = 'Formato email non valido';
        }
    }

    private function validateMin(string $field, mixed $value, ?string $min): void
    {
        if ($value && mb_strlen((string) $value) < (int) $min) {
            $this->errors[$field][] = "Minimo {$min} caratteri";
        }
    }

    private function validateMax(string $field, mixed $value, ?string $max): void
    {
        if ($value && mb_strlen((string) $value) > (int) $max) {
            $this->errors[$field][] = "Massimo {$max} caratteri";
        }
    }

    private function validatePhone(string $field, mixed $value): void
    {
        if ($value && !preg_match('/^[0-9 +().-]{8,20}$/', (string) $value)) {
            $this->errors[$field][] = 'Numero di telefono non valido';
        }
    }
}
