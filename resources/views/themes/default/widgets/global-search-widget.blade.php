<div class="w-full flex justify-end">
    <form id="form-search" action="{{$urlAction}}" method="GET"
           class="flex grow flex-1 items-center transition-transform duration-300 ease-in-out w-full justify-end ml-auto">
        <input autocomplete="off" name="{{$name}}"
               id="keyword"
               value="{{ $errors->has($name) ? old($name) : request()->query($name) }}"
               class="bg-gray-50 rounded-full px-6 border-gray-100 border text-black text-xs
               placeholder:text-gray-300 placeholder:font-normal p-2
               transition duration-300 ease-in
               outline-none ring-0 focus:ring-0
               focus-within:outline-none focus-within:border-green-600 focus-within:border
                w-full max-w-sm
               "
               placeholder="{{$formPlaceHolder}}">
        <button type="submit"
                class="bg-green-600 hover:scale-110 transition duration-300 p-3 flex items-center justify-center border border-gray-100 rounded-full overflow-clip ml-3 shadow">
            <x-icon name="heroicon-o-magnifying-glass" class="h-4 w-auto text-white"/>
        </button>
    </form>

    @error($name)
    <p class="text-negative-500">{{$message}}</p>
    @enderror
</div>

@once
    @push('scripts')
        <script>
            const formSearch = document.querySelector('#form-search');
            let btnClearSearch = document.querySelector('#button-clear-search');
            if (btnClearSearch){
                btnClearSearch.addEventListener('click', function (e){
                    e.preventDefault();
                    window.location.href = formSearch.action;
                })
            }
        </script>
    @endpush
@endonce
