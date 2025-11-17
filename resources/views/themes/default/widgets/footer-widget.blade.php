<x-pattern.grid>
	<div class="py-12">
		<div class="container mx-auto">
			<div class="grid grid-cols-1 gap-12 lg:grid-cols-3">
				<div class="flex flex-col gap-8">
					{{-- contact --}}
					<x-widgets.contact-widget />
					{{-- social medias --}}
					<x-widgets.social-medias-widget />
				</div>
				<div class="flex flex-col gap-8">
					{{-- visitor widget --}}
					<x-widgets.visitor-widget />
					{{-- banner-links --}}
					<x-widgets.banner-links-widget />
				</div>
				<div class="flex flex-col gap-8">
					{{-- address widget --}}
					<x-widgets.address-widget />
				</div>
			</div>
		</div>
	</div>
	<div class="h-[60px]"></div>
</x-pattern.grid>

<div class="bg-gradient-to-r from-zinc-900 to-gray-700 px-3 py-3">
	<div class="container mx-auto">
		<p class="text-center text-sm tracking-tighter font-normal text-white hover:text-primary-500">&copy;
			{{ config('app.version') ?? '0.1' }} - DISKOMINFO TABALONG</p>
	</div>
</div>
