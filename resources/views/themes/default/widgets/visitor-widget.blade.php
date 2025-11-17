<div class="relative flex flex-col gap-4">
    <x-heading label="Jumlah Kunjungan"/>
    <div @class([
        'grid grid-cols-2 lg:grid-cols-2 border border-gray-100 rounded-3xl bg-white overflow-hidden'
    ])>
        <x-visit-card label="Hari Ini" :value="$daily"/>
        <x-visit-card label="Bulan Ini" :value="$monthly"/>
        <x-visit-card label="Tahun Ini" :value="$yearly"/>
        <x-visit-card label="Total" :value="$total"/>
    </div>
</div>
