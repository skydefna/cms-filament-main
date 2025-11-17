<div class="relative flex flex-col gap-4">
    <x-heading label="Kontak Kami"/>
    @if(count($contacts))
        <div class="grid grid-cols-1 gap-4">
            @foreach($contacts as $contact)
                <x-contact-card :contact="$contact"/>
            @endforeach
        </div>
    @else
        <p>Kosong...</p>
    @endif
</div>
