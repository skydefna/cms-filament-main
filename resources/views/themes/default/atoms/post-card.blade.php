@php
    /** @var  \App\Models\Post $post */
    $imageUrl = \Illuminate\Support\Facades\Storage::disk('public')->url($post->image);
@endphp
<a href="{{ route('web.showPost', ['slug' => $post->slug, 'year' => $post->year, 'month' => $post->month]) }}"
   class="border px-6 py-3 rounded-3xl items-center flex border-gray-100 shadow hover:shadow-xl hover:scale-105 transition-all duration-300 flex-col bg-white/5 backdrop-blur-sm">
    <div class="flex flex-col items-center justify-center space-x-4">
        <div class="h-full rounded-xl relative overflow-hidden">
            <img src="{{ $imageUrl }}" loading="lazy" alt="" class="w-full object-cover"/>
            <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent"></div>
            <div class="absolute top-5 left-5 bg-white text-gray-700 font-bold px-4 py-2 text-sm rounded-2xl">
                {{ $post->category->name }}
            </div>
        </div>
        <div class="space-y-[6px] flex-1 w-full mt-3">
            <h1 class="text-sm leading-7 font-extrabold font-display hover:underline">{{\Illuminate\Support\Str::limit($post->title, 50)}}</h1>
        </div>
    </div>
    <div class="flex justify-between items-center w-full mt-3">
        <div class="flex items-center gap-2 mb-3 text-gray-500">
            <x-icon name="heroicon-o-calendar" class="h-6 w-auto" />
            <span class="text-xs">{{ tanggal($post->created_at) }}</span>
        </div>
        <div class="flex items-center gap-2 mb-3 text-gray-500">
            <x-icon name="heroicon-o-eye" class="h-6 w-auto" />
            <span class="text-xs">{{ $post->visited ?? 0 }}</span>
        </div>
    </div>
</a>
