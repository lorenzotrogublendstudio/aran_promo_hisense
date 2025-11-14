<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\App;
use App\Core\Controller;
use App\Core\Validator;
use App\Models\Subscription;
use App\Services\MailService;

class SubscriptionController extends Controller
{
    private Subscription $subscriptions;
    private MailService $mailer;

    public function __construct()
    {
        $this->subscriptions = new Subscription(App::get('db'));
        $this->mailer = App::get('mailer');
    }

    public function store(): void
    {
        $payload = $this->payload();

        $validator = new Validator($payload, [
            'full_name' => ['required', 'min:3', 'max:120'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'phone'],
            'message' => ['max:500'],
        ]);

        if (!$validator->passes()) {
            $this->json([
                'message' => 'Verifica i campi indicati',
                'errors' => $validator->errors(),
            ], 422);
            return;
        }

        $sent = $this->mailer->sendLead($payload);

        if ($sent) {
            $this->subscriptions->create($payload);

            $this->json([
                'message' => 'Grazie! Ti ricontatteremo entro poche ore.',
            ]);
            return;
        }

        $this->json([
            'message' => 'Si è verificato un problema durante l\'invio. Riprova tra pochi minuti oppure contattaci telefonicamente.',
        ], 500);
    }

    private function payload(): array
    {
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        $data = [];

        if (is_string($contentType) && str_starts_with($contentType, 'application/json')) {
            $body = file_get_contents('php://input');
            $data = json_decode($body ?: '[]', true) ?? [];
        } else {
            $data = $_POST;
        }

        return [
            'full_name' => trim((string) ($data['full_name'] ?? '')),
            'email' => mb_strtolower(trim((string) ($data['email'] ?? ''))),
            'phone' => trim((string) ($data['phone'] ?? '')),
            'message' => trim((string) ($data['message'] ?? '')),
            'origin' => 'landing-promo-hisense',
        ];
    }
}
