<?php

use App\Filament\Pages\GeneralSetting;
use App\Settings\GeneralSetting as GeneralSettingSettings;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

it('admin can access general page', function () {
    actingAs($this->admin);
    $response = $this->get(GeneralSetting::getUrl());
    $response->assertStatus(200);
});

it('can update general settings', function () {
    // Create an authenticated user with permission to access Filament
    $this->actingAs($this->admin);

    // Setup fake storage for image uploads
    Storage::fake('public');
    $primaryLogo = UploadedFile::fake()->image('tabalong_sm.png', 200, 200);
    $secondary_logo = UploadedFile::fake()->image('tabalong_sm.png', 160, 160);
    $favicon = UploadedFile::fake()->image('favicon.png', 32, 32);

    // Test data
    $namaSitus = 'Website Resmi Pemerintah';
    $namaSingkat = 'WRP';
    $announcement = fake()->sentence(18);

    // Simulate updating the settings using the Filament page
    livewire(GeneralSetting::class)
        ->fillForm([
            'site_name' => $namaSitus,
            'site_short_name' => $namaSingkat,
            'announcement' => $announcement,
            'primary_logo' => $primaryLogo,
            'secondary_logo' => $secondary_logo,
            'favicon' => $favicon,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    // Assert that the settings were updated
    $settings = app(GeneralSettingSettings::class);
    expect($settings->site_name)->toBe($namaSitus)
        ->and($settings->site_short_name)->toBe($namaSingkat)
        ->and($settings->announcement)->toBe($announcement)
        ->and($settings->primary_logo)->not->toBeNull()
        ->and($settings->secondary_logo)->not->toBeNull()
        ->and($settings->favicon)->not->toBeNull();

    // Verify the images were stored
    Storage::disk('public')->assertExists($settings->primary_logo);
    Storage::disk('public')->assertExists($settings->secondary_logo);
    Storage::disk('public')->assertExists($settings->favicon);
});

it('validates that only images can be uploaded', function () {
    // Create an authenticated user with permission to access Filament
    $this->actingAs($this->admin);

    // Setup fake storage for uploads
    Storage::fake('public');

    // Create non-image file
    $pdfFile = UploadedFile::fake()->create('document.pdf', 100, 'application/pdf');

    // Test data
    $namaSitus = 'Website Resmi Pemerintah';

    // Test primary_logo validation with PDF file
    $livewire = livewire(GeneralSetting::class)
        ->fillForm([
            'site_name' => $namaSitus,
            'primary_logo' => $pdfFile,
        ])
        ->call('save');
    $livewire->assertHasFormErrors(['primary_logo']);

    // Test secondary_logo validation with PDF file
    livewire(GeneralSetting::class)
        ->fillForm([
            'site_name' => $namaSitus,
            'secondary_logo' => $pdfFile,
        ])
        ->call('save')
        ->assertHasFormErrors(['secondary_logo']);

    // Test favicon validation with PDF file
    livewire(GeneralSetting::class)
        ->fillForm([
            'site_name' => $namaSitus,
            'favicon' => $pdfFile,
        ])
        ->call('save')
        ->assertHasFormErrors(['favicon']);
});

it('can update text fields without changing images', function () {
    // First set some initial values with images
    $this->actingAs($this->admin);

    // Setup fake storage for image uploads
    Storage::fake('public');
    $initialLogo = UploadedFile::fake()->image('initial-secondary_logo.png', 160, 160);

    // Set initial values
    livewire(GeneralSetting::class)
        ->fillForm([
            'site_name' => 'Initial Site Name',
            'secondary_logo' => $initialLogo,
        ])
        ->call('save');

    // Get the initial settings
    $initialSettings = app(GeneralSettingSettings::class);
    $initialLogoPath = $initialSettings->secondary_logo;

    // Now update only the text fields
    $newSiteName = 'Updated Site Name';

    livewire(GeneralSetting::class)
        ->fillForm([
            'site_name' => $newSiteName,
            // Don't include secondary_logo in the form data
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    // Assert that the text was updated but the secondary_logo remains the same
    $updatedSettings = app(GeneralSettingSettings::class);
    expect($updatedSettings->site_name)->toBe($newSiteName)
        ->and($updatedSettings->secondary_logo)->toBe($initialLogoPath);
});

it('validates text field max length', function () {
    // Create an authenticated user with permission to access Filament
    $this->actingAs($this->admin);

    // Test with text exceeding max length
    $longText = str_repeat('a', 201); // 201 characters, max is 200

    livewire(GeneralSetting::class)
        ->fillForm([
            'site_name' => $longText,
        ])
        ->call('save')
        ->assertHasFormErrors(['site_name' => 'max']);

    livewire(GeneralSetting::class)
        ->fillForm([
            'site_short_name' => $longText,
        ])
        ->call('save')
        ->assertHasFormErrors(['site_short_name' => 'max']);

    livewire(GeneralSetting::class)
        ->fillForm([
            'announcement' => $longText,
        ])
        ->call('save')
        ->assertHasFormErrors(['announcement' => 'max']);
});

it('can reset setting', function () {
    $this->actingAs($this->admin);
    $pengaturan = app(\App\Settings\GeneralSetting::class);
    $pengaturan->secondary_logo = 'tabalong_sm.png';
    $pengaturan->favicon = 'tabalong_sm.png';
    $save = $pengaturan->save();

    expect(boolval($save))->toBeTrue();
});
