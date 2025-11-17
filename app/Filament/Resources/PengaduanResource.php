<?php

namespace App\Filament\Resources;


use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Pengaduan;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PengaduanResource\Pages\Pages\ManagePengaduan;

class PengaduanResource extends Resource
{
    protected static ?string $model = Pengaduan::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Layanan E-Government';
    protected static ?string $navigationLabel = 'Aduan dan Konsultasi';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('surat_permohonan_id')
                    ->label('Nama Pemohon')
                    ->relationship('suratPermohonan', 'nama_pemohon')
                    ->default(function () {
                        // Ambil surat permohonan pertama yang terkait user login
                        return \App\Models\SuratPermohonan::where('user_id', auth()->id())->value('id');
                    })
                    ->disabled()
                    ->dehydrated(true)
                    ->helperText('Terisi Otomatis')
                    ->required(),

                Forms\Components\Select::make('skpd_id')
                    ->label('SKPD')
                    ->relationship('skpd', 'nama')
                    ->searchable()
                    ->preload()
                    ->default(fn() => auth()->user()->skpd_id)
                    ->disabled()
                    ->dehydrated(fn() => auth()->user()->hasRole('super-admin'))
                    ->helperText('Terisi Otomatis')
                    ->required(),

                Forms\Components\Textarea::make('deskripsi')
                    ->label('Deskripsi Masalah')
                    ->required(),

                Forms\Components\Select::make('status_aduan')
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
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no')
                    ->label('No')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('suratPermohonan.nama_pemohon')->label('Nama Pemohon')->searchable(),
                Tables\Columns\TextColumn::make('suratPermohonan.user.skpd.nama')->label('SKPD'),
                Tables\Columns\TextColumn::make('deskripsi')->label('Deksripsi Masalah'),
                Tables\Columns\TextColumn::make('status_aduan')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Proses' => 'warning',
                        'Selesai' => 'success',                        
                        default => 'secondary',
                    }),                
                Tables\Columns\TextColumn::make('created_at')->label('Tanggal')->dateTime(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }    

    public static function getPages(): array
    {
        return [
            'index' => ManagePengaduan::route('/'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();

        return parent::getEloquentQuery()
            ->when(!$user->hasRole('super-admin'), function ($query) use ($user) {
                return $query
                    // Filter berdasarkan user yang membuat pengaduan (via relasi surat permohonan)
                    ->whereHas('suratPermohonan', function ($q) use ($user) {
                        $q->where('user_id', $user->id)
                        ->where('skpd_id', $user->skpd_id);
                    });
            });
    }
}
