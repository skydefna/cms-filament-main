@if ($announcement)
	<div class="flex overflow-hidden bg-black px-3 py-2 text-white text-sm" id="marquee">
		<small class="whitespace-nowrap px-3 font-semibold hover:underline">
			{{ $announcement }}
		</small>
	</div>
	@push('scripts')
		<script>
			// script.js
			function marqueeJs(selector, speed) {
				const parentSelector = document.querySelector(selector);
				const clone = parentSelector.innerHTML;
				const firstElement = parentSelector.children[0];
				let i = 0;
				parentSelector.insertAdjacentHTML('beforeend', clone);
				parentSelector.insertAdjacentHTML('beforeend', clone);

				setInterval(function() {
					firstElement.style.marginLeft = `-${i}px`;
					if (i > firstElement.clientWidth) {
						i = 0;
					}
					i = i + speed;
				}, 0);
			}
			//after window is completed load
			//1 class selector for marquee
			//2 marquee speed 0.2
			window.addEventListener('load', marqueeJs('#marquee', 0.1))
		</script>
	@endpush
@endif
