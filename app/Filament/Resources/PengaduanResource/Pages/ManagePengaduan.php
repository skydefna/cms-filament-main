<?php

namespace App\Filament\Resources\PengaduanResource\Pages;

use App\Filament\Resources\PengaduanResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Tables;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class ManagePengaduan extends ManageRecords
{
    protected static string $resource = PengaduanResource::class;

    protected static ?string $title = 'Pengaduan dan Konsultasi';

    /**
     * Tombol header (di atas tabel)
     */
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Aduan dan Konsultasi')
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
                ->modalHeading('Hapus Aduan dan Konsultasi')
                ->modalDescription('Apakah Anda yakin ingin menghapus data ini?'),
        ];
    }
}