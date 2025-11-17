@if ($pengaturanPimpinan->gambar_pimpinan)
	@php
		$imageUrl = \Illuminate\Support\Facades\Storage::disk('public')->url($pengaturanPimpinan->gambar_pimpinan);
	@endphp
	<div class="relative overflow-clip rounded-xl border border-white">
		<img src="{{ $imageUrl }}" alt="head-of-agency" loading="lazy"
			class="aspect-square h-full w-full object-cover brightness-90 grayscale-[30%] transition duration-300 hover:brightness-100 hover:grayscale-0">

		<div
			class="absolute bottom-0 left-0 right-0 mx-auto flex w-auto flex-col gap-1 bg-white p-3 px-6 text-gray-700 shadow-xl">
			<span @class(['font-extrabold text-lg text-center'])>{{ $pengaturanPimpinan->nama_pimpinan }}</span>
			<span @class(['text-sm text-center text-gray-500 font-semibold'])>{{ $pengaturanPimpinan->jabatan_pimpinan }}</span>
		</div>
	</div>
@endif
