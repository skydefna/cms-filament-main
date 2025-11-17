@props(['latitude', 'longitude', 'place', 'address' => null, 'height' => 'h-64'])
<div class="relative grid grid-cols-1 gap-4">
	<div class="relative flex w-full items-center justify-center overflow-hidden">
		<div id="mapWidget" class="{{ $height }} w-full grow rounded-xl bg-white border border-gray-100 overflow-hidden z-10"></div>
	</div>
	@if ($address)
		<small class="font-semibold">{{ $address }}</small>
	@endif
	<div class="flex items-end justify-end">
		<x-button-link icon="heroicon-o-map-pin" href="https://www.google.com/maps?q={{ $latitude }},{{ $longitude }}"
			label="Google Maps" />
	</div>
</div>

@once
	@push('styles')
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
			integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">
		<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
			integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
	@endpush
@endonce

@push('scripts')
	<script>
		// Inisialisasi peta
		const map = L.map('mapWidget').setView([{{ $latitude }}, {{ $longitude }}],
			13); // Ganti dengan latitude dan longitude Anda

		// Menambahkan layer peta OSM
		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			maxZoom: 15,
		}).addTo(map);

		// Menambahkan marker
		L.marker([
				{{ $latitude }},
				{{ $longitude }},
			]).addTo(map)
			.bindPopup('{{ $place }}') 
			.openPopup();
	</script>
@endpush
