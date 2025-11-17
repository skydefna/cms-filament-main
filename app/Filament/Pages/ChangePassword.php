<?php

namespace App\Filament\Pages;

use App\Notifications\ChangePasswordNotification;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

/**
 * @property mixed $form
 */
class ChangePassword extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-key';

    protected static string $view = 'filament.pages.change-password';

    // Show in navigation
    protected static bool $shouldRegisterNavigation = true;

    // Page title
    protected static ?string $title = 'Ubah Kata Sandi';

    // Navigation group
    protected static ?string $navigationGroup = 'Manajemen User';

    // Navigation sort
    protected static ?int $navigationSort = 5;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('current_password')
                    ->label('Kata Sandi Lama')
                    ->password()
                    ->revealable()
                    ->required()
                    ->currentPassword(),
                TextInput::make('new_password')
                    ->label('Kata Sandi Baru')
                    ->password()
                    ->revealable()
                    ->required()
                    ->minLength(8)
                    ->password()
                    ->validationAttribute('password')
                    ->different('current_password'),
                TextInput::make('new_password_confirmation')
                    ->revealable()
                    ->label('Konfirmasi Kata Sandi')
                    ->minLength(8)
                    ->password()
                    ->required()
                    ->same('new_password'),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $user = Auth::user();

        // In your save method
        $plainPassword = $data['new_password'];
        $hashedPassword = Hash::make($plainPassword);
        if (config('app.debug') && config('app.env') === 'local') {
            Log::debug("Plain: $plainPassword, Hashed: $hashedPassword");
        }

        // Update the password
        $user->password = $hashedPassword;
        $user->has_change_password = true;
        $user->save();

        // Notify the user
        Notification::make()
            ->title('Password berhasil diupdate')
            ->success()
            ->send();

        if ($user->phone_number && ! empty(config('service.evolution.url'))) {
            $user->notify(new ChangePasswordNotification('Password updated successfully'));
        }

        // Redirect to the dashboard
        $this->redirect(Filament::getHomeUrl());
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save')
                ->submit('save'),
        ];
    }
}
