@if (count($listGpr))
	<div class="bg-gray-900 py-20">
		<div class="container mx-auto">
			<div class="grid-cols-1 gap-4">
				<x-heading label="GPR Komdigi" class="text-white" />
				<div class="mt-3 grid grid-cols-1 gap-4 lg:grid-cols-2">
					@foreach ($listGpr as $gpr)
						<a href="{{ $gpr['link'] }}" class="hover:underline">
							<div class="gpr-title text-md mb-1 font-semibold text-white hover:text-secondary-500">{{ $gpr['title'] ?? '' }}
							</div>
							<div class="mt-1 flex justify-start gap-1">
								<div class="gpr-pubDate text-xs font-semibold text-gray-400">{{ $gpr['pubDate'] ?? '' }}</div>
							</div>
						</a>
					@endforeach
				</div>
			</div>
		</div>
	</div>
@endif
