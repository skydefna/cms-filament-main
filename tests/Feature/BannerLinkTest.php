<?php

use App\Filament\Resources\BannerLinkResource;
use App\Models\BannerLink;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

$url = fake()->url();
$sort = 1;

it('admin can access index page', function () {
    actingAs($this->admin);
    $response = $this->get(BannerLinkResource::getUrl());
    $response->assertStatus(200);
});

it('can create a banner link', function () use ($url) {
    // Create an authenticated user with permission to access Filament
    $this->actingAs($this->admin);

    // Setup fake storage for image upload
    Storage::fake('public');
    $image = UploadedFile::fake()->image('fake.jpg', 1600, 900);

    // Simulate the creation of a banner link using the Filament resource
    livewire(\App\Filament\Resources\BannerLinkResource\Pages\ManageBannerLinks::class)
        ->callAction(CreateAction::class, [
            'url' => $url,
            'image' => $image,
        ]);

    // Assert that the record was created in the database
    expect(BannerLink::query()->where('url', $url)->exists())->toBeTrue();

    // Get the created banner link to verify the image was stored
    $bannerLink = BannerLink::query()->latest()->first();
    expect($bannerLink)->not->toBeNull()
        ->and($bannerLink->image)->not->toBeEmpty();

    BannerLink::query()->latest()->update(['image' => 'fake.jpg']);
    // Check if the image path exists in the database
});

it('can edit a banner link', function () use ($url) {
    // Create an authenticated user with permission to access Filament
    $this->actingAs($this->admin);

    // Find an existing banner link to edit
    $bannerLink = BannerLink::query()->where([
        'url' => $url,
    ])->first();

    // Setup fake storage for image upload
    Storage::fake('public');
    $newImage = UploadedFile::fake()->image('fake.jpg', 1600, 900);

    // Simulate editing the banner link using the Filament resource
    $newUrl = fake()->url();

    livewire(\App\Filament\Resources\BannerLinkResource\Pages\ManageBannerLinks::class)
        ->callTableAction(EditAction::class, $bannerLink, [
            'url' => $newUrl,
            'image' => $newImage,
        ]);

    // Assert that the record was updated in the database
    expect(BannerLink::where('url', $newUrl)->exists())
        ->toBeTrue();

    BannerLink::query()->latest()->update(['image' => 'fake.jpg']);
});

it('can delete a banner link', function () use ($url) {
    $bannerLink = BannerLink::query()->latest()->first();
    actingAs($this->admin);
    livewire(\App\Filament\Resources\BannerLinkResource\Pages\ManageBannerLinks::class)
        ->callTableAction(\Filament\Actions\DeleteAction::class, $bannerLink)
        ->assertSuccessful();

    expect(BannerLink::query()->where('url', $url)->count())->toBe(0);
});
