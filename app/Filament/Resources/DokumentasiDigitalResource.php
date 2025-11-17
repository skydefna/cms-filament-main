<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DokumentasiDigitalResource\Pages\ManageDokumentasiDigital;
use App\Models\DokumentasiDigital;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DokumentasiDigitalResource extends Resource
{
    protected static ?string $model = DokumentasiDigital::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';
    protected static ?string $navigationGroup = 'Kategori dan Fitur Portal';
    protected static ?string $navigationLabel = 'Dokumentasi Digital';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul')
                    ->label('Judul Dokumen')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->rows(3)
                    ->nullable(),

                Forms\Components\FileUpload::make('file_path')
                    ->label('File Dokumen')
                    ->directory('dokumen')
                    ->columnSpanFull()
                    ->preserveFilenames()
                    ->acceptedFileTypes([
                        'application/pdf',                        
                        'image/jpeg',
                        'image/png',
                    ])
                    ->maxSize(10240) // 10 MB
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no')
                    ->label('No')
                    ->rowIndex(),

                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable(),

                Tables\Columns\TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->limit(40),                

                Tables\Columns\TextColumn::make('file_path')
                    ->label('File')
                    ->formatStateUsing(fn($state) => basename($state))
                    ->url(fn($record) => asset('storage/' . $record->file_path), true)
                    ->openUrlInNewTab(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime(),
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
            'index' => ManageDokumentasiDigital::route('/'),
        ];
    }
}