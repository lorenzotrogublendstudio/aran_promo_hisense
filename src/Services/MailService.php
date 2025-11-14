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
        $message = [
            'to' => $this->parseAddresses($this->config['to'] ?? []),
            'cc' => $this->parseAddresses($this->config['cc'] ?? []),
            'bcc' => $this->parseAddresses($this->config['bcc'] ?? []),
            'subject' => $this->formatSubject($this->config['subject'] ?? 'Nuova richiesta landing'),
            'from' => $this->config['from'] ?? 'no-reply@example.com',
            'from_name' => $this->config['site_name'] ?? 'Landing Aran',
            'reply_to' => $payload['email'] ?? null,
            'html' => $this->renderLeadTemplate($payload),
            'text' => $this->formatPlainMessage($payload),
        ];

        $sent = $this->deliver($message);

        if (($this->config['confirm']['enabled'] ?? false) && !empty($payload['email'])) {
            $this->sendConfirmation($payload);
        }

        return $sent;
    }

    private function sendConfirmation(array $payload): void
    {
        $confirm = $this->config['confirm'] ?? [];
        $message = [
            'to' => [$payload['email']],
            'subject' => $confirm['subject'] ?? 'Abbiamo ricevuto la tua richiesta',
            'from' => $confirm['from'] ?? ($this->config['from'] ?? 'no-reply@example.com'),
            'from_name' => $confirm['from_name'] ?? ($this->config['site_name'] ?? 'Aran Cucine'),
            'reply_to' => $confirm['from'] ?? ($this->config['from'] ?? null),
            'html' => $this->renderConfirmationTemplate($payload),
            'text' => $this->formatConfirmationText($payload),
        ];

        $this->deliver($message);
    }

    private function deliver(array $message): bool
    {
        $to = implode(',', $message['to'] ?? []);
        if ($to === '') {
            return false;
        }

        $headers = [
            'MIME-Version: 1.0',
            'Content-Type: text/html; charset=UTF-8',
            sprintf('From: %s <%s>', $message['from_name'] ?? $message['from'], $message['from']),
        ];

        if (!empty($message['reply_to'])) {
            $headers[] = 'Reply-To: ' . $message['reply_to'];
        }

        if (!empty($message['cc'])) {
            $headers[] = 'Cc: ' . implode(',', $message['cc']);
        }

        if (!empty($message['bcc'])) {
            $headers[] = 'Bcc: ' . implode(',', $message['bcc']);
        }

        $sent = false;
        if (function_exists('mail')) {
            $sent = mail($to, $message['subject'], $message['html'], implode("\r\n", $headers));
        }

        if (!$sent) {
            $this->fallbackToLog($message['subject'], $message['text'] ?? strip_tags($message['html']));
        }

        return $sent;
    }

    private function parseAddresses(array|string $value): array
    {
        if (is_string($value)) {
            $value = array_filter(array_map('trim', explode(',', $value)));
        }

        return array_values(array_filter($value, fn ($email) => $email !== ''));
    }

    private function renderLeadTemplate(array $payload): string
    {
        $site = $this->config['site_name'] ?? 'Aran Cucine';
        $rows = [
            'Nome e cognome' => $payload['full_name'] ?? '—',
            'Email' => $payload['email'] ?? '—',
            'Telefono' => $payload['phone'] ?? '—',
            'Messaggio' => nl2br(htmlspecialchars($payload['message'] ?? '—', ENT_QUOTES, 'UTF-8')),
            'Origine' => 'Landing Promo Hisense',
            'Data' => date('d/m/Y H:i'),
        ];

        $items = '';
        foreach ($rows as $label => $value) {
            $items .= sprintf(
                '<tr><td style="padding:8px 16px;font-weight:600;border-bottom:1px solid #eee;">%s</td><td style="padding:8px 16px;border-bottom:1px solid #eee;color:#333;">%s</td></tr>',
                htmlspecialchars($label, ENT_QUOTES, 'UTF-8'),
                $value
            );
        }

        return <<<HTML
        <table width="100%" cellpadding="0" cellspacing="0" style="font-family:'Space Grotesk',Arial,sans-serif;background:#f7f4ef;padding:32px 0;">
            <tr>
                <td align="center">
                    <table width="600" cellpadding="0" cellspacing="0" style="background:#fff;border-radius:24px;overflow:hidden;box-shadow:0 25px 60px rgba(0,0,0,0.08);">
                        <tr>
                            <td style="padding:32px 40px;text-align:center;">
                                <p style="margin:0;font-size:13px;letter-spacing:0.5em;text-transform:uppercase;color:#5e5b58;">{$site}</p>
                                <h1 style="margin:12px 0 0;font-size:26px;">Nuova richiesta landing</h1>
                                <p style="margin:4px 0 24px;color:#5e5b58;">Promo Hisense</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;font-size:15px;line-height:1.5;">
                                    {$items}
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:24px 40px;color:#5e5b58;font-size:13px;">
                                Questo messaggio è stato generato automaticamente dal sito {$site}.
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        HTML;
    }

    private function renderConfirmationTemplate(array $payload): string
    {
        $site = $this->config['site_name'] ?? 'Aran Cucine';
        $name = htmlspecialchars($payload['full_name'] ?? 'Cliente', ENT_QUOTES, 'UTF-8');

        return <<<HTML
        <table width="100%" cellpadding="0" cellspacing="0" style="font-family:'Space Grotesk',Arial,sans-serif;background:#f7f4ef;padding:32px 0;">
            <tr>
                <td align="center">
                    <table width="520" cellpadding="0" cellspacing="0" style="background:#fff;border-radius:24px;overflow:hidden;box-shadow:0 15px 40px rgba(0,0,0,0.08);">
                        <tr>
                            <td style="padding:36px 40px;text-align:left;font-size:16px;line-height:1.6;">
                                <p style="margin:0 0 16px;color:#5e5b58;font-size:13px;letter-spacing:0.4em;text-transform:uppercase;">{$site}</p>
                                <h1 style="margin:0 0 12px;font-size:24px;">Ciao {$name}, grazie!</h1>
                                <p style="margin:0 0 16px;">Abbiamo ricevuto la tua richiesta per la Promo Hisense. Un consulente ti ricontatterà entro poche ore per fissare l'appuntamento e mostrarti i vantaggi dedicati.</p>
                                <p style="margin:0 0 16px;">Se hai urgenza puoi rispondere a questa email oppure chiamarci al numero indicato sul sito.</p>
                                <p style="margin:32px 0 0;color:#5e5b58;font-size:13px;">{$site}</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        HTML;
    }

    private function formatPlainMessage(array $payload): string
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

    private function formatConfirmationText(array $payload): string
    {
        return sprintf(
            "Ciao %s,\nabbiamo ricevuto la tua richiesta per la Promo Hisense. Ti ricontatteremo entro poche ore.\n\nGrazie,\n%s",
            $payload['full_name'] ?? 'Cliente',
            $this->config['site_name'] ?? 'Aran Cucine'
        );
    }

    private function formatSubject(string $subject): string
    {
        $site = $this->config['site_name'] ?? null;
        return $site ? "[{$site}] {$subject}" : $subject;
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
