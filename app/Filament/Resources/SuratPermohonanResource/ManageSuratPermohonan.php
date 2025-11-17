<?php

namespace App\Filament\Resources\SuratPermohonanResource\Pages;

use Filament\Actions;
use App\Filament\Resources\SuratPermohonanResource;
use Filament\Resources\Pages\ManageRecords;

class ManageSuratPermohonan extends ManageRecords
{
    protected static string $resource = SuratPermohonanResource::class;

    public function getTitle(): string
    {
        return 'Surat Permohonan';
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        $data['status'] = $data['status'] ?? 'Menunggu';
        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}