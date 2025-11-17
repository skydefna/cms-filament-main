<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Skpd;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SkpdResource\Pages;
use App\Filament\Resources\SkpdResource\Pages\ManageSkpds;

class SkpdResource extends Resource
{
    protected static ?string $model = Skpd::class;
    protected static ?string $navigationGroup = 'Kategori dan Fitur Portal';
    protected static ?string $navigationLabel = 'Kategori SKPD';
    protected static ?string $pluralModelLabel = 'Kategori SKPD';
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nama')
                ->label('Nama SKPD')
                ->required()
                ->maxLength(255),

            Forms\Components\Toggle::make('active')
                ->label('Aktif')
                ->default(true)
                ->columnSpanFull()
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('sort')
            ->reorderable('sort')
            ->paginated(false)
            ->reorderable(false)
            ->searchable(false)
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama SKPD')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Ubah')
                    ->modalHeading(fn ($record) => "Ubah SKPD: {$record->nama}")
                    ->modalWidth('lg')
                    ->slideOver(), // 🔹 Edit di modal pop-up

                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->requiresConfirmation()
                    ->modalHeading('Yakin ingin menghapus SKPD ini?')
                    ->modalDescription('Data yang dihapus tidak dapat dikembalikan.')
                    ->modalSubmitActionLabel('Ya, Hapus')
                    ->modalWidth('md'),
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
            'index' => ManageSkpds::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (auth()->check() && !auth()->user()->hasRole('super-admin')) {
            $query->where('skpd_id', auth()->user()->skpd_id);
        }

        return $query;
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }
}