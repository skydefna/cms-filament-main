@php
    /**@var \App\Models\Contact $contact*/
    $url = $contact->value;
    if (\Illuminate\Support\Str::startsWith($contact->value, '0')){
        $contact->value = \Illuminate\Support\Str::replaceFirst('0', '+62', $contact->value);
    }
    if ($contact->type === \App\Enums\ContactTypes::Phone->value){
        $url = 'tel:'.$contact->value;
    }else if ($contact->type === \App\Enums\ContactTypes::Whatsapp->value){
        $url = 'https://wa.me/'.$contact->value;
    }else  if ($contact->type === \App\Enums\ContactTypes::Fax->value){
        $url = 'fax:'.$contact->value;
    }else  if ($contact->type === \App\Enums\ContactTypes::Mail->value){
        $url = 'mailto:'.$contact->value;
    }
@endphp
<a href="{{$url}}"
        @class(['flex gap-4 items-center text-sm transition duration-300 hover:text-secondary-700 font-semibold hover:scale-105 transition duration-300'])>
    @if($contact->type)
        <img
            @class(['h-[32px] w-auto aspect-square object-cover object-center'])
            alt="{{$contact->name}}"
            src="{{ asset('images/icons/'. $contact->type .'.png') }}"/>
    @endif
    <span>{{$contact->name}}</span>
</a>
