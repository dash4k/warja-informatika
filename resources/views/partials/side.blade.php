{{-- @php
    use App\Models\Nilai;
@endphp --}}
{{-- Side Bar --}}
<aside id="sidebar" class="hidden sm:block lg:flex flex-col fixed top-18 lg:top-0 left-0 w-full lg:w-1/6 bg-white border-r-2 border-lightGray min-h-screen z-90 text-darkGray transition-all duration-300">

    {{-- Warja logo (desktop) --}}
    <a href="{{ route('/') }}" class="font-logo hidden lg:flex items-center p-2 justify-center mt-2">
        <span class="flex items-start text-xl font-black">
        <span id="logo-War" class="text-darkBlue">War</span><span id="logo-Ja" class="text-stroke-blue">Ja</span><span class="font-light text-stroke-blue font-poppins text-xs translate-y-[-0.2em]">&trade;</span>
        </span>
    </a>

    {{-- Menus container --}}
    <div class="flex flex-col items-center gap-2 mt-7 font-outfit transition-all duration-300 font-roboto text-black">

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
        
        {{-- Biodata --}}
        <a href="{{ route('biodata') }}" class="sideBarMenuAnchor p-5 w-4/5 h-5 text-sm flex gap-3 items-center rounded-xl @if (request()->routeIs('biodata'))
            bg-blue-50
            text-blue-700
            @else
            hover:bg-lightGray
        @endif">
            <i class="fa-solid fa-address-card"></i>
            <h1 class="text-xs sideBarMenuLabel">Biodata</h1>
        </a>

        <button @if (auth()->user()->mahasiswa?->progress?->progress_umum < 1) disabled @endif id="resumeButton" class="sideBarMenuAnchor @if (auth()->user()->mahasiswa?->progress?->progress_umum < 1) pointer-events-none text-gray-400 @endif p-5 w-4/5 h-5 text-sm flex gap-3 items-center rounded-xl @if (request()->routeIs('portofolio') || request()->routeIs('nilai') || request()->routeIs('nilai.index') || request()->routeIs('transkrip'))
                bg-blue-50
                text-blue-700
                @else
                hover:bg-lightGray
            @endif">
            <i class="fa-solid fa-laptop-code"></i>
            <h1 class="text-xs sideBarMenuLabel">Resume</h1>
        </button>
        <div id="resumeContainer" class="w-4/5 flex flex-col items-end justify-center gap-2 transition-all duration-300 hidden">
                        
            {{-- Nilai --}}
            <a 
            @if (auth()->user()->mahasiswa?->progress?->progress_umum < 1)
                href=""
            @else
                @if (auth()->user()->mahasiswa?->progress?->progress_nilai === 5)
                    href="{{ route('nilai.index') }}"    
                @else
                    href="{{ route('nilai', auth()->user()->mahasiswa?->progress?->progress_nilai ?? 1) }}"    
                @endif
            @endif
            class="@if (auth()->user()->mahasiswa?->progress?->progress_umum < 1) pointer-events-none text-gray-400 @endif sideBarMenuAnchor p-5 w-4/5 h-5 text-sm flex gap-3 items-center rounded-xl @if (request()->routeIs('nilai') || request()->routeIs('nilai.index') || request()->routeIs('transkrip'))
                bg-blue-50
                text-blue-700
                @else
                hover:bg-lightGray
            @endif">
                <i class="fa-solid fa-graduation-cap"></i>
                <h1 class="text-xs sideBarMenuLabel">Nilai</h1>
            </a>

            {{-- Berkas --}}
            <a 
            @if (auth()->user()->mahasiswa?->progress?->progress_umum < 1)
                href=""
            @else
                href="{{ route('portofolio') }}" 
            @endif
                class="@if (auth()->user()->mahasiswa?->progress?->progress_umum < 1) pointer-events-none text-gray-400 @endif sideBarMenuAnchor p-5 w-4/5 h-5 text-sm flex gap-3 items-center rounded-xl @if (request()->routeIs('portofolio'))
                bg-blue-50
                text-blue-700
                @else
                hover:bg-lightGray
            @endif">
                <i class="fa-solid fa-award"></i>
                <h1 class="text-xs sideBarMenuLabel">Portofolio</h1>
            </a>
        </div>



        {{-- Penjaluran --}}
        <a 
        @if (auth()->user()->mahasiswa?->progress?->progress_umum < 2)
            href=""
        @else
            href="{{ route('penjaluran') }}"
        @endif class="@if (auth()->user()->mahasiswa?->progress?->progress_umum < 2) pointer-events-none text-gray-400 @endif sideBarMenuAnchor p-5 w-4/5 h-5 text-sm flex gap-3 items-center rounded-xl @if (request()->routeIs('penjaluran'))
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