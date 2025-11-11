<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

class LandingController extends Controller
{
    public function index(): void
    {
        $this->view('landing', [
            'store' => [
                'name' => 'ARAN Cucine Store Piacenza',
                'address' => 'Via Roma, 24, 29010 Pontenure PC',
                'phone' => '0523718895',
                'email' => 'info@arancucine-piacenza.it',
                'hours' => [
                    'Lunedì' => '09:30–12:30 / 15:30–19:30',
                    'Martedì' => '09:30–12:30 / 15:30–19:30',
                    'Mercoledì' => '09:30–12:30 / 15:30–19:30',
                    'Giovedì' => '09:30–12:30 / 15:30–19:30',
                    'Venerdì' => '09:30–12:30 / 15:30–19:30',
                    'Sabato' => '09:30–12:30 / 15:30–19:30',
                    'Domenica' => 'Chiuso',
                ],
            ],
            'promo' => [
                'title_prefix' => 'È GIÀ',
                'title' => 'BLACK FRIDAY',
                'subtitle' => 'Promo valida fino a fine mese',
                'tagline_primary' => 'Con l’acquisto di una cucina ARAN completa di elettrodomestici Hisense avrai Smart TV da 50” e forno PizzaChef (o Forno Steam Pro) in OMAGGIO.',
                'legal' => 'Vedi regolamento interno',
            ],
        ]);
    }
}
