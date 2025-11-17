<?php

namespace App\Notifications;

use App\Channels\WhatsAppChannel;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class ChangePasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function via(User $notifiable): string
    {
        return WhatsappChannel::class;
    }

    public function toWhatsapp(User $notifiable): array
    {
        Log::info('hit message wa notif to '.$notifiable->phone_number);

        return [
            'message' => 'notifications from '.config('app.url').' \/n '.$this->message,
            'to' => $notifiable->phone_number,
        ];
    }
}
