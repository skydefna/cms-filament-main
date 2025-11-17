<?php

namespace App\Enums;

enum ListUrlInternal: string
{
    case DASHBOARD = '/';
    case KATALOG = '/katalog';    
    case DOKUMEN = '/dokumen';
    case MONITORING = '/monitoring';    

    public static function options(): \Illuminate\Support\Collection|array
    {
        return collect(self::cases())->mapWithKeys(fn ($v) => [
            $v->value => str_replace('_', ' ', $v->value),
        ])->toArray();
    }
}
