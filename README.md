# Aran Cucine Store Piacenza - Promo Hisense

Landing page in plain **HTML/CSS/JS** con back-end **PHP MVC minimale** per salvare i lead su MySQL e inviare le notifiche via mail.

## Struttura del progetto

- config/database.php — parametri MySQL (dsn, credenziali)
- config/mail.php — destinatari e oggetto delle notifiche
- public/index.php — front controller e router entrypoint
- public/assets/css/main.css — stili responsive ispirati al mockup
- public/assets/js/main.js — submit asincrono e micro animazioni
- public/assets/img/ — placeholder SVG per loghi e render
- src/bootstrap.php — autoload, binding servizi e migrazione tabella
- src/Core — router, view, database helper, validator, ecc.
- src/Controllers — LandingController e SubscriptionController
- src/Models/Subscription.php — inserimento lead
- src/Services/MailService.php — invio mail o logging su storage/mail.log
- src/Views/landing.php — markup della landing
- storage/ — deve essere scrivibile per eventuali log

## Setup rapido

1. Crea il database `aran_promo` su MySQL e aggiorna `config/database.php` se host o credenziali differiscono (default: user `root`, password `Lorenzo2003`).
2. Avvia il progetto con il server PHP integrato o un virtual host:
   ```
   php -S localhost:8000 -t public
   ```
3. Rendi scrivibile la cartella `storage/` in modo che il mailer possa salvare i fallback log quando `mail()` non e' configurata.
4. Personalizza `config/mail.php` con indirizzi reali, apri `http://localhost:8000` e prova il form: i dati finiscono nella tabella `subscriptions` (creata automaticamente) e arriva la mail/voce di log.

## Note di design

- Layout, palette e tipografia brush riprendono il concept fornito (versioni desktop e mobile).
- Gli SVG inclusi sono segnaposto facilmente sostituibili con gli asset ufficiali.
- La callout "Vedi regolamento interno" puo' collegare un PDF o un link esterno a seconda delle policy.

Per estensioni future (CRM, dashboard lead, invio automatico di pdf, ecc.) e' sufficiente aggiungere nuovi controller/servizi seguendo la struttura esistente.
