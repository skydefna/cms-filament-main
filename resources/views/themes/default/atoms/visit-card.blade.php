<div class="relative border border-gray-50 border-collapse flex flex-col justify-center items-center px-3 py-6 rounded-0 transition duration-300"
>
    <h4 class="font-extrabold font-display text-3xl text-black hover:text-primary-500">
        {{number_format(num:$value, thousands_separator: '.')}}
    </h4>
    <h4 class="text-gray-500 text-sm font-sans font-semibold">{{$label}}</h4>
</div>
