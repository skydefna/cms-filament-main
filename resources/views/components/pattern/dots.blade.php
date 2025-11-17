<div {{ $attributes->merge(['class'=>'h-full w-full bg-white relative']) }}>
    <div
        className="absolute inset-0 z-0"
        style="background: #ffffff;
        background-image: radial-gradient(circle at 1px 1px, rgba(0, 0, 0, 0.35) 1px, transparent 0);
        background-size: 20px 20px;"
    />
    <div class="relative">
        {{$slot}}
    </div>
</div>
