<?php

namespace App\Filament\Resources\DokumentasiDigitalResource\Pages;

use App\Filament\Resources\DokumentasiDigitalResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class ManageDokumentasiDigital extends ManageRecords
{
    protected static string $resource = DokumentasiDigitalResource::class;

    protected static ?string $title = 'Manajemen Dokumentasi dan Kebijakan';

    /**
     * Tombol header (di atas tabel)
     */
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Dokumentasi')
                ->icon('heroicon-o-plus-circle'),
        ];
    }

    /**
     * Override aksi tabel (edit dan delete)
     */
    protected function getTableActions(): array
    {
        return [
            EditAction::make()
                ->label('Edit')
                ->icon('heroicon-o-pencil-square')
                ->color('warning'),

            DeleteAction::make()
                ->label('Hapus')
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->requiresConfirmation()
                ->modalHeading('Hapus Dokumentasi')
                ->modalDescription('Apakah Anda yakin ingin menghapus data ini?'),
        ];
    }
}