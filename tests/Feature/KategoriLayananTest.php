<?php

use App\Filament\Resources\KategoriPelayananResource;
use App\Models\KatalogLayanan;
use App\Models\KategoriLayanan;
use App\Models\PostCategory;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

$name = fake()->name;
$active = true;

it('admin can access index page', function () {
    actingAs($this->admin);
    $response = $this->get(KategoriPelayananResource::getUrl());
    $response->assertStatus(200);
});

it('can create a service category', function () use ($name, $active) {
    // Create an authenticated user with permission to access Filament
    $this->actingAs($this->admin);

    // Simulate the creation of a post category using the Filament resource
    livewire(\App\Filament\Resources\KategoriPelayananResource\Pages\ManageKategoriPelayanan::class)
        ->callAction(CreateAction::class, [
            'category' => $name,
            'name' => $name,
            'active' => $active,
        ]);
    expect(KategoriLayanan::query()->where('category', $category)->where('active', $active)->exists())->toBeTrue();
});

it('can edit a service category', function () use ($name) {
    // Create an authenticated user with permission to access Filament
    $this->actingAs($this->admin);

    // Create an existing post category to edit
    $category = KategoriLayanan::query()->where([
        'name' => $name,
    ])->first();

    //    // Simulate editing the post category using the Filament resource
    $newName = fake()->name;
    $newActive = fake()->boolean;
    livewire(\App\Filament\Resources\KategoriPelayananResource\Pages\ManageKategoriPelayanan::class)
        ->callTableAction(EditAction::class, $category, [
            'name' => $newName,
            'active' => $newActive,
        ]);

    // Assert that the record was updated in the database
    expect(KategoriLayanan::where('name', $newName)->exists())
        ->toBeTrue();
});

it('can delete a service category', function () use ($name, $active) {
    $category = KategoriLayanan::latest()->first();
    actingAs($this->admin);
    livewire(\App\Filament\Resources\KategoriPelayananResource\Pages\ManageKategoriPelayanan::class)
        ->callTableAction(\Filament\Actions\DeleteAction::class, $category)
        ->assertSuccessful();
    expect(KategoriLayanan::query()->where('name', $name)->where('active', $active)->count())->toBe(0);
});
