<?php
declare(strict_types=1);

$store = $store ?? [];
$promo = $promo ?? [];

?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="È già Black Friday nel flagship Aran Cucine Piacenza: promo Hisense con Smart TV 50'' e forno PizzaChef/Steam Pro in omaggio. Prenota la tua consulenza.">
    <title>È già Black Friday • Aran Cucine Store Piacenza</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600&family=Permanent+Marker&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/main.css?v=1.0.0">
    <link rel="icon" type="image/svg+xml" href="/assets/img/logo-aran.svg">
</head>
<body>
<div class="page">
    <header class="hero" id="home">
        <div class="hero__content">
            <div class="hero__logo">
                <img src="/assets/img/logo-aran.svg" alt="Aran Cucine" width="180" height="64" loading="lazy">
            </div>
            <p class="hero__eyebrow"><?= htmlspecialchars($promo['title_prefix'] ?? 'È GIÀ', ENT_QUOTES, 'UTF-8'); ?></p>
            <h1 class="hero__title"><?= htmlspecialchars($promo['title'] ?? 'BLACK FRIDAY', ENT_QUOTES, 'UTF-8'); ?></h1>
            <p class="hero__subtitle"><?= htmlspecialchars($promo['subtitle'] ?? 'Promo valida fino a fine mese', ENT_QUOTES, 'UTF-8'); ?></p>

            <div class="promo-tag" aria-label="Promo Hisense">
                <span class="promo-tag__label">promo</span>
                <span class="promo-tag__brand">Hisense</span>
            </div>

            <p class="hero__lead">
                <?= htmlspecialchars($promo['tagline_primary'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
            </p>

            <div class="hero__cta">
                <a class="btn btn--primary" href="#prenota">Prenota la promo</a>
                <a class="btn btn--ghost" href="tel:<?= preg_replace('/\s+/', '', $store['phone'] ?? ''); ?>">Chiama lo store</a>
            </div>
        </div>
        <div class="hero__visual">
            <picture>
                <source srcset="/assets/img/kitchen-hero.svg" type="image/svg+xml">
                <img src="/assets/img/kitchen-hero.svg" alt="Render cucina Aran con isola" width="640" height="420" loading="lazy">
            </picture>
            <div class="hero__badge">
                <p>Promo valida<br>fino a<br><strong>fine mese</strong></p>
            </div>
        </div>
    </header>

    <section class="bundle" id="bundle">
        <div class="bundle__intro">
            <p class="bundle__eyebrow">Per chi sceglie ARAN + Hisense</p>
            <h2>Smart TV 50" + forno PizzaChef/Steam Pro in omaggio</h2>
            <p>Completa la tua cucina con elettrodomestici Hisense: per tutto il mese avrai inclusi una Smart TV 4K da 50” e un forno PizzaChef (o Steam Pro). È la promo perfetta per portare l’esperienza ARAN direttamente a casa tua.</p>
        </div>

        <div class="bundle__items">
            <article class="bundle-card">
                <img src="/assets/img/smart-tv.svg" alt="Smart TV Hisense" width="280" height="200" loading="lazy">
                <h3>Smart TV Hisense 50”</h3>
                <p>Schermo 4K HDR, colori brillanti e piattaforma VIDAA U per tutte le app streaming.</p>
            </article>
            <div class="bundle-card bundle-card--plus" aria-hidden="true">
                <span>+</span>
            </div>
            <article class="bundle-card">
                <img src="/assets/img/oven.svg" alt="Forno PizzaChef e Steam Pro" width="220" height="200" loading="lazy">
                <h3>Forno PizzaChef / Steam Pro</h3>
                <p>Cottura professionale con programmi automatici e finiture full black abbinate alla cucina.</p>
            </article>
        </div>
        <p class="bundle__legal"><?= htmlspecialchars($promo['legal'] ?? 'Vedi regolamento interno', ENT_QUOTES, 'UTF-8'); ?></p>
    </section>

    <section class="store">
        <div class="store__content">
            <p class="store__eyebrow">Flagship store</p>
            <h2><?= htmlspecialchars($store['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h2>
            <ul class="store__details">
                <li><strong>Indirizzo</strong> <?= htmlspecialchars($store['address'] ?? '', ENT_QUOTES, 'UTF-8'); ?></li>
                <li><strong>Telefono</strong> <a href="tel:<?= preg_replace('/\s+/', '', $store['phone'] ?? ''); ?>"><?= htmlspecialchars($store['phone'] ?? '', ENT_QUOTES, 'UTF-8'); ?></a></li>
                <li><strong>Email</strong> <a href="mailto:<?= htmlspecialchars($store['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"><?= htmlspecialchars($store['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?></a></li>
                <li><strong>Orari</strong> <?= htmlspecialchars($store['hours'] ?? '', ENT_QUOTES, 'UTF-8'); ?></li>
            </ul>
            <p class="store__copy">Consulenze personalizzate, progettazione 3D e assistenza post vendita firmate Aran World. Prenota una visita o richiedi un incontro video: ti riserviamo promozioni e finiture dedicate allo store di Piacenza.</p>
        </div>
        <div class="store__map">
            <iframe title="Mappa Aran Cucine Piacenza" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                    src="https://www.google.com/maps/embed/v1/place?key=AIzaSyD-example&zoom=15&q=Aran+Cucine+Piacenza"
                    allowfullscreen></iframe>
            <small>Inserire la Google Maps API key per mostrare la posizione dello store.</small>
        </div>
    </section>

    <section class="lead" id="prenota">
        <div class="lead__intro">
            <p class="lead__eyebrow">Prenota la promo</p>
            <h2>Blocca il tuo appuntamento esclusivo</h2>
            <p>Compila il form, il team Aran Piacenza ti ricontatta entro 24 ore per fissare un incontro dedicato e mostrarti tutti i vantaggi dell’offerta.</p>
        </div>
        <form class="lead-form" id="lead-form" novalidate>
            <label class="field">
                <span>Nome e cognome *</span>
                <input type="text" name="full_name" placeholder="Mario Rossi" required maxlength="120">
            </label>
            <label class="field">
                <span>Email *</span>
                <input type="email" name="email" placeholder="nome@email.com" required>
            </label>
            <label class="field">
                <span>Telefono *</span>
                <input type="tel" name="phone" placeholder="+39 333 1234567" required>
            </label>
            <label class="field field--full">
                <span>Note aggiuntive</span>
                <textarea name="message" rows="4" placeholder="Preferenze di orario, richieste specifiche..."></textarea>
            </label>
            <label class="checkbox">
                <input type="checkbox" name="privacy" required>
                <span>Ho letto l’informativa privacy e acconsento al trattamento dei dati.</span>
            </label>
            <button type="submit" class="btn btn--primary btn--full">
                Invia richiesta
                <span class="btn__loader" aria-hidden="true"></span>
            </button>
            <p class="form-feedback" role="status" aria-live="polite"></p>
        </form>
    </section>

    <section class="faq" id="faq">
        <div class="faq__item">
            <h3>Cosa include la promo?</h3>
            <p>Cucina ARAN completa di elettrodomestici Hisense + Smart TV da 50” e forno PizzaChef/Steam Pro in omaggio. Valido su nuovi progetti confermati entro il mese.</p>
        </div>
        <div class="faq__item">
            <h3>Serve prenotare?</h3>
            <p>Sì. La promo è limitata: compilando il form garantisci disponibilità e blocchi l’appuntamento con un designer.</p>
        </div>
        <div class="faq__item">
            <h3>È possibile finanziare?</h3>
            <p>Sono attivabili soluzioni di pagamento rateale in store. Indicalo nel messaggio e ti ricontattiamo con i dettagli.</p>
        </div>
    </section>
</div>

<footer class="site-footer">
    <div class="site-footer__brand">
        <img src="/assets/img/logo-aran.svg" alt="Aran Cucine" width="140" height="48" loading="lazy">
        <p><?= htmlspecialchars($store['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
    </div>
    <div class="site-footer__contacts">
        <p><strong>Store</strong> <?= htmlspecialchars($store['address'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Telefono</strong> <a href="tel:<?= preg_replace('/\s+/', '', $store['phone'] ?? ''); ?>"><?= htmlspecialchars($store['phone'] ?? '', ENT_QUOTES, 'UTF-8'); ?></a></p>
        <p><strong>Email</strong> <a href="mailto:<?= htmlspecialchars($store['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"><?= htmlspecialchars($store['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?></a></p>
    </div>
    <p class="site-footer__legal"><?= htmlspecialchars($promo['legal'] ?? 'Vedi regolamento interno', ENT_QUOTES, 'UTF-8'); ?></p>
</footer>

<script defer src="/assets/js/main.js?v=1.0.0"></script>
</body>
</html>
