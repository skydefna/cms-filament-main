<x-layouts.app>
    <x-widgets.header/>

    <x-layouts.parts.wrapper class="px-6 md:px-20">
        <div class="col-span-12 w-full text-center mb-10">    
            <x-heading label="Dokumentasi Digital"/>
        </div>
       
        <main id="main-content" class="col-span-12 w-full flex flex-col gap-12">
            @forelse($dokumen as $item)
                <div class="bg-white border border-gray-200 rounded-2xl shadow-md p-10 hover:shadow-lg transition duration-300">
                    {{-- Judul --}}
                    <h3 class="font-bold text-3xl text-primary-800 mb-4 ml-10" style="margin-left: 20px; margin-top: 20px;">
                        {{ $item->judul }}
                    </h3>

                    {{-- Deskripsi --}}
                    <p class="text-gray-700 mb-8 text-justify text-lg leading-relaxed ml-10" style="margin-left: 20px; margin-top: 10px; margin-bottom: 10px;">
                        {{ $item->deskripsi }}
                    </p>
                   
                    <div class="w-full rounded-lg border border-gray-100 bg-gray-50 mb-8 overflow-auto" style="height:90vh;">                        
                        <iframe 
                            src="{{ asset('storage/' . $item->file_path) }}" 
                            class="w-full h-full border-none rounded-lg"
                            style="min-height:300px;"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 py-12">
                    Belum ada dokumen
                </p>
            @endforelse
        </main>

    </x-layouts.parts.wrapper>

    <x-widgets.footer-widget/>
</x-layouts.app>