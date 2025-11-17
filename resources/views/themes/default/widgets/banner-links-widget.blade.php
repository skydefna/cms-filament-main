<div class="relative grid grid-cols-1 gap-4">
    <x-heading label="Banner Link"/>
    @if(count($bannerLinks))
        <div class="flex gap-4 flex-wrap">
            @foreach($bannerLinks as $bannerLink)
                <x-banner-link-card :banner-link="$bannerLink"/>
            @endforeach
        </div>
    @else
        <p>Kosong...</p>
    @endif
</div>
