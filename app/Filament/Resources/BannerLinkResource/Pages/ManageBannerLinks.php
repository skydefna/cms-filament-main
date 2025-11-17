<?php

namespace App\Filament\Resources\BannerLinkResource\Pages;

use App\Filament\Resources\BannerLinkResource;
use App\Models\BannerLink;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageBannerLinks extends ManageRecords
{
    protected static string $resource = BannerLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->mutateFormDataUsing(function ($data) {
                    $data['sort'] = BannerLink::max('sort') + 1;

                    return $data;
                }),
        ];
    }
}
