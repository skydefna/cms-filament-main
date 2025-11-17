<x-filament-tiptap-editor::button
    label="Iframe"
    active="iframe"
    action="insertIframe()"
    x-data="{
        insertIframe() {
            const src = prompt('Enter iframe URL:');
            if (src) {
                const width = prompt('Enter width:', '100%') || '100%';
                const height = prompt('Enter height:', '500') || '500';
                this.editor().commands.insertContent({
                    type: 'iframe',
                    attrs: { src: src, width: width, height: height }
                });
            }
        }
    }"
>
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M5 21q-.825 0-1.413-.588T3 19V5q0-.825.588-1.413T5 3h14q.825 0 1.413.588T21 5v14q0 .825-.588 1.413T19 21H5Zm0-2h14v-5H5v5Z"/></svg>

    <span class="sr-only">Iframe</span>
</x-filament-tiptap-editor::button>
