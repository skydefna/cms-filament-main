@once
    @push('styles')
        <link rel="stylesheet" href="{{ asset('vendor/splide/css/themes/splide-default.min.css') }}">
    @endpush
@endonce

@once
    @push('scripts')
        <script src="{{ asset('vendor/splide/js/splide.min.js') }}"></script>
    @endpush
@endonce

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let config = {
                type: '{{ $type }}',
                width: '{{ $width }}',
                gap: '{{ $gap }}',
                focus: '{{ $focus }}',
                {{--// height: '{{ $height }}'--}}
                autoWidth: {{ $autoWidth ? 'true' : 'false' }},
                autoHeight: {{ $autoHeight ? 'true' : 'false' }},
                autoplay: {{ $autoplay ? 'true' : 'false' }},
                interval: {{ $interval }},
                trimSpace: {{ $trimSpace ? 'true' : 'false' }},
                cover: {{ $cover ? 'true' : 'false' }},
                pagination: {{ $pagination ? 'true' : 'false' }},
                {{--heightRatio: {{ $heightRatio ?: '0.3' }},--}}
                padding: '{{ $padding }}',
                perPage: {{ $perPage }},
                breakpoints: {
                    430: {
                        perPage: 1,
                    },
                    800: {
                        perPage: {{ $perPage }},
                    },
                }
            };
            @if ($heightRatio)
                config.heightRatio = {{ $heightRatio }};
            @endif
            let splide = new Splide('#{{ $targetId }}', config);
            splide.mount();
        });
    </script>
@endpush

<div class="splide" id="{{ $targetId }}" role="group">
    <div class="splide__track {{$trackClassname}}">
        <ul class="splide__list">
            {{ $slot }}
        </ul>
    </div>
</div>
