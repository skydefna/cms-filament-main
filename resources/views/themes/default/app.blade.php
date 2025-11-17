<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <x-favicon/>
    <x-meta/>
    <x-layouts.parts.includes._fonts/>
    <x-layouts.parts.includes._libs/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body
    x-data="{
        showBar: false,
        atTop: false,
    }"
    @scroll.window="atTop = (window.pageYOffset < 50) ? false: true"
    class="text-gray-black text-sm font-body antialiased overflow-auto max-w-screen-4xl mx-auto bg-white"
>

{{$slot}}

@stack('scripts')

</body>
</html>
