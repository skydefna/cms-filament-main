@props(['label', 'size' => 'md'])
<h4 {{$attributes->merge(['class' => 'font-extrabold font-display hover:underline'])}}>
    {!!$label!!}
</h4>
