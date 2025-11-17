<?php

namespace App\Enums;

enum MenuType: string
{
    case PAGE = 'page';
    case URL_INTERNAL = 'url_internal';
    case URL_EXTERNAL = 'url_external';
    case DROPDOWN = 'dropdown';

    public static function options(): \Illuminate\Support\Collection|array
    {
        $result = collect(self::cases())->mapWithKeys(fn ($v) => [
            $v->value => ucwords(str_replace('_', ' ', $v->value)),
        ])->toArray();

        return $result;
    }
}
