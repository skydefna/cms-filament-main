<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerLinkResource\Pages;
use App\Models\BannerLink;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BannerLinkResource extends Resource
{
    protected static ?string $model = BannerLink::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';

    protected static ?string $navigationGroup = 'Lainnya';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('url')
                    ->label('URL')
                    ->url()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->label('Gambar')
                    ->columnSpanFull()
                    ->disk('public')
                    ->visibility('public')
                    ->imageEditor()
                    ->imageResizeMode('cover')
                    ->image()
                    ->maxSize(300)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(BannerLink::query()->orderBy('sort'))
            ->searchable(false)
            ->paginated(false)
            ->reorderable('sort')
            ->columns([
                Tables\Columns\TextColumn::make('sort')->label('Urutan'),
                Tables\Columns\TextColumn::make('url')->label('URL'),
                Tables\Columns\ImageColumn::make('image')->label('Gambar')->disk('public'),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ManageBannerLinks::route('/'),
        ];
    }
}
