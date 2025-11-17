<x-layouts.app>
    {{-- Header --}}
    <x-widgets.header/>

    {{-- Wrapper --}}
    <x-layouts.parts.wrapper>

        {{-- Heading --}}
        <div class="col-span-12 w-full mb-8 text-center">    
            <x-heading label="Katalog Layanan E-Government"/>
        </div>

        {{-- Main Content --}}        
        <main id="main-content" class="col-span-12 w-full">

            {{-- Info pencarian --}}
            @if(request()->has('keyword'))
                <div class="mb-6 text-center">
                    <p class="text-gray-700">
                        Menampilkan hasil pencarian untuk 
                        <span class="font-semibold text-primary-700">"{{ request()->query('keyword') }}"</span>
                    </p>
                    <button id="button-clear-search"
                        class="mt-3 bg-primary-100 text-primary-700 border border-primary-500 px-4 py-2 rounded-lg hover:bg-primary-200 transition">
                        Bersihkan Pencarian
                    </button>
                </div>
            @endif

            {{-- Daftar katalog --}}
            <div class="grid grid-cols-1 gap-8"> {{-- tambahkan gap-8 untuk jarak antar kartu --}}
                @forelse ($katalog as $item)
                    <div class="w-full bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition duration-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                            {{-- Kolom kiri --}}
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800 border-b border-primary-300 pb-1 mb-2">
                                    {{ $item->category }}
                                </h3>
                                <h4 class="text-lg font-semibold text-primary-700">
                                    {{ $item->name }}
                                </h4>
                            </div>

                            {{-- Kolom kanan --}}
                            <div>
                                @if(!empty($item->deskripsi_kategori))
                                    <p class="text-gray-700 leading-relaxed text-justify text-base md:text-lg">
                                        {{ $item->deskripsi_kategori }}
                                    </p>
                                @else
                                    <p class="text-gray-400 italic">Tidak ada deskripsi tersedia.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-500 py-12">
                        Belum ada data katalog layanan yang tersedia.
                    </div>
                @endforelse
            </div>

        </main>

    </x-layouts.parts.wrapper>

    {{-- Footer --}}
    <x-widgets.footer-widget/>
</x-layouts.app>