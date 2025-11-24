<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\Login as BaseLogin;
use Filament\Panel;
use Illuminate\Support\Facades\Route;

class Login extends BaseLogin
{


    protected function getCredentialsFromFormData(array $data): array
    {

        return [
            'email' => $data['email'],
            'password' => $data['password'],
        ];
    }

    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label('Email')
            ->email()
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }

    protected function getPasswordFormComponent(): Component
    {
        return TextInput::make('password')
            ->label('Password')
            ->password()
            ->required()
            ->extraInputAttributes(['tabindex' => 2]);
    }

    protected function getRememberFormComponent(): Component
    {
        return Checkbox::make('remember')
            ->label('Remember me')
            ->extraInputAttributes(['tabindex' => 3]);
    }

    public static function routes(Panel $panel): void
    {
        Route::match(['get', 'post'], static::getRoutePath(), static::class)
            ->middleware(static::getRouteMiddleware($panel))
            ->withoutMiddleware(static::getWithoutRouteMiddleware($panel))
            ->name(static::getRelativeRouteName());
    }
}
