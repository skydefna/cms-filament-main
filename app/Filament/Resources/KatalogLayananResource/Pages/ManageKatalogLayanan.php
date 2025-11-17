<?php

namespace App\Filament\Resources\KatalogLayananResource\Pages;

use App\Filament\Resources\KatalogLayananResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Tables;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class ManageKatalogLayanan extends ManageRecords
{
    protected static string $resource = KatalogLayananResource::class;

    protected static ?string $title = 'Manajemen Katalog Layanan';

    /**
     * Tombol header (di atas tabel)
     */
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Katalog Layanan')
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
                ->modalHeading('Hapus Katalog Layanan')
                ->modalDescription('Apakah Anda yakin ingin menghapus data ini?'),
        ];
    }
}