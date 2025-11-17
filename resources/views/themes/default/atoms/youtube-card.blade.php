@php
	/**@var \App\Models\YoutubeVideo $youtubeVideo*/
	// $imageUrl = \Illuminate\Support\Facades\Storage::disk('public')->url($youtubeVideo->thumbnail);
	$imageUrl = $youtubeVideo->thumbnail;
@endphp
<div class="h-full max-h-[420px] w-full">
	<div @class([
		'relative flex flex-col items-center justify-center overflow-hidden rounded-xl',
		'transition duration-300',
	])>
		<img src="{{ $imageUrl }}" alt="" class="h-full w-full object-cover object-center" loading="lazy" />
		<div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent"></div>
		<div class="absolute bottom-10 px-6 text-white">
			<a target="_blank" href="{!! $youtubeVideo->url !!}">
				<h1 class="leading-1 font-display text-sm font-bold leading-3 hover:underline lg:text-xl">
					{{ $youtubeVideo->title }}
				</h1>
			</a>
		</div>
	</div>
</div>
