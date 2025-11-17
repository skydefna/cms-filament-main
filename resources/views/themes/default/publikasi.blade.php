<x-layouts.app>
    {{--heder--}}
    <x-widgets.header/>
    {{--wrapper--}}
    <x-layouts.parts.wrapper>
        {{--heading--}}
        <div class="col-span-12 w-full">
            <x-heading label="{{ ucwords($title) }}"/>
        </div>
        {{--main--}}
        <main id="main-content" class="grid col-span-12 gap-12 w-full">
            @if(request()->has('keyword'))
                <div class="mb-3">
                    <p>
                        Menampilkan pencarian dengan keyword "{{request()->query('keyword')}}"
                    </p>
                    <button id="button-clear-search"
                            class="mt-1 bg-secondary-300 text-primary-700 border-2 border-primary-500 px-3 py-1"
                            href="#">Bersihkan
                    </button>
                </div>
            @endif
            <div class="mt-3 grid grid-cols-1 md:grid-cols-2 gap-4 w-full">
                @foreach($listPublikasi as $publikasi)
                    <x-publikasi-card :publikasi="$publikasi"/>
                @endforeach
            </div>
            <div class="flex items-center justify-center w-full">
                <x-pagination :list="$listPublikasi"/>
            </div>
        </main>
    </x-layouts.parts.wrapper>
    {{--footer--}}
    <x-widgets.footer-widget/>
</x-layouts.app>
