<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderResource\Pages;
use App\Models\Slider;
use App\Settings\GeneralSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Lainnya';

    protected static ?int $navigationSort = 4;

    protected static GeneralSetting $generalSetting;

    public static function form(Form $form): Form
    {
        $generalSetting = app(GeneralSetting::class);
        $aspectRatio = $generalSetting->slider_width.':'.$generalSetting->slider_height;

        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Title')
                    ->columnSpanFull()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('desc')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_active')
                    ->label('Aktf')
                    ->columnSpanFull()
                    ->required(),
                Forms\Components\TextInput::make('hyperlink')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->label('Gambar(Maksimal 500kb)')
                    ->columnSpanFull()
                    ->disk('public')
                    ->visibility('public')
                    ->imageEditor()
                    ->placeholder('Rekomendasi Aspek Rasio '.$aspectRatio)
                    ->panelAspectRatio($aspectRatio)
                    ->imageCropAspectRatio($aspectRatio)
                    ->imageResizeMode('force')
                    ->imageResizeUpscale()
                    ->imageEditorEmptyFillColor('#000000')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                    ->moveFiles()
                    ->maxSize(512)
                    ->required()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Slider::orderBy('sort'))
            ->searchable(false)
            ->paginated(false)
            ->reorderable('sort')
            ->defaultSort('sort')
            ->columns([
                Tables\Columns\TextColumn::make('sort')
                    ->label('Sort')
                    ->numeric(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif'),
                Tables\Columns\TextColumn::make('hyperlink')
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('is_active')
                    ->options([
                        true => 'Aktif',
                        false => 'Tidak Aktif',
                    ])
                    ->label('Tampilkan Berdasarkan Status')
                    ->query(function (Builder $query, array $data) {
                        if (! is_null($data['value'])) {
                            $query->where('is_active', $data['value']);
                        }
                    }),
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
            'index' => Pages\ManageSliders::route('/'),
        ];
    }
}
