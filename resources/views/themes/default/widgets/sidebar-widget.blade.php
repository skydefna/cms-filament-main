<aside id="sidebar" class="grid col-span-12 md:col-span-4 gap-8 w-full">
    {{-- global search --}}
    <div class="hidden md:block">
        <x-widgets.global-search-widget action="{{ route('web.getPosts', ['type' => 'latest']) }}" />
    </div>
    {{-- kepala instansi --}}
{{--    <x-widgets.head-of-agency-widget />--}}
    {{-- video youtube --}}
    <x-widgets.youtube-videos-widget />
    {{-- banner-link --}}
    <x-widgets.banner-links-widget />
    {{-- visitor counter --}}
    <x-widgets.visitor-widget />
    {{-- contact --}}
    <x-widgets.contact-widget />
    {{-- social-media --}}
    <x-widgets.social-medias-widget />
    {{-- address widget --}}
    <x-widgets.address-widget />
</aside>
