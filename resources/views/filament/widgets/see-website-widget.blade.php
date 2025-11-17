<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex gap-4">
            <img class="h-10" src="{{ asset('images/web.png') }}"/>
            <div class="flex flex-col">
                {{-- Widget content --}}
                <a target="_blank" href="{{ url('/') }}" class="text-base font-semibold hover:underline">
                    Lihat Website
                </a>
                {{-- Widget content --}}
                <a target="_blank" href="{{ url('/') }}" class="text-sm text-gray-500 hover:underline">
                    {{ url('/') }}
                </a>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
