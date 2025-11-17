<div class="relative flex flex-col gap-4">
    <x-heading label="Sosial Media"/>
    @if(count($socialMedias))
        <div class="flex flex-col gap-4">
            @foreach($socialMedias as $socialMedia)
                <x-social-media-card :social-media="$socialMedia"/>
            @endforeach
        </div>
    @else
        <p>...</p>
    @endif
</div>
