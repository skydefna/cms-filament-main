<?php

use App\Filament\Resources\SocialMediaResource;
use App\Models\SocialMedia;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

$name = fake()->word();
$url = fake()->url();
$newName = fake()->word();
$newUrl = fake()->url();

it('admin can access index page', function () {
    actingAs($this->admin);
    $response = $this->get(SocialMediaResource::getUrl());
    $response->assertStatus(200);
    SocialMedia::query()->update(['image' => 'post.png']);
});

it('can create a social media', function () use ($name, $url) {
    // Create an authenticated user with permission to access Filament
    $this->actingAs($this->admin);

    // Setup fake storage for image upload
    Storage::fake('public');
    $image = UploadedFile::fake()->image('social-icon.png', 120, 120);

    // Get the next sort value
    $sort = SocialMedia::max('sort') + 1 ?? 1;

    // Simulate the creation of a social media using the Filament resource
    livewire(\App\Filament\Resources\SocialMediaResource\Pages\ManageSocialMedia::class)
        ->callAction(CreateAction::class, [
            'name' => $name,
            'url' => $url,
            'image' => $image,
        ]);

    // Assert that the record was created in the database
    expect(SocialMedia::query()->where('name', $name)->where('url', $url)->exists())->toBeTrue();

    // Get the created social media to verify other fields
    $socialMedia = SocialMedia::query()->where('name', $name)->first();
    expect($socialMedia)->not->toBeNull();
    expect($socialMedia->url)->toBe($url);
    expect($socialMedia->image)->not->toBeEmpty();
});

it('validates that only images can be uploaded', function () use ($name, $url) {
    // Create an authenticated user with permission to access Filament
    $this->actingAs($this->admin);

    // Setup fake storage for uploads
    Storage::fake('public');

    // Create non-image files
    $pdfFile = UploadedFile::fake()->create('document.pdf', 100, 'application/pdf');
    $textFile = UploadedFile::fake()->create('document.txt', 10, 'text/plain');

    // Test image validation with PDF file
    $livewire = livewire(\App\Filament\Resources\SocialMediaResource\Pages\ManageSocialMedia::class)
        ->callAction(CreateAction::class, [
            'name' => $name,
            'url' => $url,
            'image' => $pdfFile,
        ]);
    $livewire->assertHasErrors(['mountedActionsData.0.image']);

    // Test image validation with text file
    livewire(\App\Filament\Resources\SocialMediaResource\Pages\ManageSocialMedia::class)
        ->callAction(CreateAction::class, [
            'name' => $name,
            'url' => $url,
            'image' => $textFile,
        ])
        ->assertHasErrors(['mountedActionsData.0.image']);
});

it('validates url format', function () use ($name) {
    // Create an authenticated user with permission to access Filament
    $this->actingAs($this->admin);

    // Setup fake storage for uploads
    Storage::fake('public');
    $image = UploadedFile::fake()->image('social-icon.png', 120, 120);

    // Test with invalid URL
    $invalidUrl = 'not-a-valid-url';

    $livewire = livewire(\App\Filament\Resources\SocialMediaResource\Pages\ManageSocialMedia::class)
        ->callAction(CreateAction::class, [
            'name' => $name,
            'url' => $invalidUrl,
            'image' => $image,
        ]);
    $livewire->assertHasErrors(['mountedActionsData.0.url' => [
        'url',
    ]]);
});

it('can edit a social media', function () use ($name, $url, $newName, $newUrl) {
    // Create an authenticated user with permission to access Filament
    $this->actingAs($this->admin);

    // Find an existing social media to edit
    $socialMedia = SocialMedia::query()->where([
        'name' => $name,
        'url' => $url,
    ])->first();

    // Setup fake storage for image upload
    Storage::fake('public');
    $newImage = UploadedFile::fake()->image('new-social-icon.png', 120, 120);

    livewire(\App\Filament\Resources\SocialMediaResource\Pages\ManageSocialMedia::class)
        ->callTableAction(EditAction::class, $socialMedia, [
            'name' => $newName,
            'url' => $newUrl,
            'image' => $newImage,
        ]);

    // Assert that the record was updated in the database
    $updatedSocialMedia = SocialMedia::where('name', $newName)->first();
    expect($updatedSocialMedia)->not->toBeNull()
        ->and($updatedSocialMedia->url)->toBe($newUrl)
        ->and($updatedSocialMedia->image)->not->toBeEmpty()
        ->and($updatedSocialMedia->image)->not->toBe($socialMedia->image);
});

it('can delete a social media', function () use ($newName) {
    $socialMedia = SocialMedia::query()->where('name', $newName)->first();

    actingAs($this->admin);
    livewire(\App\Filament\Resources\SocialMediaResource\Pages\ManageSocialMedia::class)
        ->callTableAction(\Filament\Actions\DeleteAction::class, $socialMedia)
        ->assertSuccessful();

    expect(SocialMedia::query()->where('name', $newName)->count())->toBe(0);
});

it('can reorder social media', function () {
    // Create an authenticated user with permission to access Filament
    $this->actingAs($this->admin);

    // Create two social media entries for testing reordering
    Storage::fake('public');
    $image1 = UploadedFile::fake()->image('social1.png', 120, 120);
    $image2 = UploadedFile::fake()->image('social2.png', 120, 120);

    $name1 = fake()->word().' First';
    $name2 = fake()->word().' Second';
    $url1 = fake()->url();
    $url2 = fake()->url();

    // Create first social media
    livewire(\App\Filament\Resources\SocialMediaResource\Pages\ManageSocialMedia::class)
        ->callAction(CreateAction::class, [
            'name' => $name1,
            'url' => $url1,
            'image' => $image1,
        ]);

    // Create second social media
    livewire(\App\Filament\Resources\SocialMediaResource\Pages\ManageSocialMedia::class)
        ->callAction(CreateAction::class, [
            'name' => $name2,
            'url' => $url2,
            'image' => $image2,
        ]);

    // Get the created social media entries
    $socialMedia1 = SocialMedia::query()->where('name', $name1)->first();
    $socialMedia2 = SocialMedia::query()->where('name', $name2)->first();

    // Initial order check
    expect($socialMedia1->sort)->toBeLessThan($socialMedia2->sort);

    // Simulate reordering
    livewire(\App\Filament\Resources\SocialMediaResource\Pages\ManageSocialMedia::class)
        ->call('reorderTable', [
            $socialMedia2->id,
            $socialMedia1->id,
        ]);

    // Refresh models from database
    $socialMedia1->refresh();
    $socialMedia2->refresh();

    // Check if the order has been changed
    expect($socialMedia2->sort)->toBeLessThan($socialMedia1->sort);

    SocialMedia::query()->update([
        'image' => 'post.png',
    ]);
});
