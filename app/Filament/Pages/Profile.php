<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Profile extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Edit Profil';

    protected static ?string $title = 'Edit Profil';

    protected static ?string $slug = 'profile';

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationGroup = 'Manajemen User';

    protected static string $view = 'filament.pages.profile';

    public ?array $data = [];

    public function mount(): void
    {
        $user = Auth::user();
        $this->form->fill([
            'name' => $user->name,
            'email' => $user->email,
            'avatar_url' => $user->avatar_url,
            'phone_number' => $user->phone_number,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Profile Information')
                    ->description('Update your account\'s profile information.')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        TextInput::make('phone_number')
                            ->tel()
                            ->label('Nomor Telepon')
                            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                            ->placeholder('+62 812 3456 7890')
                            ->helperText('Masukkan nomor dengan kode negara (+62)')
                            ->maxLength(20),
                    ])
                    ->columns(2),

                Section::make('Profile Picture')
                    ->description('Update your account\'s profile picture.')
                    ->schema([
                        FileUpload::make('avatar_url')
                            ->image()
                            ->imageEditor()
                            ->circleCropper()
                            ->directory('avatar_urls')
                            ->visibility('public')
                            ->maxSize(2048) // 2MB
                            ->imagePreviewHeight('250')
                            ->loadingIndicatorPosition('left')
                            ->panelAspectRatio('5:1')
                            ->panelLayout('integrated')
                            ->removeUploadedFileButtonPosition('right')
                            ->uploadButtonPosition('left')
                            ->uploadProgressIndicatorPosition('left'),
                    ]),
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        $user = Auth::user();

        // Handle avatar_url upload
        if (isset($data['avatar_url']) && $data['avatar_url'] !== $user->avatar_url) {
            // Delete old avatar_url if exists
            if ($user->avatar_url) {
                Storage::disk('public')->delete($user->avatar_url);
            }
        }

        // Update user profile
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'avatar_url' => $data['avatar_url'] ?? $user->avatar_url, // Preserve existing avatar_url if none uploaded
        ]);

        Notification::make()
            ->success()
            ->title('Profile updated successfully')
            ->send();
    }

    protected function getViewData(): array
    {
        return [
            'user' => Auth::user(),
        ];
    }
}
