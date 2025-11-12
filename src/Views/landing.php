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
    <link rel="stylesheet" href="/assets/css/main.css?v=1.0.0">
    <link rel="icon" type="image/x-icon" href="/assets/img/logo_aran.png">
</head>
<body>
<header class="hero hero--image" id="home" aria-labelledby="hero-title" aria-describedby="hero-description">
    <picture class="hero__picture">
        <source media="(max-width: 1024px)" srcset="/assets/img/PROMO%20HISENSE_ANCORA%20BLACK%20FRIDAY_STORIES.jpg">
        <img src="/assets/img/PROMO%20HISENSE_ANCORA%20BLACK%20FRIDAY_WEB_COVER.jpg"
             alt="È già Black Friday promo Hisense con cucina ARAN, Smart TV da 50 pollici e forno PizzaChef in omaggio"
             width="1373" height="768" loading="eager">
    </picture>
    <h1 id="hero-title" class="sr-only"><?= htmlspecialchars(($promo['title_prefix'] ?? 'È GIÀ') . ' ' . ($promo['title'] ?? 'BLACK FRIDAY'), ENT_QUOTES, 'UTF-8'); ?></h1>
    <div id="hero-description" class="sr-only">
        <?= htmlspecialchars($promo['title_prefix'] ?? 'È GIÀ', ENT_QUOTES, 'UTF-8'); ?>
        <?= htmlspecialchars($promo['title'] ?? 'BLACK FRIDAY', ENT_QUOTES, 'UTF-8'); ?>.
        <?= htmlspecialchars($promo['tagline_primary'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
    </div>
    <div class="hero-cta hero-cta--overlay">
        <button type="button" class="btn btn--primary js-open-lead-modal">Prenota la promo</button>
    </div>
</header>
<div class="hero-cta hero-cta--mobile">
    <div class="hero__cta">
        <button type="button" class="btn btn--primary js-open-lead-modal">Prenota la promo</button>
    </div>
</div>
<div class="page">
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
    </section>

    <section class="store">
        <div class="store__content">
            <div class="store__card">
                <p class="store__eyebrow">Flagship store</p>
                <h2><?= htmlspecialchars($store['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h2>
                <ul class="store__details">
                    <li><strong>Indirizzo</strong> <?= htmlspecialchars($store['address'] ?? '', ENT_QUOTES, 'UTF-8'); ?></li>
                </ul>
                <?php if (!empty($store['hours']) && is_array($store['hours'])): ?>
                <div class="store__hours">
                    <p class="store__hours-title">Orari showroom</p>
                    <dl>
                        <?php foreach ($store['hours'] as $day => $slot): ?>
                            <dt><?= htmlspecialchars($day, ENT_QUOTES, 'UTF-8'); ?></dt>
                            <dd><?= htmlspecialchars($slot, ENT_QUOTES, 'UTF-8'); ?></dd>
                        <?php endforeach; ?>
                    </dl>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="store__map">
            <iframe title="Mappa Aran Cucine Piacenza"
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2821.3082435096785!2d9.790354!3d44.998362!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4780efb814e236b1%3A0xa93867c88a2e257e!2sAran%20Cucine%20Store%20Piacenza!5e0!3m2!1sit!2sit!4v1762855459126!5m2!1sit!2sit"
                    width="600" height="450"
                    style="border:0;"
                    allowfullscreen
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <section class="lead" id="prenota">
        <div class="lead__intro">
            <p class="lead__eyebrow">Prenota la promo</p>
            <h2>Blocca il tuo appuntamento esclusivo</h2>
            <p>Compila il form, il team Aran Piacenza ti ricontatta entro 24 ore per fissare un incontro dedicato e mostrarti tutti i vantaggi dell’offerta.</p>
        </div>
        <form class="lead-form" id="lead-form" novalidate data-lead-form>
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
    <p class="site-footer__legal">
        2M Mondani Arredamenti S.R.L. Via Roma 24, 29010 Pontenure - Italy - T. 0523.718895 - P .IVA 01906470339
    </p>
</footer>

<div class="lead-modal" id="lead-modal" aria-hidden="true">
    <div class="lead-modal__overlay" data-modal-close></div>
    <div class="lead-modal__content" role="dialog" aria-modal="true" aria-labelledby="lead-modal-title">
        <button class="lead-modal__close" type="button" data-modal-close aria-label="Chiudi il form">
            ×
        </button>
        <div class="lead__intro">
            <p class="lead__eyebrow">Prenota la promo</p>
            <h2 id="lead-modal-title">Compila il form e ti richiamiamo subito</h2>
            <p>Ti ricontatteremo entro 24 ore per confermare l’appuntamento e illustrarti tutti i vantaggi della promo Hisense.</p>
        </div>
        <form class="lead-form" id="lead-form-modal" novalidate data-lead-form>
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
    </div>
</div>

<script defer src="/assets/js/main.js?v=1.0.0"></script>
</body>
</html>
