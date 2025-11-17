<?php

use App\Filament\Pages\LocationSetting;
use App\Settings\LocationSetting as PengaturanLokasiSettings;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

it('admin can access pengaturan lokasi page', function () {
    actingAs($this->admin);
    $response = $this->get(LocationSetting::getUrl());
    $response->assertStatus(200);
});

it('can update pengaturan lokasi settings', function () {
    // Create an authenticated user with permission to access Filament
    $this->actingAs($this->admin);

    // Test data
    $address = 'Jl. Test No. 123, Kota Test';
    $latitude = -3.316694;
    $longitude = 114.590111;
    $findLocation = 'Test Location';

    // Simulate updating the settings using the Filament page
    livewire(LocationSetting::class)
        ->fillForm([
            'address' => $address,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'find_location' => $findLocation,
            'location' => [
                'lat' => $latitude,
                'lng' => $longitude,
            ],
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    // Assert that the settings were updated
    $settings = app(PengaturanLokasiSettings::class);
    expect($settings->address)->toBe($address)
        ->and($settings->latitude)->toBe($latitude)
        ->and($settings->longitude)->toBe($longitude)
        ->and($settings->find_location)->toBe($findLocation);
});

it('validates required fields', function () {
    // Create an authenticated user with permission to access Filament
    $this->actingAs($this->admin);

    // Test with missing required field (address)
    livewire(LocationSetting::class)
        ->fillForm([
            'address' => '',
            'latitude' => -3.316694,
            'longitude' => 114.590111,
            'find_location' => 'Test Location',
        ])
        ->call('save')
        ->assertHasFormErrors(['address' => 'required']);
});

it('can update location using map interaction', function () {
    // Create an authenticated user with permission to access Filament
    $this->actingAs($this->admin);

    // Test data
    $newLatitude = -3.316694;
    $newLongitude = 114.590111;

    // Simulate map interaction by updating location state
    livewire(LocationSetting::class)
        ->fillForm([
            'address' => 'Test Address',
            'location' => [
                'lat' => $newLatitude,
                'lng' => $newLongitude,
            ],
        ])
        ->assertSet('data.latitude', $newLatitude)
        ->assertSet('data.longitude', $newLongitude);
});
