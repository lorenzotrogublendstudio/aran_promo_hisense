<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Impostazioni notifiche mail
    |--------------------------------------------------------------------------
    |
    | I destinatari, mittenti e le opzioni di conferma vengono letti dal file .env.
    | Se non presenti, vengono usati i valori di fallback definiti qui sotto.
    |
    */
    'site_name' => env('SITE_NAME', 'ARAN Cucine Store Piacenza'),
    'to' => env_array('MAIL_TO', ['info@arancucine-piacenza.it']),
    'cc' => env_array('MAIL_CC', []),
    'bcc' => env_array('MAIL_BCC', []),
    'from' => env('MAIL_FROM', 'no-reply@arancucine-piacenza.it'),
    'subject' => env('SUBJECT', 'Nuova richiesta Promo Hisense - Landing Aran Piacenza'),
    'allowed_origins' => env_array('ALLOWED_ORIGINS', []),
    'smtp' => [
        'enabled' => (bool) env('SMTP_ENABLED', false),
        'host' => env('SMTP_HOST'),
        'port' => env('SMTP_PORT', 587),
        'user' => env('SMTP_USER'),
        'pass' => env('SMTP_PASS'),
        'secure' => env('SMTP_SECURE', 'tls'),
    ],
    'confirm' => [
        'enabled' => (bool) env('CONFIRM_ENABLED', false),
        'subject' => env('CONFIRM_SUBJECT', 'Abbiamo ricevuto la tua richiesta'),
        'from' => env('CONFIRM_FROM', env('MAIL_FROM', 'no-reply@arancucine-piacenza.it')),
        'from_name' => env('CONFIRM_FROM_NAME', env('SITE_NAME', 'ARAN Cucine Store Piacenza')),
    ],
];
