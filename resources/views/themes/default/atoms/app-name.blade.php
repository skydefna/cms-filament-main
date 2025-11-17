@php
    if ($variant === 'accent'){
        $className = 'text-white';
    }else{
        $className = 'text-black';
    }
@endphp
<div class="ml-3 flex flex-col w-full">
    <h1 class="text-lg hidden md:block whitespace-normal font-display font-semibold tracking-tighter leading-4 {{$className}}">
        Portal Layanan E-Government
    </h1>
    <h1 class="block md:hidden text-md whitespace-normal font-display font-semibold tracking-tighter leading-4 {{$className}}">
        {{ $siteShortName ?? $siteName }}
    </h1>
    <h4 class="whitespace-nowrap text-xs tracking-tighter leading-1 text-gray-400 {{$className}}">
        Pemerintah Kabupaten Tabalong
    </h4>
</div>
