<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\KatalogLayanan;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\KatalogLayananResource\Pages\ManageKatalogLayanan;

class KatalogLayananResource extends Resource
{
    protected static ?string $model = KatalogLayanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Layanan E-Government';
    protected static ?string $navigationLabel = 'Manajemen Katalog';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('surat_permohonan_id')
                ->label('Nama Pemohon')
                ->relationship('suratPermohonan', 'nama_pemohon')
                ->searchable()
                ->preload()
                ->reactive()
                ->required()
                // Saat memilih surat_permohonan di create/edit
                ->afterStateUpdated(function ($state, callable $set) {
                    if ($state) {
                        $surat = \App\Models\SuratPermohonan::with(['kategoriLayanan', 'user.skpd'])->find($state);

                        if ($surat) {
                            $set('skpd_nama', $surat->user?->skpd?->nama ?? '-');
                            $set('kategori', $surat->kategoriLayanan?->category ?? '-');
                            $set('layanan', $surat->kategoriLayanan?->name ?? '-');
                        } else {
                            $set('skpd_nama', null);
                            $set('kategori', null);
                            $set('layanan', null);
                        }
                    }
                })
                // Saat form dibuka untuk edit/view, isi data lama
                ->afterStateHydrated(function ($state, callable $set, $record) {
                    if ($record && $record->suratPermohonan) {
                        $set('skpd_nama', $record->suratPermohonan->user?->skpd?->nama ?? '-');
                        $set('kategori', $record->suratPermohonan->kategoriLayanan?->category ?? '-');
                        $set('layanan', $record->suratPermohonan->kategoriLayanan?->name ?? '-');
                    }
                }),

            Forms\Components\TextInput::make('skpd_nama')
                ->label('Nama SKPD')
                ->disabled()
                ->dehydrated(false),

            Forms\Components\TextInput::make('kategori')
                ->label('Kategori Layanan')
                ->disabled()
                ->dehydrated(false),

            Forms\Components\TextInput::make('layanan')
                ->label('Nama Layanan')
                ->disabled()
                ->dehydrated(false),

            Forms\Components\Textarea::make('deskripsi')
                ->label('Deskripsi Layanan')
                ->rows(4)
                ->required(),

            Forms\Components\Select::make('status_layanan')
                ->label('Status')
                ->options([
                    'Proses' => 'Proses',
                    'Selesai' => 'Selesai',                    
                ])
                ->default('Proses')
                ->visible(fn() => auth()->user()->hasRole('super-admin'))
                ->disabled(fn() => !auth()->user()->hasRole('super-admin'))
                ->dehydrated(fn() => true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('no')
                    ->label('No')
                    ->rowIndex(),
            Tables\Columns\TextColumn::make('suratPermohonan.nama_pemohon')->label('Nama Pemohon')->searchable(),
            Tables\Columns\TextColumn::make('suratPermohonan.user.skpd.nama')->label('SKPD'),
            Tables\Columns\TextColumn::make('suratPermohonan.kategoriLayanan.category')->label('Kategori'),
            Tables\Columns\TextColumn::make('suratPermohonan.kategoriLayanan.name')->label('Nama Layanan'),
            Tables\Columns\TextColumn::make('deskripsi')->label('Deskripsi')->limit(50),
            Tables\Columns\TextColumn::make('status_layanan')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Proses' => 'warning',
                        'Selesai' => 'success',                        
                        default => 'secondary',
                    }),            
        ])
        ->actions([
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageKatalogLayanan::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();

        return parent::getEloquentQuery()
            ->when(!$user->hasRole('super-admin'), function ($query) use ($user) {
                return $query
                    ->whereHas('suratPermohonan', function ($q) use ($user) {
                        $q->where('user_id', $user->id)
                        ->where('skpd_id', $user->skpd_id);
                    });
            });
    }
}
