<?php

use App\Filament\Resources\SliderResource;
use App\Models\Slider;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

$name = fake()->sentence(3);
$desc = fake()->paragraph();
$isActive = true;
$hyperlink = fake()->url();

it('admin can access index page', function () {
    actingAs($this->admin);
    $response = $this->get(SliderResource::getUrl());
    $response->assertStatus(200);
});

it('can create a slider', function () use ($name, $desc, $isActive, $hyperlink) {
    // Create an authenticated user with permission to access Filament
    $this->actingAs($this->admin);

    // Setup fake storage for image upload
    Storage::fake('public');
    $image = UploadedFile::fake()->image('slider.jpg', 1600, 900);

    // Get the next sort value
    $sort = Slider::max('sort') + 1 ?? 1;

    // Simulate the creation of a slider using the Filament resource
    livewire(\App\Filament\Resources\SliderResource\Pages\ManageSliders::class)
        ->callAction(CreateAction::class, [
            'name' => $name,
            'desc' => $desc,
            'is_active' => $isActive,
            'sort' => $sort,
            'hyperlink' => $hyperlink,
            'image' => $image,
        ]);

    // Assert that the record was created in the database
    expect(Slider::query()->where('name', $name)->where('desc', $desc)->exists())->toBeTrue();

    // Get the created slider to verify other fields
    $slider = Slider::query()->where('name', $name)->first();
    expect($slider)->not->toBeNull()
        ->and($slider->is_active)->toBe($isActive ? 1 : 0)
        ->and($slider->sort)->toBe($sort)
        ->and($slider->hyperlink)->toBe($hyperlink)
        ->and($slider->image)->not->toBeEmpty();
});

it('validates that only images can be uploaded', function () use ($name, $desc, $isActive, $hyperlink) {
    // Create an authenticated user with permission to access Filament
    $this->actingAs($this->admin);

    // Setup fake storage for uploads
    Storage::fake('public');

    // Create a non-image file
    $pdfFile = UploadedFile::fake()->create('document.pdf', 100, 'application/pdf');

    // Get the next sort value
    $sort = Slider::max('sort') + 1 ?? 1;

    // Test image validation with PDF file
    $livewire = livewire(\App\Filament\Resources\SliderResource\Pages\ManageSliders::class)
        ->callAction(\Filament\Actions\CreateAction::class, [
            'name' => $name,
            'desc' => $desc,
            'is_active' => $isActive,
            'sort' => $sort,
            'hyperlink' => $hyperlink,
            'image' => $pdfFile,
        ]);
    $livewire->assertHasErrors(['mountedActionsData.0.image']);
});

it('validates image file size limits', function () use ($name, $desc, $isActive, $hyperlink) {
    // Create an authenticated user with permission to access Filament
    $this->actingAs($this->admin);

    // Setup fake storage for uploads
    Storage::fake('public');

    // Create oversized image file (over 2000 KB as specified in the resource)
    $largeImage = UploadedFile::fake()->image('large.jpg')->size(2001);

    // Get the next sort value
    $sort = Slider::max('sort') + 1 ?? 1;

    // Test image size validation
    $livewire = livewire(\App\Filament\Resources\SliderResource\Pages\ManageSliders::class)
        ->callAction(CreateAction::class, [
            'name' => $name,
            'desc' => $desc,
            'is_active' => $isActive,
            'sort' => $sort,
            'hyperlink' => $hyperlink,
            'image' => $largeImage,
        ]);
    $livewire->assertHasErrors(['mountedActionsData.0.image']);
});

it('can edit a slider', function () use ($name, $desc) {
    // Create an authenticated user with permission to access Filament
    $this->actingAs($this->admin);

    // Find an existing slider to edit
    $slider = Slider::query()->where([
        'name' => $name,
        'desc' => $desc,
    ])->first();

    // Setup fake storage for image upload
    Storage::fake('public');
    $newImage = UploadedFile::fake()->image('new-slider.jpg', 1600, 900);

    // Simulate editing the slider using the Filament resource
    $newName = fake()->sentence(3);
    $newDesc = fake()->paragraph();
    $newIsActive = false;
    $newHyperlink = fake()->url();
    $newSort = $slider->sort + 1;

    livewire(\App\Filament\Resources\SliderResource\Pages\ManageSliders::class)
        ->callTableAction(EditAction::class, $slider, [
            'name' => $newName,
            'desc' => $newDesc,
            'is_active' => $newIsActive,
            'sort' => $newSort,
            'hyperlink' => $newHyperlink,
            'image' => $newImage,
        ]);

    // Assert that the record was updated in the database
    $updatedSlider = Slider::where('name', $newName)->first();
    expect($updatedSlider)->not->toBeNull()
        ->and($updatedSlider->desc)->toBe($newDesc)
        ->and($updatedSlider->is_active)->toBe($newIsActive ? 1 : 0)
        ->and($updatedSlider->sort)->toBe($newSort)
        ->and($updatedSlider->hyperlink)->toBe($newHyperlink)
        ->and($updatedSlider->image)->not->toBeEmpty()
        ->and($updatedSlider->image)->not->toBe($slider->image);
});

it('can delete a slider', function () use ($name) {
    $slider = Slider::query()->latest()->first();

    actingAs($this->admin);
    livewire(\App\Filament\Resources\SliderResource\Pages\ManageSliders::class)
        ->callTableAction(\Filament\Actions\DeleteAction::class, $slider)
        ->assertSuccessful();

    expect(Slider::query()->where('name', $name)->count())->toBe(0);
});

it('can reorder sliders', function () {
    // Create an authenticated user with permission to access Filament
    $this->actingAs($this->admin);

    // Setup fake storage for uploads
    Storage::fake('public');

    // Create two sliders for testing reordering
    $image1 = UploadedFile::fake()->image('slider1.jpg', 1600, 900);
    $image2 = UploadedFile::fake()->image('slider2.jpg', 1600, 900);

    $name1 = fake()->sentence(3).' First';
    $name2 = fake()->sentence(3).' Second';

    // Get the next sort values
    $sort1 = Slider::max('sort') + 1 ?? 1;
    $sort2 = $sort1 + 1;

    // Create first slider
    livewire(\App\Filament\Resources\SliderResource\Pages\ManageSliders::class)
        ->callAction(CreateAction::class, [
            'name' => $name1,
            'desc' => fake()->paragraph(),
            'is_active' => true,
            'sort' => $sort1,
            'hyperlink' => fake()->url(),
            'image' => $image1,
        ]);

    // Create second slider
    livewire(\App\Filament\Resources\SliderResource\Pages\ManageSliders::class)
        ->callAction(CreateAction::class, [
            'name' => $name2,
            'desc' => fake()->paragraph(),
            'is_active' => true,
            'sort' => $sort2,
            'hyperlink' => fake()->url(),
            'image' => $image2,
        ]);

    // Get the created sliders
    $slider1 = Slider::where('name', $name1)->first();
    $slider2 = Slider::where('name', $name2)->first();

    // Initial order check
    expect($slider1->sort)->toBeLessThan($slider2->sort);

    // Simulate reordering by updating the order of IDs
    livewire(\App\Filament\Resources\SliderResource\Pages\ManageSliders::class)
        ->call('reorderTable', [
            $slider2->id,
            $slider1->id,
        ]);

    // Refresh models from database
    $slider1->refresh();
    $slider2->refresh();

    // Check if the order has been changed
    expect($slider2->sort)->toBeLessThan($slider1->sort);

    // reset image
    Slider::query()->update(['image' => 'slider.jpg']);
});
