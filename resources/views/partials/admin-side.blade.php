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
    <div class="flex flex-col items-center gap-2 mt-7 transition-all duration-300 font-roboto text-black overflow-y-auto h-auto">

        <button id="unvalidatedButton" class="sideBarMenuAnchor p-5 w-4/5 h-5 text-sm flex gap-3 items-center rounded-xl @if (request()->routeIs('admin.biodata.index') || request()->routeIs('admin.nilai.index') || request()->routeIs('admin.portofolio.index'))
            bg-blue-50
            text-blue-700
            @else
            hover:bg-lightGray
        @endif">
            <i class="fa-solid fa-square-xmark"></i>
            <h1 class="text-xs sideBarMenuLabel">Unvalidated</h1>
        </button>
        <div id="unvalidatedContainer" class="w-4/5 flex flex-col items-end justify-center gap-2 transition-all duration-300 hidden">
                        
            {{-- Biodata --}}
            <a 
            href="{{ route('admin.biodata.index') }}"
            class="sideBarMenuAnchor p-5 w-4/5 h-5 text-sm flex gap-3 items-center rounded-xl @if (request()->routeIs('admin.biodata.index'))
                bg-blue-50
                text-blue-700
                @else
                hover:bg-lightGray
            @endif">
                <i class="fa-solid fa-address-card"></i>
                <h1 class="text-xs sideBarMenuLabel">Biodata</h1>
            </a>
                        
            {{-- Nilai --}}
            <a 
            href="{{ route('admin.nilai.index') }}"
            class="sideBarMenuAnchor p-5 w-4/5 h-5 text-sm flex gap-3 items-center rounded-xl @if (request()->routeIs('admin.nilai.index'))
                bg-blue-50
                text-blue-700
                @else
                hover:bg-lightGray
            @endif">
                <i class="fa-solid fa-graduation-cap"></i>
                <h1 class="text-xs sideBarMenuLabel">Nilai</h1>
            </a>
                        
            {{-- Portofolio --}}
            <a 
            href="{{ route('admin.portofolio.index') }}"
            class="sideBarMenuAnchor p-5 w-4/5 h-5 text-sm flex gap-3 items-center rounded-xl @if (request()->routeIs('admin.portofolio.index'))
                bg-blue-50
                text-blue-700
                @else
                hover:bg-lightGray
            @endif">
                <i class="fa-solid fa-award"></i>
                <h1 class="text-xs sideBarMenuLabel">Portofolio</h1>
            </a>
        </div>
        
        <button id="validatedButton" class="sideBarMenuAnchor p-5 w-4/5 h-5 text-sm flex gap-3 items-center rounded-xl @if (request()->routeIs('admin.validated.biodata') || request()->routeIs('admin.validated.nilai') || request()->routeIs('admin.validated.portofolio'))
                bg-blue-50
                text-blue-700
                @else
                hover:bg-lightGray
            @endif">
            <i class="fa-solid fa-square-check"></i>
            <h1 class="text-xs sideBarMenuLabel">Validated</h1>
        </button>
        <div id="validatedContainer" class="w-4/5 flex flex-col items-end justify-center gap-2 transition-all duration-300 hidden">
                        
            {{-- Biodata --}}
            <a 
            href="{{ route('admin.validated.biodata') }}"
            class="sideBarMenuAnchor p-5 w-4/5 h-5 text-sm flex gap-3 items-center rounded-xl @if (request()->routeIs('admin.validated.biodata'))
                bg-blue-50
                text-blue-700
                @else
                hover:bg-lightGray
            @endif">
                <i class="fa-solid fa-address-card"></i>
                <h1 class="text-xs sideBarMenuLabel">Biodata</h1>
            </a>
                        
            {{-- Nilai --}}
            <a 
            href="{{ route('admin.validated.nilai') }}"
            class="sideBarMenuAnchor p-5 w-4/5 h-5 text-sm flex gap-3 items-center rounded-xl @if (request()->routeIs('admin.validated.nilai'))
                bg-blue-50
                text-blue-700
                @else
                hover:bg-lightGray
            @endif">
                <i class="fa-solid fa-graduation-cap"></i>
                <h1 class="text-xs sideBarMenuLabel">Nilai</h1>
            </a>
                        
            {{-- Portofolio --}}
            <a 
            href="{{ route('admin.validated.portofolio') }}"
            class="sideBarMenuAnchor p-5 w-4/5 h-5 text-sm flex gap-3 items-center rounded-xl @if (request()->routeIs('admin.validated.portofolio'))
                bg-blue-50
                text-blue-700
                @else
                hover:bg-lightGray
            @endif">
                <i class="fa-solid fa-award"></i>
                <h1 class="text-xs sideBarMenuLabel">Portofolio</h1>
            </a>
        </div>
        
        <button id="penjaluranButton" class="sideBarMenuAnchor p-5 w-4/5 h-5 text-sm flex gap-3 items-center rounded-xl @if(request()->routeIs('admin.soal.index') || request()->routeIs('admin.ujian.index') || request()->routeIs('admin.penjaluran.index'))
                bg-blue-50
                text-blue-700
                @else
                hover:bg-lightGray
            @endif">
            <i class="fa-solid fa-rocket"></i>
            <h1 class="text-xs sideBarMenuLabel">Penjaluran</h1>
        </button>
        <div id="penjaluranContainer" class="w-4/5 flex flex-col items-end justify-center gap-2 transition-all duration-300 hidden">
                        
            {{-- Soal --}}
            <a 
            href="{{ route('admin.soal.index') }}"
            class="sideBarMenuAnchor p-5 w-4/5 h-5 text-sm flex gap-3 items-center rounded-xl @if (request()->routeIs('admin.soal.index'))
                bg-blue-50
                text-blue-700
                @else
                hover:bg-lightGray
            @endif">
                <i class="fa-solid fa-clipboard-question"></i>
                <h1 class="text-xs sideBarMenuLabel">Soal</h1>
            </a>
                        
            {{-- Ujian --}}
            <a 
            href="{{ route('admin.ujian.index') }}"
            class="sideBarMenuAnchor p-5 w-4/5 h-5 text-sm flex gap-3 items-center rounded-xl @if (request()->routeIs('admin.ujian.index'))
                bg-blue-50
                text-blue-700
                @else
                hover:bg-lightGray
            @endif">
                <i class="fa-solid fa-user-graduate"></i>
                <h1 class="text-xs sideBarMenuLabel">Ujian</h1>
            </a>
                        
            {{-- Hasil --}}
            <a 
            href="{{ route('admin.penjaluran.showPenjaluran') }}"
            class="sideBarMenuAnchor p-5 w-4/5 h-5 text-sm flex gap-3 items-center rounded-xl @if (request()->routeIs('admin.penjaluran.showPenjaluran'))
                bg-blue-50
                text-blue-700
                @else
                hover:bg-lightGray
            @endif">
                <i class="fa-solid fa-square-poll-vertical"></i>
                <h1 class="text-xs sideBarMenuLabel">Penjaluran</h1>
            </a>
            
            <a 
            href="{{ route('admin.penjaluran.index') }}"
            class="sideBarMenuAnchor p-5 w-4/5 h-5 text-sm flex gap-3 items-center rounded-xl @if (request()->routeIs('admin.penjaluran.index'))
                bg-blue-50
                text-blue-700
                @else
                hover:bg-lightGray
            @endif">
                <i class="fa-brands fa-web-awesome"></i>
                <h1 class="text-xs sideBarMenuLabel">Hasil</h1>
            </a>
        </div>
    </div>
</aside>