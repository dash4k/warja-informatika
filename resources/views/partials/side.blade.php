{{-- Side Bar --}}
<aside id="sidebar" class="hidden sm:block lg:flex flex-col fixed top-18 lg:top-0 left-0 w-full lg:w-1/6 bg-white border-r-2 border-lightGray min-h-screen z-90 text-darkGray transition-all duration-300">

    {{-- Warja logo (desktop) --}}
    <a href="{{ route('/') }}" class="font-logo hidden lg:flex items-center p-2 justify-center mt-2">
        <span class="flex items-start text-xl font-black">
        <span id="logo-War" class="text-darkBlue">War</span><span id="logo-Ja" class="text-stroke-blue">Ja</span><span class="font-light text-stroke-blue font-poppins text-xs translate-y-[-0.2em]">&trade;</span>
        </span>
    </a>

    {{-- Menus container --}}
    <div class="flex flex-col items-center gap-2 mt-7 font-outfit transition-all duration-300">

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}" class="sideBarMenuAnchor p-5 w-4/5 h-5 text-sm flex gap-3 items-center rounded-xl @if (request()->routeIs('dashboard'))
            bg-blue-50
            text-blue-700
            @else
            hover:bg-lightGray
        @endif">
            <i class="fa-solid fa-house"></i>
            <h1 class="text-xs sideBarMenuLabel">Dashboard</h1>
        </a>

        {{-- Data diri --}}
        <a href="{{ route('datadiri') }}" class="sideBarMenuAnchor p-5 w-4/5 h-5 text-sm flex gap-3 items-center rounded-xl @if (request()->routeIs('datadiri'))
            bg-blue-50
            text-blue-700
            @else
            hover:bg-lightGray
        @endif">
            <i class="fa-solid fa-address-card"></i>
            <h1 class="text-xs sideBarMenuLabel">Data Diri</h1>
        </a>

        {{-- Berkas --}}
        <a href="{{ route('berkas') }}" class="sideBarMenuAnchor p-5 w-4/5 h-5 text-sm flex gap-3 items-center rounded-xl @if (request()->routeIs('berkas'))
            bg-blue-50
            text-blue-700
            @else
            hover:bg-lightGray
        @endif">
            <i class="fa-solid fa-folder-open"></i>
            <h1 class="text-xs sideBarMenuLabel">Berkas</h1>
        </a>

        {{-- Penjaluran --}}
        <a href="{{ route('penjaluran') }}" class="sideBarMenuAnchor p-5 w-4/5 h-5 text-sm flex gap-3 items-center rounded-xl @if (request()->routeIs('penjaluran'))
            bg-blue-50
            text-blue-700
            @else
            hover:bg-lightGray
        @endif">
            <i class="fa-solid fa-pencil"></i>
            <h1 class="text-xs sideBarMenuLabel">Penjaluran</h1>
        </a>
    </div>
</aside>