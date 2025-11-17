<?php

use App\Filament\Resources\ContactResource;
use App\Models\Contact;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

$name = fake()->word();
$value = fake()->phoneNumber();
$sort = 1;

it('admin can access index page', function () {
    actingAs($this->admin);
    $response = $this->get(ContactResource::getUrl());
    $response->assertStatus(200);
});

it('can create a contact', function () use ($name, $value) {
    // Create an authenticated user with permission to access Filament
    $this->actingAs($this->admin);

    // Setup fake storage for icon upload
    Storage::fake('public');
    $icon = UploadedFile::fake()->image('fake.jpg', 120, 120);

    // Simulate the creation of a contact using the Filament resource
    livewire(\App\Filament\Resources\ContactResource\Pages\ManageContacts::class)
        ->callAction(CreateAction::class, [
            'name' => $name,
            'value' => $value,
            'icon' => $icon,
        ]);

    // Assert that the record was created in the database
    expect(Contact::query()->where('name', $name)->where('value', $value)->exists())->toBeTrue();

    // Get the created contact to verify the icon was stored
    $contact = Contact::query()->where('name', $name)->where('value', $value)->first();
    expect($contact)->not->toBeNull();

    // Check if the icon path exists in the database
    expect($contact->icon)->not->toBeEmpty();

    Contact::query()->latest()->update(['icon' => 'fake.jpg']);
});

it('can edit a contact', function () use ($name, $value) {
    // Create an authenticated user with permission to access Filament
    $this->actingAs($this->admin);

    // Find an existing contact to edit
    $contact = Contact::query()->where([
        'name' => $name,
        'value' => $value,
    ])->first();

    // Setup fake storage for icon upload
    Storage::fake('public');
    $newIcon = UploadedFile::fake()->image('fake.jpg', 120, 120);

    // Simulate editing the contact using the Filament resource
    $newName = fake()->word();
    $newValue = fake()->phoneNumber();

    livewire(\App\Filament\Resources\ContactResource\Pages\ManageContacts::class)
        ->callTableAction(EditAction::class, $contact, [
            'name' => $newName,
            'value' => $newValue,
            'icon' => $newIcon,
        ]);

    // Assert that the record was updated in the database
    expect(Contact::where('name', $newName)->where('value', $newValue)->exists())
        ->toBeTrue();

    // edit to old value
    livewire(\App\Filament\Resources\ContactResource\Pages\ManageContacts::class)
        ->callTableAction(EditAction::class, $contact, [
            'name' => $name,
            'value' => $value,
            'icon' => $newIcon,
        ]);

    Contact::query()->latest()->update(['icon' => 'fake.jpg']);

    // Assert the record is updated to old value in databse
    expect(Contact::where('name', $name)->where('value', $value)->exists())
        ->toBeTrue();
});

it('can delete a contact', function () use ($name, $value) {
    $contact = Contact::query()->where('name', $name)->where('value', $value)->first();

    actingAs($this->admin);
    livewire(\App\Filament\Resources\ContactResource\Pages\ManageContacts::class)
        ->callTableAction(\Filament\Actions\DeleteAction::class, $contact)
        ->assertSuccessful();

    expect(Contact::query()->where('name', $name)->where('value', $value)->count())->toBe(0);
});
