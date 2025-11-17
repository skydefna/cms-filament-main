<?php

namespace App\Filament\Resources\KategoriPelayananResource\Pages;

use App\Filament\Resources\KategoriPelayananResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Support\Str;

class ManageKategoriPelayanan extends ManageRecords
{
    protected static string $resource = KategoriPelayananResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->mutateFormDataUsing(function (array $data) {
                    // Generate slug before creating
                    $data['slug'] = Str::slug($data['name']);

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
                    $data['slug'] = Str::slug($data['name']);

                    return $data;
                }),
            Actions\DeleteAction::make(),
        ];
    }
}
