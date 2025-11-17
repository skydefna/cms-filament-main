<div @class([
    "bg-black py-1 px-2 hover:scale-105 transition duration-300 w-full grow p-3",
    "rounded-xl" => $rounded,
])>
    <a href="{{$href}}" @class(["flex gap-4 w-full grow items-center justify-center p-3", 'items-center justify-center text-center' => $center])>
        <img class="h-6"
             src="{{$imageIcon}}"
             alt="download on playstore">
        <span class="text-white hover:text-amber-400 font-semibold text-sm">{{$label}}</span>
    </a>
</div>
