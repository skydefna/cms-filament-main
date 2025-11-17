<?php

use App\Filament\Pages\ThemeSetting;
use App\Jobs\BuildAssets;
use App\Settings\ThemeSetting as PengaturanTemaSettings;
use Illuminate\Support\Facades\Bus;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

it('admin can access pengaturan tema page', function () {
    actingAs($this->superAdmin);
    $response = $this->get(ThemeSetting::getUrl());
    $response->assertStatus(200);
});

it('can update pengaturan tema settings', function () {
    // Create an authenticated user with permission to access Filament
    $this->actingAs($this->superAdmin);

    // Mock the BuildAssets job
    Bus::fake();

    // Test data
    $primaryColor = '#FF5733';
    $secondaryColor = '#33FF57';

    // Simulate updating the settings using the Filament page
    livewire(ThemeSetting::class)
        ->fillForm([
            'primaryColor' => $primaryColor,
            'secondaryColor' => $secondaryColor,
            'tema' => 'tema1',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    // Assert that the settings were updated
    $settings = app(PengaturanTemaSettings::class);
    expect($settings->primaryColor)->toBe($primaryColor)
        ->and($settings->secondaryColor)->toBe($secondaryColor);

    // Assert that the BuildAssets job was dispatched
    Bus::assertDispatched(BuildAssets::class);
});
