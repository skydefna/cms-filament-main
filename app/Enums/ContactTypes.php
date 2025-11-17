<?php

namespace App\Enums;

enum ContactTypes: string
{
    case Phone = 'phone';
    case Mail = 'mail';
    case Fax = 'fax';
    case Whatsapp = 'whatsapp';
    case Telegram = 'telegram';

    public static function all(): array
    {
        return collect(self::cases())->pluck('name', 'value')->toArray();
    }
}
