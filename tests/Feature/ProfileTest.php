<?php

use App\Filament\Pages\Profile;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

it('admin can access profile page', function () {
    actingAs($this->admin);
    $response = $this->get(Profile::getUrl());
    $response->assertStatus(200);
});

it('can update profile information', function () {
    // Create an authenticated user with permission to access Filament
    $user = $this->admin;
    $userLama = clone $this->admin;
    $this->actingAs($user);

    // New profile data
    $newName = 'Updated Name';
    $newEmail = 'updated.email@example.com';

    // Simulate updating the profile using the Filament page
    livewire(Profile::class)
        ->fillForm([
            'name' => $newName,
            'email' => $newEmail,
        ])
        ->call('submit')
        ->assertHasNoFormErrors();

    // Refresh the user from the database
    $user->refresh();

    // Assert that the user's profile was updated
    expect($user->name)->toBe($newName)
        ->and($user->email)->toBe($newEmail);

    $user = User::query()->where('email', '=', $newEmail)->first();
    $user->name = $userLama->name;
    $user->email = $userLama->email;
    $updated = $user->save();
    $user->refresh();
    expect(boolval($updated))->toBeTrue();
});

it('validates email format', function () {
    // Create an authenticated user with permission to access Filament
    $user = $this->admin;
    $this->actingAs($user);

    // Invalid email format
    $invalidEmail = 'not-an-email';

    // Simulate updating the profile with invalid email
    livewire(Profile::class)
        ->fillForm([
            'name' => 'Test User',
            'email' => $invalidEmail,
        ])
        ->call('submit')
        ->assertHasFormErrors(['email' => 'email']);
});

it('can update profile picture', function () {
    // Create an authenticated user with permission to access Filament
    $user = $this->admin;
    $this->actingAs($user);

    // Setup fake storage
    Storage::fake('public');
    $avatar = UploadedFile::fake()->image('avatar.jpg', 300, 300);

    // Simulate updating the profile picture
    livewire(Profile::class)
        ->fillForm([
            'name' => $user->name,
            'email' => $user->email,
            'avatar_url' => $avatar,
        ])
        ->call('submit')
        ->assertHasNoFormErrors();

    // Refresh the user from the database
    $user->refresh();

    // Assert that the avatar_url was updated
    expect($user->avatar_url)->not->toBeNull();

    // Verify the image was stored
    Storage::disk('public')->assertExists($user->avatar_url);
});

it('validates that only images can be uploaded for avatar', function () {
    // Create an authenticated user with permission to access Filament
    $user = $this->admin;
    $this->actingAs($user);

    // Setup fake storage
    Storage::fake('public');
    $pdfFile = UploadedFile::fake()->create('document.pdf', 100, 'application/pdf');

    // Simulate updating the profile with a non-image file
    $livewire = livewire(Profile::class)
        ->fillForm([
            'name' => $user->name,
            'email' => $user->email,
            'avatar_url' => $pdfFile,
        ])
        ->call('submit');
    $livewire->assertHasFormErrors(['avatar_url']);
});
