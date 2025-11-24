<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuratPermohonanResource\ManageSuratPermohonan;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\SuratPermohonan;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;

class SuratPermohonanResource extends Resource
{
    protected static ?string $model = SuratPermohonan::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Layanan E-Government';
    protected static ?string $navigationLabel = 'Surat Permohonan';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Hidden::make('user_id')
                ->default(fn() => auth()->id())
                ->dehydrated(true),

            Forms\Components\TextInput::make('nama_pemohon')
                ->label('Nama Pemohon')
                ->default(fn() => auth()->user()->name)
                ->disabled(fn() => !auth()->user()->hasRole('super-admin'))
                ->dehydrated(true) // <-- ganti ini
                ->helperText('Terisi Otomatis'),

            Forms\Components\Select::make('skpd_id')
                ->label('SKPD')
                ->relationship('skpd', 'nama')
                ->searchable()
                ->preload()
                ->default(fn() => auth()->user()->skpd_id)
                ->disabled(fn() => !auth()->user()->hasRole('super-admin'))
                ->dehydrated(fn() => auth()->user()->hasRole('super-admin'))
                ->helperText('Terisi Otomatis')
                ->required(),
                

            Forms\Components\Select::make('category')
                ->label('Kategori Layanan')
                ->options(
                    \App\Models\KategoriLayanan::query()
                        ->select('category')
                        ->distinct()
                        ->pluck('category', 'category')
                )
                ->reactive()                
                ->required()
                ->afterStateHydrated(function ($set, $record) {
                    // Saat edit/view, isi kategori berdasarkan relasi
                    if ($record && $record->kategoriLayanan) {
                        $set('category', $record->kategoriLayanan->category);
                    }
                })
                ->dehydrated(false), // ⬅️ ini penting! agar tidak disimpan ke DB

            Forms\Components\Select::make('kategori_layanan_id')
                ->label('Nama Layanan')
                ->options(function (callable $get) {
                    $selectedCategory = $get('category');
                    if (!$selectedCategory) {
                        return [];
                    }

                    return \App\Models\KategoriLayanan::where('category', $selectedCategory)
                        ->pluck('name', 'id');
                })
                ->required()
                ->reactive()
                ->helperText('Harus pilih kategori layanan terlebih dahulu')
                ->disabled(fn (callable $get) => !$get('category')),            

            Forms\Components\TextInput::make('jabatan')
                ->required()
                ->label('Jabatan')
                ->placeholder('Jabatan di SKPD'),

            Forms\Components\TextInput::make('nomor_aktif')
                ->required()
                ->label('Nomor Aktif')
                ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                ->placeholder('+6281234567890')
                ->helperText('Wajib berawalan +62'),

            Forms\Components\Textarea::make('deskripsi_kebutuhan')
                ->label('Deskripsi Kebutuhan'),                

            Forms\Components\FileUpload::make('file_surat')
                ->label('File SKPD (Opsional)')
                ->directory('surat-permohonan')
                ->downloadable()
                ->openable(),                                

            Forms\Components\Select::make('status')
            ->label('Status')
            ->options([
                'Menunggu' => 'Menunggu',
                'Disetujui' => 'Disetujui',
                'Ditolak' => 'Ditolak',
            ])
            ->default('Menunggu')
            ->columnSpanFull()
            ->visible(fn() => auth()->user()->hasRole('super-admin'))
            ->disabled(fn() => !auth()->user()->hasRole('super-admin'))
            ->dehydrated(fn() => true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tambahkan nomor urut otomatis
                Tables\Columns\TextColumn::make('no')
                    ->label('No')
                    ->searchable()
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('nama_pemohon')->label('Nama Pemohon'),
                Tables\Columns\TextColumn::make('skpd.nama')->label('SKPD'),
                Tables\Columns\TextColumn::make('kategoriLayanan.category')
                    ->label('Kategori Layanan')
                    ->wrap() // teks panjang dibungkus (tidak potong)
                    ->extraAttributes(['style' => 'width: 200px; white-space: normal;']),                
                Tables\Columns\TextColumn::make('kategoriLayanan.name')
                    ->label('Nama Layanan')
                    ->wrap() // teks panjang dibungkus (tidak potong)
                    ->extraAttributes(['style' => 'width: 200px; white-space: normal;']),                
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Menunggu' => 'warning',
                        'Disetujui' => 'success',
                        'Ditolak' => 'danger',
                        default => 'secondary',
                    }),                
                Tables\Columns\TextColumn::make('created_at')->label('Tanggal')->dateTime(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageSuratPermohonan::route('/'),
        ];
    }

    // Filter data berdasarkan SKPD user login
    public static function getEloquentQuery(?Builder $query = null): Builder
    {
        $query = $query ?? parent::getEloquentQuery();

        // Ambil user login
        $user = auth()->user();

        // Jika super admin → bisa lihat semua
        if ($user->hasRole('super-admin')) {
            return $query->with(['skpd', 'kategoriLayanan']);
        }

        // Jika bukan super admin → filter berdasarkan user & SKPD
        return $query
            ->where('user_id', $user->id)
            ->where('skpd_id', $user->skpd_id)
            ->with(['skpd', 'kategoriLayanan']);
    }
}