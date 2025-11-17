<?php

namespace App\Filament\Resources;

use App\Enums\ListUrlInternal;
use App\Enums\MenuType;
use App\Filament\Resources\MenuResource\Pages;
use App\Models\Menu;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationGroup = 'Lainnya';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->label('jenis menu')
                    ->options(MenuType::options())
                    ->placeholder('Pilih Tipe Menu')
                    ->live()
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->label('judul')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('url')
                    ->visible(function (Get $get): bool {
                        return $get('type') == MenuType::URL_EXTERNAL->value;
                    })
                    ->maxLength(255),
                Forms\Components\Select::make('path')
                    ->options(ListUrlInternal::options())
                    ->visible(function (Get $get): bool {
                        return $get('type') == MenuType::URL_INTERNAL->value;
                    }),
                Forms\Components\Select::make('page_id')
                    ->label('pilih halaman')
                    ->options(Page::isPublish()->get()->pluck('title', 'id')->toArray())
                    ->visible(function (Get $get): bool {
                        return $get('type') == MenuType::PAGE->value;
                    })
                    ->placeholder('Pilih Halaman'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('parent.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('path')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('halaman.judul')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->after(function ($livewire) {
                        $livewire->dispatch('refreshMenuWidget');
                    }),
                // if url_internal disable delete
                Tables\Actions\Action::make('delete')
                    ->after(function ($livewire) {
                        $livewire->dispatch('refreshMenuWidget');
                    })
                    ->icon('heroicon-o-trash')
                    ->label('Hapus')
                    ->action(function (Menu $record, $livewire) {
                        //                        if ($record->type == MenuType::URL_INTERNAL->value) {
                        //                            return;
                        //                        }
                        $record->delete();
                        $livewire->dispatch('refreshMenuWidget');
                    })
                    ->requiresConfirmation()
                    ->visible(function (Menu $record) {
                        $isSuperAdmin = Auth::user()->hasAnyRole('super-admin');

                        return $record->type != MenuType::URL_INTERNAL->value || $isSuperAdmin;
                    }),
            ])
            ->searchable(false)
            ->paginated(false)
            ->defaultPaginationPageOption(false);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageMenus::route('/'),
        ];
    }
}
