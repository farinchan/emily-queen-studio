    <!-- Search Overlay -->
    <div aria-hidden="true"
        class="fixed inset-0 z-[70] invisible flex items-center bg-white px-6 opacity-0 transition-all duration-500"
        id="searchOverlay">
        <button aria-label="Close search"
            class="absolute right-6 top-7 grid h-12 w-12 place-items-center border border-black/20 sm:right-10 sm:top-10"
            id="closeSearchButton" type="button">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.2" viewbox="0 0 24 24">
                <path d="M5 5l14 14M19 5 5 19"></path>
            </svg>
        </button>
        <div class="mx-auto w-full max-w-5xl">
            <p class="mb-7 text-[10px] uppercase tracking-[.35em] text-[#817a72]">Search our stories</p>
            <div class="flex items-center border-b border-black/30 pb-5">
                <input
                    class="w-full bg-transparent font-display text-4xl outline-none placeholder:text-black/25 sm:text-6xl lg:text-7xl"
                    id="searchInput" placeholder="Begin typing to search" type="search" />
                <svg class="h-7 w-7 shrink-0" fill="none" stroke="currentColor" stroke-width="1.2"
                    viewbox="0 0 24 24">
                    <circle cx="11" cy="11" r="7"></circle>
                    <path d="m20 20-4-4"></path>
                </svg>
            </div>
            <div class="mt-8 flex flex-wrap gap-x-8 gap-y-3 text-[10px] uppercase tracking-[.2em] text-[#817a72]">
                <span>Popular:</span>
                <button data-search="wedding">Wedding</button>
                <button data-search="prewedding">Prewedding</button>
                <button data-search="family">Family</button>
                <button data-search="portrait">Portrait</button>
            </div>
        </div>
    </div>
