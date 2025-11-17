@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Find all elements with data-cols attribute
            const gridElements = document.querySelectorAll('[data-cols]');

            gridElements.forEach(element => {
                const cols = element.getAttribute('data-cols');
                // Add base grid classes
                element.classList.add('grid', 'grid-cols-1', 'gap-4');

                // Add responsive columns based on data-cols value
                if (cols) {
                    element.classList.add(`md:grid-cols-${cols}`);
                }

                // Remove the inline grid-template-columns style if it exists
                element.style.removeProperty('grid-template-columns');
            });

            const buttonElements = document.querySelectorAll('[data-as-button="true"]');
            buttonElements.forEach(element => {
                element.classList.add('bg-primary-600', 'p-3', 'rounded', 'border-2', 'border-black', 'text-white', 'w-full');
            });
        });
    </script>
@endpush
