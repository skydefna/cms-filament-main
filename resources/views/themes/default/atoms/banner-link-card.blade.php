@php
    /**@var \App\Models\BannerLink $bannerLink*/
    $imageUrl = \Illuminate\Support\Facades\Storage::disk('public')->url($bannerLink->image);
    $url = $bannerLink->url;
@endphp

<div class="flex hover:scale-110 transition duration-300">
    <a href="{{$url}}">
        <img src="{{ $imageUrl }}" loading="lazy" alt="" class="w-full max-w-32 max-h-12"/>
    </a>
</div>

