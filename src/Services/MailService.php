<?php

declare(strict_types=1);

namespace App\Services;

class MailService
{
    private string $logPath;

    public function __construct(private array $config, ?string $logPath = null)
    {
        $this->logPath = $logPath ?? dirname(__DIR__, 2) . '/storage/mail.log';
    }

    public function sendLead(array $payload): bool
    {
        $recipients = (array) ($this->config['to'] ?? []);
        $subject = $this->config['subject'] ?? 'Nuova richiesta landing';
        $from = $this->config['from'] ?? 'no-reply@example.com';
        $replyTo = $payload['email'] ?? $from;

        $body = $this->formatMessage($payload);
        $headers = [
            "From: {$from}",
            "Reply-To: {$replyTo}",
            "Content-Type: text/plain; charset=UTF-8",
        ];

        $sent = false;

        foreach ($recipients as $to) {
            if (function_exists('mail')) {
                $sent = mail($to, $subject, $body, implode("\r\n", $headers)) || $sent;
            }
        }

        if (!$sent) {
            $this->fallbackToLog($subject, $body);
        }

        return $sent;
    }

    private function formatMessage(array $payload): string
    {
        $lines = [
            'Nuovo lead promo Hisense:',
            '---------------------------',
            'Nome completo: ' . ($payload['full_name'] ?? ''),
            'Email: ' . ($payload['email'] ?? ''),
            'Telefono: ' . ($payload['phone'] ?? ''),
            'Messaggio: ' . ($payload['message'] ?? ''),
            'Origine: landing Aran Cucine Piacenza',
            'Data: ' . date('d/m/Y H:i'),
        ];

        return implode(PHP_EOL, $lines);
    }

    private function fallbackToLog(string $subject, string $body): void
    {
        $entry = sprintf(
            "[%s] %s%s%s%s",
            date('c'),
            $subject,
            PHP_EOL,
            $body,
            PHP_EOL . str_repeat('-', 40) . PHP_EOL
        );

        file_put_contents($this->logPath, $entry, FILE_APPEND);
    }
}
