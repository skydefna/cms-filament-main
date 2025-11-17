<?php

namespace App\Filament\TiptapActions;

use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\TextInput;

class IframeAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'filament_tiptap_iframe';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->modalWidth('md')
            ->modalHeading('Insert Iframe')
            ->arguments([
                'src' => '',
                'width' => '',
                'height' => '',
                'title' => '',
            ])
            ->form([
                TextInput::make('src')
                    ->label('URL')
                    ->url()
                    ->required()
                    ->placeholder('https://example.com'),
                TextInput::make('width')
                    ->label('Width')
                    ->placeholder('100%'),
                TextInput::make('height')
                    ->label('Height')
                    ->placeholder('400'),
                TextInput::make('title')
                    ->label('Title')
                    ->placeholder('Iframe title'),
            ])
            ->action(function (array $arguments, array $data) {
                return $arguments['editor']->chain()->focus()->insertContent([
                    'type' => 'iframe',
                    'attrs' => [
                        'src' => $data['src'],
                        'width' => $data['width'] ?: null,
                        'height' => $data['height'] ?: null,
                        'title' => $data['title'] ?: null,
                    ],
                ])->run();
            });
    }
}
