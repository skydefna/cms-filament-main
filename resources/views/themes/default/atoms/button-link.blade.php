<a href="{{ $href }}" target="{{ $target }}" @class([
    'px-6 border border-white hover:text-amber-400 py-2 text-sm font-semibold hover:scale-105 transition-all duration-200 whitespace-nowrap text-xs',
    'flex gap-2 items-center' => !empty($icon),
    'rounded-lg' => $rounded,
    'text-white bg-black' => $variant == 'default',
    'text-black bg-white' => $variant == 'accent',
])>
    @if (!empty($icon))
        <x-icon @class(['h-6 w-auto']) :name="$icon" />
    @endif
    {{ $label }}
</a>
