<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\ChangePasswordNotification;

class NotificationService
{
    public function sendTestNotification(User $notifiable, string $message): void
    {
        $notification = new ChangePasswordNotification($message);
        $notifiable->notify($notification);
    }
}
