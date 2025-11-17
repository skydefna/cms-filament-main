<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSetting as GeneralSettingModel;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class GeneralSetting extends SettingsPage implements HasShieldPermissions
{
    use HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = GeneralSettingModel::class;

    protected static ?string $navigationGroup = 'Pengaturan';

    protected static ?string $navigationLabel = 'Pengaturan Umum';

    protected static ?int $navigationSort = 4;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make()->tabs([
                    Tabs\Tab::make('Umum')->columns(2)->schema([
                        TextInput::make('site_name')
                            ->label('Nama Situs')
                            ->string()
                            ->maxLength(200)
                            ->nullable(),
                        TextInput::make('site_short_name')
                            ->label('Nama Singkat')
                            ->maxLength(200)
                            ->string()
                            ->nullable(),
                    ]),
                    Tabs\Tab::make('Logo')->schema([
                        FileUpload::make('primary_logo')
                            ->disk('public')
                            ->visibility('public')
                            ->label('Logo Utama')
                            ->nullable()
                            ->image()
                            ->moveFiles()
                            ->maxSize(625)
                            ->imageResizeMode('cover')
                            ->imageEditorEmptyFillColor('#000000')
                            ->columnSpanFull(),
                        FileUpload::make('secondary_logo')
                            ->disk('public')
                            ->visibility('public')
                            ->label('Logo Sekunder')
                            ->nullable()
                            ->image()
                            ->maxSize(625)
                            ->moveFiles()
                            ->imageResizeTargetHeight('160')
                            ->columnSpanFull(),
                        FileUpload::make('favicon')
                            ->disk('public')
                            ->columnSpanFull()
                            ->visibility('public')
                            ->label('Favicon')
                            ->maxSize(625)
                            ->nullable()
                            ->image()
                            ->moveFiles()
                            ->imageResizeTargetHeight('32'),
                    ]),                
                    Tabs\Tab::make('Pengumuman')->schema([
                        Textarea::make('announcement')
                            ->label('Pengumuman')
                            ->maxLength(200)
                            ->string()
                            ->nullable()
                            ->columnSpanFull(),
                    ]),
                    Tabs\Tab::make('Aspect Ratio Slider')->columns(2)->schema([
                        TextInput::make('slider_width')
                            ->type('number')
                            ->step(1)
                            ->label('Lebar')
                            ->integer()
                            ->nullable(),
                        TextInput::make('slider_height')
                            ->type('number')
                            ->step(1)
                            ->label('Tinggi')
                            ->integer()
                            ->nullable(),
                    ]),
                ])
                    ->columnSpanFull()
                    ->persistTabInQueryString(),
            ]);
    }

    public static function getPermissionPrefixes(): array
    {
        return ['view', 'create', 'update', 'delete'];
    }
}
