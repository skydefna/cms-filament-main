<?php

namespace App\Channels;

use App\Models\User;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppChannel
{
    /**
     * @throws \Exception
     */
    public function send(User $notifiable, Notification $notification): bool
    {
        if (! empty(config('service.evolution.url'))) {
            $notificationPayload = $notification->toWhatsApp($notifiable);
            $baseUrl = config('service.evolution.url');
            $instance = config('service.evolution.instance');
            $apiKey = config('service.evolution.api_key');

            $payload = [
                'number' => $notificationPayload['to'],
                'text' => $notificationPayload['message'],
            ];
            if (config('app.debug')) {
                Log::info('hit whatsapp channel message whatsapp with notification payload', $notificationPayload);
                Log::info('payload for channel', $payload);
            }
            try {
                $response = Http::asJson()
                    ->withHeader('apiKey', $apiKey)
                    ->post("$baseUrl/message/sendText/$instance", $payload);
            } catch (ConnectionException $e) {
                Log::error($e);
                throw new \Exception($e);
            }

            return $response->successful();
        }

        return true;
    }
}
