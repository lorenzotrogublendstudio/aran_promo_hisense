<?php

use Dotenv\Dotenv;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

return [
    'SITE_NAME' => $_ENV['SITE_NAME'] ?? 'ARAN Cucine Store Piacenza',
    'MAIL_TO' => $_ENV['MAIL_TO'] ?? 'info@arancucine-piacenza.it',
    'MAIL_CC' => $_ENV['MAIL_CC'] ?? '',
    'MAIL_BCC' => $_ENV['MAIL_BCC'] ?? '',
    'MAIL_FROM' => $_ENV['MAIL_FROM'] ?? 'no-reply@arancucine-piacenza.it',
    'SUBJECT' => $_ENV['SUBJECT'] ?? 'Nuova richiesta Promo Hisense - Landing Aran Piacenza',
    'ALLOWED_ORIGINS' => array_filter(explode(',', $_ENV['ALLOWED_ORIGINS'] ?? '')),
    'SMTP_ENABLED' => filter_var($_ENV['SMTP_ENABLED'] ?? false, FILTER_VALIDATE_BOOLEAN),
    'SMTP_HOST' => $_ENV['SMTP_HOST'] ?? '',
    'SMTP_PORT' => (int)($_ENV['SMTP_PORT'] ?? 587),
    'SMTP_USER' => $_ENV['SMTP_USER'] ?? '',
    'SMTP_PASS' => $_ENV['SMTP_PASS'] ?? '',
    'SMTP_SECURE' => $_ENV['SMTP_SECURE'] ?? 'tls',
    'CONFIRM_ENABLED' => filter_var($_ENV['CONFIRM_ENABLED'] ?? false, FILTER_VALIDATE_BOOLEAN),
    'CONFIRM_SUBJECT' => $_ENV['CONFIRM_SUBJECT'] ?? 'Abbiamo ricevuto la tua richiesta',
    'CONFIRM_FROM' => $_ENV['CONFIRM_FROM'] ?? $_ENV['MAIL_FROM'] ?? 'no-reply@arancucine-piacenza.it',
    'CONFIRM_FROM_NAME' => $_ENV['CONFIRM_FROM_NAME'] ?? $_ENV['SITE_NAME'] ?? 'ARAN Cucine Store Piacenza',
];
