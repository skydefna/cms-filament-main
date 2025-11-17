@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            let data =  @json($nestedList);
            const options = {
                contentKey: 'data',
                width: '80vw',
                height: '{{ $height }}',
                enableToolbar:false,
                nodeWidth: {{ $nodeWidth }},
                nodeHeight: {{ $nodeHeight }},
                childrenSpacing: 70,
                siblingSpacing: 30,
                direction: 'top',
                canvasStyle: '',
                enableZoom: false,
                enablePan: false,
                pan: {
                    enabled: false // disables zooming entirely
                },
                zoom: {
                    enabled: false // disables zooming entirely
                },
                toolbar: {
                    show: false // hides zoom/pan/reset buttons
                },
                nodeTemplate: (content) => {
                    console.log(content);
                    return `
                        <div class="px-6 py-2 text-xs h-full text-center flex flex-col items-center justify-center border shadow">
                            <img alt="${content.name}" src="${content.image}" class="h-12 rounded-full mb-3"/>
                            <div class="text-xs text-gray-400 font-semibold block">${content.name}</div>
                            <div class="text-xs text-black font-semibold block">${content.title}</div>
                        </div>
                    `;
                },
            };

            const tree = new ApexTree(document.getElementById('chart-container'), options);
            const graph = tree.render(data);
        });
    </script>
@endpush

<div id="chart-container"></div>
