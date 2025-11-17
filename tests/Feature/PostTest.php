<?php

use App\Filament\Resources\PostResource;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

$title = fake()->sentence();
$body = '<p>'.fake()->paragraph().'</p><p>'.fake()->paragraph().'</p>';

it('admin can access index page', function () {
    actingAs($this->admin);
    $response = $this->get(PostResource::getUrl());
    $response->assertStatus(200);
    Post::query()->update(['image' => 'post.png', 'thumbnail' => 'post.png']);
});

it('admin can access create page', function () {
    actingAs($this->admin);
    $response = $this->get(PostResource::getUrl('create'));
    $response->assertStatus(200);
});

it('can create a post', function () use ($title, $body) {
    // Create an authenticated user with permission to access Filament
    $this->actingAs($this->admin);

    // Get a category for the post
    $category = PostCategory::first();
    if (! $category) {
        // Create a category if none exists
        $category = PostCategory::create([
            'name' => 'Test Category',
            'active' => true,
            'sort' => 1,
            'slug' => 'test-category',
        ]);
    }

    // Setup fake storage for image uploads
    Storage::fake('public');
    $thumbnail = UploadedFile::fake()->image('thumbnail.jpg', 1600, 900);
    $image = UploadedFile::fake()->image('image.jpg', 1200, 800);

    // Simulate the creation of a post using the Filament resource
    livewire(\App\Filament\Resources\PostResource\Pages\CreatePost::class)
        ->fillForm([
            'category_id' => $category->id,
            'title' => $title,
            'is_publish' => true,
            'body' => $body,
            'thumbnail' => $thumbnail,
            'image' => $image,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    // Assert that the record was created in the database
    $slug = Str::slug($title);
    $year = date('Y');
    $month = date('m');

    $post = Post::query()
        ->where('title', $title)
        ->where('year', $year)
        ->where('month', $month)
        ->where('slug', $slug)
        ->first();

    expect($post)->not->toBeNull()
        ->and($post->category_id)->toBe($category->id)
        ->and(boolval($post->is_publish))->toBeTrue()
        ->and($post->image)->not->toBeEmpty()
        ->and($post->image)->not->toBeEmpty();
});

it('validates that only images can be uploaded', function () use ($title, $body) {
    // Create an authenticated user with permission to access Filament
    $this->actingAs($this->admin);

    // Get a category for the post
    $category = PostCategory::first();
    if (! $category) {
        // Create a category if none exists
        $category = PostCategory::create([
            'name' => 'Test Category',
            'active' => true,
            'sort' => 1,
            'slug' => 'test-category',
        ]);
    }

    // Setup fake storage for uploads
    Storage::fake('public');

    // Create non-image files
    $pdfFile = UploadedFile::fake()->create('document.pdf', 100, 'application/pdf');
    $textFile = UploadedFile::fake()->create('document.txt', 10, 'text/plain');

    // Test thumbnail validation
    livewire(\App\Filament\Resources\PostResource\Pages\CreatePost::class)
        ->fillForm([
            'category_id' => $category->id,
            'title' => $title,
            'is_publish' => true,
            'body' => $body,
            'thumbnail' => $pdfFile,
            'image' => UploadedFile::fake()->image('image.jpg'),
        ])
        ->call('create')
        ->assertHasFormErrors(['thumbnail']);

    // Test main image validation
    livewire(\App\Filament\Resources\PostResource\Pages\CreatePost::class)
        ->fillForm([
            'category_id' => $category->id,
            'title' => $title,
            'is_publish' => true,
            'body' => $body,
            'thumbnail' => UploadedFile::fake()->image('thumbnail.jpg'),
            'image' => $textFile,
        ])
        ->call('create')
        ->assertHasFormErrors(['image']);
});

it('validates image file size limits', function () use ($title, $body) {
    // Create an authenticated user with permission to access Filament
    $this->actingAs($this->admin);

    // Get a category for the post
    $category = PostCategory::first();
    if (! $category) {
        $category = PostCategory::create([
            'name' => 'Test Category',
            'active' => true,
            'sort' => 1,
            'slug' => 'test-category',
        ]);
    }

    // Setup fake storage for uploads
    Storage::fake('public');

    // Create oversized image files (over 1024 KB as specified in the resource)
    $largeImage = UploadedFile::fake()->image('large.jpg')->size(5048);

    // Test thumbnail size validation
    livewire(\App\Filament\Resources\PostResource\Pages\CreatePost::class)
        ->fillForm([
            'category_id' => $category->id,
            'title' => $title,
            'is_publish' => true,
            'body' => $body,
            'thumbnail' => $largeImage,
            'image' => UploadedFile::fake()->image('image.jpg'),
        ])
        ->call('create')
        ->assertHasFormErrors(['thumbnail']);

    // Test main image size validation
    livewire(\App\Filament\Resources\PostResource\Pages\CreatePost::class)
        ->fillForm([
            'category_id' => $category->id,
            'title' => $title,
            'is_publish' => true,
            'body' => $body,
            'thumbnail' => UploadedFile::fake()->image('thumbnail.jpg'),
            'image' => $largeImage,
        ])
        ->call('create')
        ->assertHasFormErrors(['image']);
});

it('can edit a post', function () use ($title) {
    // Create an authenticated user with permission to access Filament
    $this->actingAs($this->admin);

    // Find the post we created in the previous test
    $slug = Str::slug($title);
    $year = date('Y');
    $month = date('m');

    $post = Post::query()
        ->where('title', $title)
        ->where('year', $year)
        ->where('month', $month)
        ->where('slug', $slug)
        ->first();

    // Get a different category for updating
    $newCategory = PostCategory::where('id', '!=', $post->category_id)->first();
    if (! $newCategory) {
        // Create a new category if there's only one
        $newCategory = PostCategory::create([
            'name' => 'Another Test Category',
            'active' => true,
            'sort' => 2,
            'slug' => 'another-test-category',
        ]);
    }

    // Setup fake storage for image uploads
    Storage::fake('public');
    $newThumbnail = UploadedFile::fake()->image('new-thumbnail.jpg', 1600, 900);
    $newImage = UploadedFile::fake()->image('new-image.jpg', 1200, 800);

    $newTitle = fake()->sentence();
    $newBody = '<p>'.fake()->paragraph().'</p><p>'.fake()->paragraph().'</p>';

    // Navigate to the edit page
    $response = $this->get(PostResource::getUrl('edit', ['record' => $post]));
    $response->assertStatus(200);

    // Simulate editing the post using the Filament resource
    livewire(\App\Filament\Resources\PostResource\Pages\EditPost::class, [
        'record' => $post->id,
    ])
        ->fillForm([
            'category_id' => $newCategory->id,
            'title' => $newTitle,
            'is_publish' => false,
            'body' => $newBody,
            'thumbnail' => $newThumbnail,
            'image' => $newImage,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    // Assert that the record was updated in the database
    $post->refresh();

    expect($post->title)->toBe($newTitle)
        ->and($post->category_id)->toBe($newCategory->id)
        ->and(boolval($post->is_publish))->toBeFalse()
        ->and($post->slug)->toBe(Str::slug($newTitle));
});

it('can delete a post', function () use ($title) {
    // Create an authenticated user with permission to access Filament
    $this->actingAs($this->admin);

    // Find the post we created and edited in the previous tests
    $slug = Str::slug($title);
    $year = date('Y');
    $month = date('m');

    $post = Post::query()
        ->where('year', $year)
        ->where('month', $month)
        ->first();

    if (! $post) {
        $this->markTestSkipped('No post found to delete');
    }

    // Navigate to the list page
    livewire(\App\Filament\Resources\PostResource\Pages\ListPosts::class)
        ->callTableAction(\Filament\Tables\Actions\DeleteAction::class, $post)
        ->assertSuccessful();

    // Assert that the post was deleted
    expect(Post::find($post->id))->toBeNull();
});
