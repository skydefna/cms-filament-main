@php
	$mapping = [
	    'default' => 'h-14 w-auto',
	    'sm' => 'h-12 w-auto',
	    'md' => 'h-18 w-auto',
	    'lg' => 'h-34 w-auto',
	    'xl' => 'h-42 w-auto',
	];
@endphp
<div class="flex w-auto grow items-center justify-center gap-2 min-w-[40px]">
	@if ($primary_logo)
		<img src="{{ $primary_logo }}" alt="logo tabalong" class="{{ $mapping[$size] }}" loading="lazy">
	@endif
	@if ($secondary_logo)
		<img src="{{ $secondary_logo }}" alt="logo dinas" class="{{ $mapping[$size] }}" loading="lazy">
	@endif
</div>
