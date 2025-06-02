{{-- Main Container --}}
<section class="lg:right-[2.7%] mt-25 lg:ml-[20%] lg:mt-20 lg:w-7/9 h-screen w-5/6 max-w-[86%] mx-auto rounded-sm mainMainContentDashboard transition-all duration-300 flex flex-col gap-5">
        
    {{-- Pengumuman dan Panduan header --}}
    <h1 class="font-poppins text-lg lg:text-xl font-bold">Pengumuman dan Panduan</h1>
    
    {{-- Pengumuman dan panduan main container --}}
    <div>

        {{-- Pengumuman dan panduan header --}}
        <div class="px-3 rounded-t-2xl bg-white w-full h-[10dvh] lg:h-[15dvh] border-x-2 border-t-2 border-lightGray flex flex-row  items-center justify-end">

            {{-- Toggle pengumuman dan panduan --}}
            <div class="rounded-md bg-lightGray w-3/4 lg:w-1/3 border-lightGray border-2 lg:border-3 flex flex-row items-center justify-between gap-2 font-roboto font-medium text-sm lg:text-base">

                {{-- Toggle pengumuman --}}
                <button id="togglePengumumanDashboard" class="rounded-md p-2 bg-white w-full text-darkBlue text-center hover:cursor-pointer transition-all duration-200">Pengumuman</button>

                {{-- Toggle panduan --}}
                <button id="togglePanduanDashboard" class="rounded-md p-2 w-full text-center hover:cursor-pointer transition-all duration-200">Panduan</button>
            </div>
        </div>

        {{-- Pengumuman dan panduan content container --}}
        <div class="rounded-b-2xl p-3 bg-white w-full h-[66dvh] border-x-2 border-b-2 border-t-3 border-lightGray flex flex-row">
            
        </div> 
    </div>
</section>