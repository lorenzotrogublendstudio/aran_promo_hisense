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
                'address' => 'Via Emilia Parmense 198, Piacenza (PC)',
                'phone' => '0523 123456',
                'email' => 'info@arancucine-piacenza.it',
                'hours' => 'Lun - Sab 09:00 / 19:30 • Dom su appuntamento',
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
