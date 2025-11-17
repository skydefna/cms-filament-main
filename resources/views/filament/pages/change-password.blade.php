<x-filament-panels::page>
    <div class="filament-card-container">
        <x-filament::section>
            <x-filament-panels::form wire:submit="save">
                {{ $this->form }}

                <div class="flex justify-end mt-4">
                    <x-filament::button type="submit">
                        Save
                    </x-filament::button>
                </div>
            </x-filament-panels::form>
        </x-filament::section>
    </div>
</x-filament-panels::page>
