<?php

namespace App\Filament\Pages;

use App\Helpers\ColorGenerator;
use App\Jobs\BuildAssets;
use App\Settings\ThemeSetting as PengaturanTemaSettings;
use App\Traits\DefaultLocationTrait;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Cheesegrits\FilamentGoogleMaps\Concerns\InteractsWithMaps;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Illuminate\Support\Facades\Artisan;

class ThemeSetting extends SettingsPage implements HasShieldPermissions
{
    use DefaultLocationTrait, HasPageShield, InteractsWithMaps;

    protected static ?string $navigationIcon = 'heroicon-o-swatch';

    protected static string $settings = PengaturanTemaSettings::class;

    protected static ?string $navigationGroup = 'Pengaturan';

    protected static ?string $navigationLabel = 'Pengaturan Tema';

    protected static ?int $navigationSort = 3;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('theme')
                    ->label('Pilih Tema')
                    ->options([
                        'classic' => 'classic',
                        'modern' => 'modern',
                    ])
                    ->required(),
            ]);
    }

    public static function getPermissionPrefixes(): array
    {
        return ['view', 'create', 'update', 'delete'];
    }

    protected function fillForm(): void
    {
        $settings = app(PengaturanTemaSettings::class);
        $this->form->fill([
            //            'primaryColor' => $settings->primaryColor,
            //            'secondaryColor' => $settings->secondaryColor,
            'theme' => $settings->theme,
        ]);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        //        $explodePrimary = explode(',', $data['primaryColor']['value']);
        //        $explodeSecondary = explode(',', $data['secondaryColor']['value']);
        //        $data['primaryColor'] = $this->rgbToHex(...$explodePrimary);
        //        $data['secondaryColor'] = $this->rgbToHex(...$explodeSecondary);
        //        $this->buildTheme($data);
        Artisan::call('cache:clear');

        return [
            //            'primaryColor' => $data['primaryColor'],
            //            'secondaryColor' => $data['secondaryColor'],
            'theme' => $data['theme'],
        ];
    }

    protected function rgbToHex($r, $g, $b): string
    {
        return '#'.str_pad(dechex($r), 2, '0', STR_PAD_LEFT).
            str_pad(dechex($g), 2, '0', STR_PAD_LEFT).
            str_pad(dechex($b), 2, '0', STR_PAD_LEFT);
    }

    /**
     * @throws \JsonException
     */
    protected function buildTheme($colors): void
    {
        $shadedColors = [];
        foreach ($colors as $key => $value) {
            if (str_contains($key, 'Color')) {
                $newKey = str_replace('Color', '', $key);
                $colors[$newKey] = $value;
                unset($colors[$key]);
            }
        }

        foreach ($colors as $name => $baseColor) {
            if (! $baseColor) {
                continue;
            }

            // Base color is already in hex format (e.g., #FF5733)
            $shades = ColorGenerator::generateShades($baseColor);
            $shadedColors[$name] = $shades;
        }

        // create colors.json if not exists
        if (! file_exists(base_path('colors.json'))) {
            file_put_contents(base_path('colors.json'), json_encode([], JSON_THROW_ON_ERROR));
        }
        // copy all content from colors-template.json to colors.json
        $content = file_get_contents(base_path('colors-template.json'));
        file_put_contents(base_path('colors.json'), $content);
        // Add static colors from your tailwind.config.js
        $jsonColors = file_get_contents(base_path('colors.json'));
        $jsonColors = json_decode($jsonColors, true, 512, JSON_THROW_ON_ERROR);
        $shadedColors = array_merge($shadedColors, $jsonColors);
        // Write to colors.json
        file_put_contents(base_path('colors.json'), json_encode($shadedColors, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        // run job build asset
        BuildAssets::dispatch();

    }
}
