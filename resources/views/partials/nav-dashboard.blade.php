{{-- Penjaluran Navbar --}}
<nav class="fixed z-80 top-0 left-0 w-screen h-auto border-b-2 p-3 border-lightGray bg-white font-outfit">

    {{-- Container --}}
    <div class="flex flex-row justify-between items-center">

        {{-- Sidebar toggle button --}}
        <button class="ml-5 lg:ml-[18%] focus:outline-none hover:cursor-pointer transition-all duration-300" id="humburgerToggle">
            <i class="fa-solid fa-bars"></i>
        </button>

        {{-- Warja logo (mobile) --}}
        <a href="{{ route('/') }}" class="font-logo flex lg:hidden items-center p-2 justify-center">
            <span class="flex items-start text-xl font-black">
            <span class="text-darkBlue">War</span><span class="text-stroke-blue">Ja</span><span class="font-light text-stroke-blue font-poppins text-xs">&trade;</span>
            </span>
        </a>

        {{-- NIM/NPDN display --}}
        <div class="hidden lg:flex flex-row items-center justify-end gap-2">
            <h1 class="flex flex-row items-center text-sm lg:text-base font-outfit">{{ auth()->user()->id_user }}</h1>

            {{-- Drop down toggle (desktop) --}}
            <button class="text-gray-700 focus:outline-none hover:cursor-pointer" id="settingsToggle">
                <i class="mr-5 fa-solid fa-caret-down"></i>
            </button>
        </div>

        {{-- Drop down toggle (mobile) --}}
        <div class="lg:hidden">
            <button class="text-gray-700 focus:outline-none hover:cursor-pointer" id="settingsToggleMobile">
                <i class="fa-solid fa-ellipsis mr-5"></i>
            </button>
        </div>
    </div>
    
    @push('scripts')
        @vite('resources/js/navbar-dashboard.js')
        @vite('resources/js/sidebar.js')
    @endpush
</nav>

{{-- Dropdown menu (desktop) --}}
<div class="hidden fixed z-100 top-[60px] right-5 px-2 py-1 rounded-xl w-1/8 bg-white shadow-sm" id="settingsMenu">
    <form action="{{ route('logout') }}" method="post" class="w-full">
        @csrf

        {{-- Logout button --}}
        <button type="submit" class="w-full hover:cursor-pointer rounded-xl hover:bg-lightGray px-2 py-1">
            <div class="flex flex-row justify-evenly items-center">
                <h1 class="font-outfit text-sm font-bold">Logout</h1>
                <i class="fa-solid fa-right-from-bracket"></i>
            </div>
        </button>
    </form>
</div>

{{-- Dropdown menu (mobile) --}}
<div class="hidden fixed z-100 top-[60px] right-5 px-2 py-1 rounded-xl w-1/3 lg:w-1/8 bg-white shadow-sm" id="settingsMenuMobile">
    <div class="flex flex-col items-center justify-center">

        {{-- NIM/NPDN display --}}
        <h1 class="text-sm font-outfit">{{ auth()->user()->id_user }}</h1>
        <form action="{{ route('logout') }}" method="post" class="w-full">
            @csrf

            {{-- Logout button --}}
            <button type="submit" class="w-full hover:cursor-pointer rounded-xl hover:bg-lightGray px-2 py-1">
                <div class="flex flex-row justify-evenly items-center">
                    <h1 class="font-outfit text-sm font-bold">Logout</h1>
                    <i class="fa-solid fa-right-from-bracket"></i>
                </div>
            </button>
        </form>
    </div>
</div>