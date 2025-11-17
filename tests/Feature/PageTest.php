<?php

use App\Filament\Resources\PageResource;
use App\Models\Page;
use Illuminate\Support\Str;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

$title = fake()->sentence();
$content = '<p>'.fake()->paragraph().'</p><p>'.fake()->paragraph().'</p>';

it('admin can access index page', function () {
    actingAs($this->admin);
    $response = $this->get(PageResource::getUrl());
    $response->assertStatus(200);
});

it('admin can access create page', function () {
    actingAs($this->admin);
    $response = $this->get(PageResource::getUrl('create'));
    $response->assertStatus(200);
});

it('validates required fields', function () {
    // Create an authenticated user with permission to access Filament
    $this->actingAs($this->admin);

    // Try to create a page with missing required fields
    livewire(\App\Filament\Resources\PageResource\Pages\CreatePage::class)
        ->fillForm([
            'title' => '',
            'content' => '',
            'is_publish' => true,
        ])
        ->call('create')
        ->assertHasFormErrors(['title', 'content']);
});

it('properly handles content with images', function () {
    // Create an authenticated user with permission to access Filament
    $this->actingAs($this->admin);

    $title = fake()->sentence();

    // Content with S3 URL that should be replaced with @storage
    $s3Url = config('filesystems.disks.s3.url');
    $contentWithS3Url = '<p>'.fake()->paragraph().'</p><img src="'.$s3Url.'/images/test.jpg" alt="Test Image"><p>'.fake()->paragraph().'</p>';

    // Simulate the creation of a page using the Filament resource
    livewire(\App\Filament\Resources\PageResource\Pages\CreatePage::class)
        ->fillForm([
            'title' => $title,
            'content' => $contentWithS3Url,
            'is_publish' => true,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    // Assert that the record was created in the database
    $slug = Str::slug($title);
    $page = Page::query()->where('slug', $slug)->first();

    expect($page)->not->toBeNull();

    // Check if content was properly stored with @storage replacement
    $storedContent = $page->getAttributes()['content']; // Get raw attribute before accessor transforms it
    expect($storedContent)->toContain('@storage');
    expect($storedContent)->not->toContain($s3Url);

    // Check if accessor properly replaces @storage with S3 URL
    $displayedContent = $page->content;
    expect($displayedContent)->toContain($s3Url);
    expect($displayedContent)->not->toContain('@storage');
});
