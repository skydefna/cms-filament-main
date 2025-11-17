<?php

namespace App\Filament\Forms\Components;

use FilamentTiptapEditor\TiptapEditor;

class CustomTiptapEditor extends TiptapEditor
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->registerListeners([
            'tiptap::setIframeContent' => [
                fn (
                    TiptapEditor $component,
                    string $statePath,
                    array $arguments
                ) => $this->getCustomListener('filament_tiptap_iframe', $component, $statePath, $arguments),
            ],
        ]);
    }
}
