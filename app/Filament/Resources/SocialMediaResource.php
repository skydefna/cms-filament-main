<?php

namespace App\Filament\Resources;

use App\Enums\SocialMediaTypes;
use App\Filament\Resources\SocialMediaResource\Pages;
use App\Models\SocialMedia;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SocialMediaResource extends Resource
{
    protected static ?string $model = SocialMedia::class;

    protected static ?string $navigationIcon = 'heroicon-o-device-phone-mobile';

    protected static ?string $navigationGroup = 'Lainnya';

    protected static ?string $modelLabel = 'Sosial Media';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->string()
                    ->maxLength(255),
                Forms\Components\TextInput::make('url')
                    ->label('URL Social Media')
                    ->default('https://')
                    ->required()
                    ->url()
                    ->maxLength(255),
                Forms\Components\Select::make('type')
                    ->label('Tipe Social Media')
                    ->options(SocialMediaTypes::all())
                    ->required()
                    ->string(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(SocialMedia::query()->orderBy('sort'))
            ->searchable(false)
            ->paginated(false)
            ->reorderable('sort')
            ->columns([
                Tables\Columns\TextColumn::make('sort')
                    ->numeric(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type'),
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
            'index' => Pages\ManageSocialMedia::route('/'),
        ];
    }
}
