<?php

namespace App\Enums;

enum SocialMediaTypes: string
{
    case Facebook = 'facebook';
    case Twitter = 'twitter';
    case Instagram = 'instagram';
    case Youtube = 'youtube';
    case Whatsapp = 'whatsapp';
    case Telegram = 'telegram';
    case X = 'x';
    case Tiktok = 'tiktok';

    public static function all(): array
    {
        return collect(self::cases())->pluck('name', 'value')->toArray();
    }
}
