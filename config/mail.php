<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Impostazioni notifiche mail
    |--------------------------------------------------------------------------
    |
    | Il mailer utilizza la funzione mail() di PHP.
    | - `to`: destinatari (array o stringa)
    | - `subject`: oggetto di default
    | - `from`: indirizzo mittente (visualizzato dal cliente)
    |
    | In ambienti senza configurazione SMTP, i messaggi vengono salvati
    | automaticamente nel file storage/mail.log
    |
    */
    'to' => ['info@arancucine-piacenza.it'],
    'subject' => 'Nuova richiesta Promo Hisense - Landing Aran Piacenza',
    'from' => 'no-reply@arancucine-piacenza.it',
];
