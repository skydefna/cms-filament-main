@php
    /**@var \App\Models\SocialMedia $socialMedia*/
@endphp
<a href="{{$socialMedia->url}}">
    <div @class(['flex gap-4 items-center text-sm transition duration-300 hover:text-secondary-700 font-semibold hover:scale-105 transition duration-300'])>
        @if($socialMedia->type)
            <img
                @class(['h-[32px] w-auto aspect-square object-cover object-center'])
                alt="{{$socialMedia->name}}"
                src="{{ asset('images/icons/'. $socialMedia->type .'.png') }}"/>
        @endif
        <span>{{$socialMedia->name}}</span>
    </div>
</a>
