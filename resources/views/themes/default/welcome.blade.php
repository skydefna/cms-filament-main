<x-layouts.app>
    <x-widgets.announcement-widget />
    {{-- heder --}}
    <x-widgets.header />

    {{-- main --}}
    <main id="main-content" class="relative flex w-full flex-col">
        {{-- slider widget --}}        
        <div class="container mx-auto">
            <x-widgets.sliders-widget :limit="4" />
        </div>        
        {{-- Dokumen --}}
        <x-pattern.dots>
            <div class="container mx-auto pt-20">
                <x-widgets.dokumen-widget />                
            </div>
        </x-pattern.dots>                  
    </main>
    {{-- footer --}}
    <x-widgets.footer-widget />
</x-layouts.app>
