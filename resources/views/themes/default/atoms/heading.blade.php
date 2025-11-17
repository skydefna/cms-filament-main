<h4 @class([
	'font-extrabold tracking-tighter text-black relative z-10',
	'border-b-4 border-black' => $border,
    'text-lg lg:text-2xl' => $size === 'md',
    'text-xl lg:text-4xl' => $size === 'lg',
	$attributes->get('class'),
])>
	{!! $label !!}
</h4>
