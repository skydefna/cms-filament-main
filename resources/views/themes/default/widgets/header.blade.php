<div class="relative">
    <div id="placeholder" class="hidden"></div>

    <header id="header-nav" class="transition-all duration-300 z-50 bg-white leading-relaxed">

        <nav class="top-0 z-50 w-full flex flex-col py-2">
            <div class="w-full flex items-center justify-between container mx-auto">
                <div class="flex justify-center items-center w-full grow" id="kiri">
                    <x-app-logo size="sm" />
                    <x-app-name variant="default" />
                </div>
                <div class="w-full flex grow justify-end max-w-sm" id="kanan">
                    <div id="mobile-menu-button-trigger-container" class="block md:hidden right-0 ml-auto">
                        <button data-collapse-toggle="navbar-multi-level" type="button"
                            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                            aria-controls="navbar-multi-level" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                            </svg>
                        </button>
                    </div>
                    <div class="hidden md:flex grow justify-end">
                        <x-widgets.global-search-widget
                            action="{{ route('dokumen') }}" />
                    </div>
                </div>
            </div>
        </nav>

        <div class="flex items-center justify-center">
            <div id="navbar-multi-level"
                class="hidden w-full md:block md:w-auto py-1 grow mx-auto z-50 text-sm text-black tracking-tight shadow-xl bg-gradient-to-r from-amber-400 via-blue-300 to-orange-300 relative"
                style="padding: 20px 0 20px 0; font-size: 15px;">
                <ul
                    class="w-full flex flex-1 lg:items-center lg:justify-center grow flex-col font-medium md:p-0 mt-4 border-gray-100 rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 border-0 gap-4 p-3">
                    <x-menu :menu="$listMenu" />
                </ul>
            </div>
        </div>
    </header>
</div>

@push('scripts')
    <script>
        window.addEventListener("scroll", () => {
            const header = document.querySelector("#header-nav");
            const placeholder = document.getElementById("placeholder");
            const headerHeight = header.offsetHeight;

            const fixedClasses = [
                "md:w-full",
                "md:border-gray-100",
                "md:fixed",
                "md:top-0",
                "md:inset-x-0",
                "md:z-50",
                "shadow-xl",
            ];

            if (window.scrollY > 100) {
                placeholder.classList.remove("hidden");
                placeholder.style.height = `${headerHeight}px`;
                header.classList.add(...fixedClasses);
            } else {
                placeholder.classList.add("hidden");
                header.classList.remove(...fixedClasses);
            }
        });
    </script>
@endpush