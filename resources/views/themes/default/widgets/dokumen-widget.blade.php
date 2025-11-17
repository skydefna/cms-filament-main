@php
    use App\Models\DokumentasiDigital;
    $dokumenTerbaru = DokumentasiDigital::latest()->take(3)->get();
@endphp

<div class="relative flex flex-col gap-4 pb-20">
    <div class="flex justify-between items-center w-full">
        <x-heading :border="false" label="Dokumentasi Digital"/>
        <x-button-link
            icon="heroicon-o-arrow-right"
            href="{{ route('dokumen') }}"
            label="Lihat Semua"/>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse($dokumenTerbaru as $item)
            <div class="p-4 bg-white shadow rounded-lg flex flex-col justify-between">
                <div>
                    <h3 class="font-semibold text-base text-primary-700 mb-1">{{ $item->judul }}</h3>
                    <p class="text-sm text-gray-600 mb-3">{{ Str::limit($item->deskripsi, 80) }}</p>
                </div>
                <a href="{{ asset('storage/' . $item->file_path) }}" 
                   target="_blank"
                   class="text-center bg-primary-600 hover:bg-primary-700 text-white text-xs py-2 rounded">
                    Lihat Dokumen
                </a>
            </div>
        @empty
            <p class="text-gray-500">Belum ada dokumen.</p>
        @endforelse
    </div>
</div>