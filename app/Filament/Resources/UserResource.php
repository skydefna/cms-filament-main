<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use App\Notifications\ChangePasswordNotification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationGroup = 'Manajemen User';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                    ->label('Nomor Telepon')
                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                    ->placeholder('+6281234567890')
                    ->helperText('wajib berawalan +62')
                    ->columnSpanFull()
                    ->maxLength(20),
                Forms\Components\Select::make('skpd_id')
                    ->label('SKPD')
                    ->relationship('skpd', 'nama')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->default(fn () => auth()->user()->skpd_id)
                    ->disabled(fn () => !auth()->user()->hasRole('super-admin')),
                Forms\Components\TextInput::make('password')
                    ->visibleOn('create')
                    ->confirmed()
                    ->revealable()
                    ->password()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password_confirmation')
                    ->visibleOn('create')
                    ->revealable()
                    ->password()
                    ->required()
                    ->maxLength(255),
                Forms\Components\CheckboxList::make('roles')
                    ->columnSpanFull()
                    ->relationship('roles', 'name', function ($query) {
                        if (Auth::user()->hasAnyRole('super-admin')) {
                            return $query;
                        }

                        return $query->where('name', '<>', 'super-admin');
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        $query = User::query()->where('email', '!=', config('app.super_admin'));

        return $table
            ->query($query)
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->copyable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->label('Nomor Telepon')
                    ->copyable()
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('skpd.nama')
                    ->label('SKPD')
                    ->copyable()
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('roles.name')
                    ->badge()
                    ->formatStateUsing(fn ($state) => ucfirst($state))
                    ->color('primary')
                    ->searchable(),                
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['email_verified_at'] = now();
                        unset($data['password']);

                        return $data;
                    }),
                Tables\Actions\DeleteAction::make()
                    ->visible(function ($record) {
                        return $record->id !== Auth::id();
                    }),
                Tables\Actions\Action::make('resetPassword')
                    ->label('Reset Password')
                    ->icon('heroicon-o-key')
                    ->form([
                        Forms\Components\TextInput::make('new_password')
                            ->label('New Password')
                            ->password()
                            ->revealable()
                            ->required()
                            ->minLength(8)
                            ->confirmed(),  
                        Forms\Components\TextInput::make('new_password_confirmation')
                            ->label('Confirm New Password')
                            ->password()
                            ->revealable()
                            ->required()
                            ->minLength(8),
                    ])
                    ->action(function (User $record, array $data): void {
                        $record->update([
                            'password' => bcrypt($data['new_password']),
                            'has_change_password' => false,
                        ]);
                        try {
                            $record->notify(new ChangePasswordNotification('Password reset successfully'));
                        } catch (\Exception $exception) {
                            Log::error($exception);
                        }
                        Notification::make()
                            ->title('Password reset successfully')
                            ->success()
                            ->send();
                    })
                    ->visible(function ($record) {
                        return $record->id !== Auth::id();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUsers::route('/'),
        ];
    }
}
