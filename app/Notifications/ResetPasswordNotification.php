<?php

namespace App\Notifications;

use App\Channels\WhatsAppChannel;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class ResetPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public string $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via(object $notifiable): array
    {
        return [
            'mail',
            WhatsappChannel::class,
        ];
    }

    public function toMail(User $notifiable): MailMessage
    {
        $url = Filament::getResetPasswordUrl($this->token, $notifiable);

        return (new MailMessage)
            ->subject(Lang::get('Reset Password Notification'))
            ->greeting(Lang::get('Hello, :name!', ['name' => $notifiable->name]))
            ->line(Lang::get('You are receiving this email because we received a password reset request for your account.'))
            ->action(Lang::get('Reset Password'), $url)
            ->line(Lang::get('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.users.expire')]))
            ->line(Lang::get('If you did not request a password reset, no further action is required.'));
    }

    public function toWhatsapp(User $notifiable): array
    {
        Log::info('hit message wa notif to '.$notifiable->phone_number);
        $url = Filament::getResetPasswordUrl($this->token, $notifiable);

        return [
            'message' => 'password reset link '.$url,
            'to' => $notifiable->phone_number,
        ];
    }
}
