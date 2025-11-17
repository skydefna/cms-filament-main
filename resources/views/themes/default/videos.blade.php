<x-layouts.app>
    {{--heder--}}
    <x-widgets.header/>
    {{--wrapper--}}
    <x-layouts.parts.wrapper>
        {{--heading--}}
        <div class="col-span-12 w-full">
            <x-heading label="Video Terbaru"/>
        </div>
        {{--main--}}
        <main id="main-content" class="grid col-span-12 gap-12 w-full">
            {{--global search--}}

            <div class="mt-3 grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($videos as $video)
                    <x-youtube-card :youtube-video="$video"/>
                @endforeach
            </div>
            <x-pagination :list="$videos"/>
        </main>
    </x-layouts.parts.wrapper>
    {{--footer--}}
    <x-widgets.footer-widget/>
</x-layouts.app>
