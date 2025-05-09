<!-- Navbar -->
<nav class="sticky z-100 top-0 left-0 w-auto border-b-2 p-5 border-lightGray bg-paperWhite">
    <!-- Flex Container -->
    <div class="flex items-center justify-between">
        
    <!-- Logo -->
        <a href="{{ route('/') }}" class="font-logo ml-5">
            <span class="flex items-start text-xl font-black">
            <span class="text-darkBlue">War</span><span class="text-stroke-blue">Ja</span><span class="font-light text-stroke-blue font-poppins text-xs translate-y-[-0.2em]">&trade;</span>
            </span>
        </a>

        <!-- Menu Items Logged -->
        <div class="hidden md:flex ml-11 gap-2 space-x-3 font-poppins font-medium bg-white/60 backdrop-blur-md backdrop-saturate-150 border-b border-white/30 z-50 text-sm">
            <a href="" class="hover:text-darkBlue pt-1 pb-1 text-black p-1 px-4">
                Deskripsi
            </a>
            <a href="" class="hover:text-darkBlue pt-1 pb-1 text-black p-1 px-4">
                Statistik
            </a>
            <a href="" class="hover:text-darkBlue pt-1 pb-1 text-black p-1 px-4">
                Referensi
            </a>
        </div>
        <!-- Penjaluran Button -->
        
        <a @auth href="{{ route('dashboard') }}" @endauth @guest href="{{ route('register') }}" @endguest class="hidden md:block mr-5 p-1 px-4 text-sm bg-midBlue self-baseline rounded-md text-paperWhite font-poppins font-bold hover:bg-lightBlue">Mulai</a>
        
        {{-- Hamburger Button (mobile) --}}
        <div class="md:hidden">
            <button class="text-gray-700 focus:outline-none" id="hamburgerToggle">
                <i class="mr-5 fa-solid fa-bars"></i>
            </button>
        </div>
    </div>
    @push('scripts')
        @vite('resources/js/navbar.js')
    @endpush
</nav>

{{-- Hamburger Menu (Mobile) --}}
<div class="hidden fixed z-[100] top-[64px] left-0 w-full px-4 pt-4 pb-4 space-y-2 bg-white shadow-md flex flex-col justify-center items-center" id="hamburgerMenu">
    <a href="" class="block hover:text-darkBlue pt-1 pb-1 text-black p-1 px-1">
        Deskripsi
    </a>
    <a href="" class="block hover:text-darkBlue pt-1 pb-1 text-black p-1 px-1">
        Statistik
    </a>
    <a href="" class="block hover:text-darkBlue pt-1 pb-1 text-black p-1 px-1">
        Referensi
    </a>
    <a @auth href="{{ route('dashboard') }}" @endauth @guest href="{{ route('register') }}" @endguest class="block p-1 px-1 text-sm bg-midBlue w-full flex justify-center rounded-md text-paperWhite font-poppins font-bold hover:bg-lightBlue">Mulai</a>

</div>