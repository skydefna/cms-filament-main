<?php

use App\Filament\Pages\ChangePassword;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

it('admin can access change password page', function () {
    actingAs($this->admin);
    $response = $this->get(ChangePassword::getUrl());
    $response->assertStatus(200);
});

it('can change password', function () {
    // Create an authenticated user with permission to access Filament
    $user = $this->admin;

    // Set a known current password
    $currentPassword = 'current_password';
    $user->update([
        'password' => Hash::make($currentPassword),
    ]);

    $this->actingAs($user);

    // New password data
    $newPassword = 'new_password123';

    // Simulate changing the password using the Filament page
    livewire(ChangePassword::class)
        ->fillForm([
            'current_password' => $currentPassword,
            'new_password' => $newPassword,
            'new_password_confirmation' => $newPassword,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    // Refresh the user from the database
    $user->refresh();

    // Assert that the user's password was updated
    expect(Hash::check($newPassword, $user->password))->toBeTrue()
        ->and(boolval($user->has_change_password))->toBeTrue();

    // Assert that has_change_password flag is set to true
});

it('validates current password', function () {
    // Create an authenticated user with permission to access Filament
    $user = $this->admin;

    // Set a known current password
    $currentPassword = 'current_password';
    $user->update([
        'password' => Hash::make($currentPassword),
    ]);

    $this->actingAs($user);

    // Incorrect current password
    $incorrectPassword = 'wrong_password';
    $newPassword = 'new_password123';

    // Simulate changing the password with incorrect current password
    livewire(ChangePassword::class)
        ->fillForm([
            'current_password' => $incorrectPassword,
            'new_password' => $newPassword,
            'new_password_confirmation' => $newPassword,
        ])
        ->call('save')
        ->assertHasFormErrors(['current_password' => 'current_password']);
});

it('validates new password minimum length', function () {
    // Create an authenticated user with permission to access Filament
    $user = $this->admin;

    // Set a known current password
    $currentPassword = 'current_password';
    $user->update([
        'password' => Hash::make($currentPassword),
    ]);

    $this->actingAs($user);

    // New password that is too short
    $shortPassword = '1234567'; // Less than 8 characters

    // Simulate changing the password with a short new password
    livewire(ChangePassword::class)
        ->fillForm([
            'current_password' => $currentPassword,
            'new_password' => $shortPassword,
            'new_password_confirmation' => $shortPassword,
        ])
        ->call('save')
        ->assertHasFormErrors(['new_password' => 'min']);
});

it('validates new password confirmation', function () {
    // Create an authenticated user with permission to access Filament
    $user = $this->admin;

    // Set a known current password
    $currentPassword = 'current_password';
    $user->update([
        'password' => Hash::make($currentPassword),
    ]);

    $this->actingAs($user);

    // New password with mismatched confirmation
    $newPassword = 'new_password123';
    $differentConfirmation = 'different_password123';

    // Simulate changing the password with mismatched confirmation
    livewire(ChangePassword::class)
        ->fillForm([
            'current_password' => $currentPassword,
            'new_password' => $newPassword,
            'new_password_confirmation' => $differentConfirmation,
        ])
        ->call('save')
        ->assertHasFormErrors(['new_password_confirmation' => 'same']);
});

it('validates new password is different from current password', function () {
    // Create an authenticated user with permission to access Filament
    $user = $this->admin;

    // Set a known current password
    $currentPassword = 'current_password';
    $user->update([
        'password' => Hash::make($currentPassword),
    ]);

    $this->actingAs($user);

    // Try to set the new password same as current password
    livewire(ChangePassword::class)
        ->fillForm([
            'current_password' => $currentPassword,
            'new_password' => $currentPassword,
            'new_password_confirmation' => $currentPassword,
        ])
        ->call('save')
        ->assertHasFormErrors(['new_password' => 'different']);

    $db = \App\Models\User::where('email', $user->email)->first();
    $db->password = Hash::make('password');
    $db->save();
});
