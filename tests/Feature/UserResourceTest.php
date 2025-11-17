<?php

use App\Filament\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

it('admin can access user resource page', function () {
    actingAs($this->superAdmin);
    $response = $this->get(UserResource::getUrl());
    $response->assertStatus(200);
});

it('can reset user password', function () {
    // Create an authenticated admin user
    $admin = $this->superAdmin;
    $this->actingAs($admin);

    // Create a regular user whose password we'll reset
    $user = User::factory()->create([
        'password' => Hash::make('old_password'),
        'has_change_password' => true,
        'phone_number' => fake()->phoneNumber(),
    ]);

    // New password data
    $newPassword = 'new_password123';

    // Simulate resetting the password using the UserResource action
    $livewire = livewire(UserResource\Pages\ManageUsers::class)
        ->callTableAction('resetPassword', $user, [
            'new_password' => $newPassword,
            'new_password_confirmation' => $newPassword,
        ]);
    $livewire->assertHasNoErrors();

    // Refresh the user from the database
    $user->refresh();

    // Assert that the user's password was updated
    expect(Hash::check($newPassword, $user->password))->toBeTrue();

    // Assert that has_change_password flag is set to false
    expect(boolval($user->has_change_password))->toBeFalse();

    // Clean up
    $user->delete();
});

it('validates password confirmation when resetting', function () {
    // Create an authenticated admin user
    $admin = $this->superAdmin;
    $this->actingAs($admin);

    // Create a regular user whose password we'll reset
    $user = User::factory()->create([
        'password' => Hash::make('old_password'),
    ]);

    // Mismatched password data
    $newPassword = 'new_password123';
    $differentConfirmation = 'different_password123';

    // Simulate resetting the password with mismatched confirmation
    $livewire = livewire(UserResource\Pages\ManageUsers::class)
        ->callTableAction('resetPassword', $user, [
            'new_password' => $newPassword,
            'new_password_confirmation' => $differentConfirmation,
        ]);
    $livewire->assertHasErrors(['mountedTableActionsData.0.new_password']);

    // Clean up
    $user->delete();
});

it('validates password minimum length when resetting', function () {
    // Create an authenticated admin user
    $admin = $this->superAdmin;
    $this->actingAs($admin);

    // Create a regular user whose password we'll reset
    $user = User::factory()->create([
        'password' => Hash::make('old_password'),
    ]);

    // Short password data
    $shortPassword = '1234567'; // Less than 8 characters

    // Simulate resetting the password with a short password
    livewire(UserResource\Pages\ManageUsers::class)
        ->callTableAction('resetPassword', $user, [
            'new_password' => $shortPassword,
            'new_password_confirmation' => $shortPassword,
        ])
        ->assertHaserrors(['mountedTableActionsData.0.new_password']);

    // Clean up
    $user->delete();
});

it('cannot reset own password through user resource', function () {
    // Create an authenticated admin user
    $admin = $this->superAdmin;
    $this->actingAs($admin);

    // Try to reset own password through the UserResource
    $response = livewire(UserResource\Pages\ManageUsers::class)
        ->assertTableActionHidden('resetPassword', $admin);
});
