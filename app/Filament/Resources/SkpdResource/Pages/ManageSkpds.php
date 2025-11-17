<?php

namespace App\Filament\Resources\SkpdResource\Pages;

use Filament\Actions;
use Illuminate\Support\Str;
use App\Filament\Resources\SkpdResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\ManageRecords;

class ManageSkpds extends ManageRecords
{
    protected static string $resource = SkpdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->mutateFormDataUsing(function (array $data) {
                    // Generate slug before creating
                    $data['slug'] = Str::slug($data['nama']);

                    return $data;
                }),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Actions\EditAction::make()
                ->mutateFormDataUsing(function (array $data): array {
                    // Generate slug before updating
                    $data['slug'] = Str::slug($data['nama']);

                    return $data;
                }),
            Actions\DeleteAction::make(),
        ];
    }
}
