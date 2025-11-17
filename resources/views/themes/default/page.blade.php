<x-layouts.app>
    {{-- heder --}}
    <x-widgets.header />
    {{-- wrapper --}}
    <x-layouts.parts.wrapper>
        {{-- main --}}
        <main id="main-content" class="flex flex-col gap-4 w-full container mx-auto">
            <x-heading label="{{ $page->title }}" />

            <div class="flex w-full justify-end grow">
                <x-button-link icon="heroicon-o-arrow-left" label="kembali" href="{{ url()->previous() }}" />
            </div>
            <x-prose>
                {!! $page->content !!}
            </x-prose>
        </main>
    </x-layouts.parts.wrapper>
    {{-- footer --}}
    <x-widgets.footer-widget />

    <x-script-page/>
</x-layouts.app>
