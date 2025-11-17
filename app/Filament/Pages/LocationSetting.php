<?php

namespace App\Filament\Pages;

use App\Settings\LocationSetting as LocationSettingModel;
use App\Traits\DefaultLocationTrait;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Cheesegrits\FilamentGoogleMaps\Concerns\InteractsWithMaps;
use Cheesegrits\FilamentGoogleMaps\Fields\Map;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class LocationSetting extends SettingsPage implements HasShieldPermissions
{
    use DefaultLocationTrait, HasPageShield, InteractsWithMaps;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    protected static string $settings = LocationSettingModel::class;

    protected static ?string $navigationGroup = 'Pengaturan';

    protected static ?string $navigationLabel = 'Pengaturan Lokasi';

    protected static ?int $navigationSort = 3;

    public function form(Form $form): Form
    {
        $locationSettting = new LocationSettingModel;
        $latitude = $locationSettting->latitude ?? self::LATITUDE;
        $longitude = $locationSettting->longitude ?? self::LONGITUDE;
        $defaultLocations = [$latitude, $longitude];

        return $form
            ->schema([
                Textarea::make('address')
                    ->label('Alamat')
                    ->columnSpanFull()
                    ->string()
                    ->required(),
                TextInput::make('latitude')
                    ->required()
                    ->numeric(),

                TextInput::make('longitude')
                    ->required()
                    ->step('0.1'),                
            ]);
    }

    public static function getPermissionPrefixes(): array
    {
        return ['view', 'create', 'update', 'delete'];
    }

    protected function fillForm(): void
    {
        $settings = app(LocationSettingModel::class);
        $this->form->fill([
            'address' => $settings->address,
            'latitude' => $settings->latitude,
            'longitude' => $settings->longitude,
            'find_location' => $settings->find_location,
        ]);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Ensure only the settings fields are saved
        return [
            'address' => $data['address'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'find_location' => $data['find_location'],
        ];
    }
}
