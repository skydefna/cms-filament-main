@foreach ($menu as $item)
    @if ($item['type'] === 'page')
        @if (isset($item['page']['slug']))
            <li class="py-2 px-1">
                <a href="{{ url('/page/' . $item['page']['slug'] ?? '/') }}"
                    class="block text-black hover:text-gray800 font-semibold rounded" aria-current="page">
                    {{ $item['title'] ?? '' }}
                </a>
            </li>
        @else
            <li>
                <a href="#">
                    {{ $item['title'] }} (Halaman Tidak Ditemukan)
                </a>
            </li>
        @endif
        {{-- dropdown --}}
    @elseif($item['type'] === 'dropdown' && count($item['children']) > 0)
        <li class="block text-black hover:text-gray800 font-semibold rounded ml-6">
            <button id="{{ \Illuminate\Support\Str::camel($item['title']) }}Link"
                data-dropdown-toggle="{{ \Illuminate\Support\Str::camel($item['title']) }}Navbar"
                class="flex items-center justify-between w-full text-black">
                {{ $item['title'] }}
                <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>
            <div id="{{ \Illuminate\Support\Str::camel($item['title']) }}Navbar"
                class="z-10 hidden font-semibold bg-gradient-to-br from-amber-300 via-yellow-300 to-orange-300 border border-gray-50 divide-y divide-gray-500 rounded-lg shadow-xl w-full max-w-xs">
                <ul class="py-3 flex flex-col gap-3 px-4 z-50 text-gray-700 transition-all duration-300"
                    aria-labelledby="dropdownLargeButton">
                    <x-menu :menu="$item['children']" />
                </ul>
            </div>
        </li>
    @elseif ($item['type'] === 'url_internal')
        <li class="py-2 px-1">
            <a @class([
                'block text-black hover:text-gray800 font-semibold rounded',
                'font-extrabold text-amber-400' => url($item['path']) == url()->current(),
            ]) aria-current="page" href="{{ url($item['path']) }}">
                {{ $item['title'] ?? '' }}
            </a>
        </li>
    @else
        <li class="py-2 px-1">
            <a href="{{ $item['url'] }}" @class([
                'block text-black hover:text-gray-800 font-semibold rounded',
                'font-extrabold' => $item['url'] == url()->current(),
            ]) aria-current="page">
                {{ $item['title'] ?? '' }}
            </a>
        </li>
    @endif
@endforeach
