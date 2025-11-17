<div {{ $attributes->merge(['class'=>'h-full w-full relative']) }}>
    {{-- Dashed Center Fade Grid --}}
    <div
        class="absolute inset-0 z-0"
        style="
            background-image:
                linear-gradient(to right, #e7e5e4 1px, transparent 1px),
                linear-gradient(to bottom, #e7e5e4 1px, transparent 1px);
            background-size: 20px 20px;
            background-position: 0 0, 0 0;
            mask-image:
                repeating-linear-gradient(
                    to right,
                    black 0px,
                    black 3px,
                    transparent 3px,
                    transparent 8px
                ),
                repeating-linear-gradient(
                    to bottom,
                    black 0px,
                    black 3px,
                    transparent 3px,
                    transparent 8px
                ),
                radial-gradient(ellipse 60% 60% at 50% 50%, #000 30%, transparent 70%);
            mask-composite: intersect;
            -webkit-mask-composite: source-in;
        "
    ></div>

    {{-- Slot untuk konten --}}
    <div class="relative">
        {{ $slot }}
    </div>
</div>
