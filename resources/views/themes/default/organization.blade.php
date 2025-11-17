<x-layouts.app>
    {{--heder--}}
    <x-widgets.header/>
    {{--wrapper--}}
    <div class="flex flex-col py-12 container mx-auto">
        {{--heading--}}
        <div class="w-full mb-3">
            <x-heading class="text-center" label="Struktur Organisasi"/>
        </div>
        {{--main--}}
        <main id="main-content" class="flex items-center justify-center">
            <x-widgets.organization-chart/>
        </main>
    </div>
    {{--footer--}}
    <x-widgets.footer-widget/>
</x-layouts.app>
