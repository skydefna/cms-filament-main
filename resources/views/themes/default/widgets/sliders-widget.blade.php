<div class="pb-20">
    @if (count($sliders) > 1)
    <x-carousel type="loop"
                focus="left"
                height="100%"
                targetId="slider-widget"
                :autoHeight="false"
                :autoWidth="false"
                padding="0px"
                :pagination="true"
                :cover="true"
                track-classname="container mx-auto rounded-3xl border border-gray-100 overflow-hidden mt-12"
                :heightRatio="$aspectRatio">
        @foreach ($sliders as $slider)
            <x-carousel-item>
                @php
                    if ($slider->hyperlink) {
                        $href = $slider->hyperlink;
                    } else {
                        $href = 'javascript:void(0)';
                    }
                @endphp
                <a href="{!! $href !!}" target="_blank" class="relative">
                    <img @class(['aspect-video h-full w-full object-cover', 'brightness-75' => !empty($slider->desc), 'brightness-100' => empty($slider->desc)])
                         loading="lazy"
                         src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($slider->image) }}"
                         alt="{{ $slider->name }}">
                    @if ($slider->desc)
                        <div
                            class="container mx-auto w-full text-md absolute bottom-10 left-0 right-0 text-center font-display font-bold capitalize leading-5 tracking-tight text-white lg:text-4xl">
                            {{ $slider->desc }}
                        </div>
                    @endif
                </a>
            </x-carousel-item>
        @endforeach
    </x-carousel>
@elseif(count($sliders) === 1)
    <div class="relative flex w-full items-center justify-center py-6">
        <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($sliders[0]->image) ?? '#' }}"
             class="h-full w-full rounded-2xl border border-gray-100" loading="lazy" alt="{{ $sliders[0]->name ?? '' }}">
        @if ($sliders[0]->desc ?? '')
            <div
                class="text-md absolute bottom-10 left-0 right-0 px-6 py-3 text-center font-display font-bold capitalize leading-5 tracking-tight text-white md:text-left lg:text-4xl">
                {{ $sliders[0]->desc ?? '' }}
            </div>
        @endif
    </div>
@else
    <p>Belum ada gambar...</p>
@endif

</div>
