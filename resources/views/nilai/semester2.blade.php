<x-dashboard-layout title="Nilai Semester 2 — Warja">
    <section action="" method="post" class="lg:right-[2.7%] mt-25 lg:ml-[20%] lg:mt-20 lg:w-7/9 min-h-screen w-5/6 max-w-[86%] mx-auto rounded-sm mainMainContentDashboard transition-all duration-300 flex flex-col gap-5" enctype="multipart/form-data">
        <h1 class="font-poppins text-lg lg:text-xl font-bold">Nilai Semester 2</h1>
        <form method="post" action="{{ route('nilai', ['semester' => 2]) }}">
            @csrf
            {{-- Input Nilai Container --}}
            <section class="rounded-t-2xl p-4 bg-white w-full h-fit border-x-2 border-b-2 border-t-3 border-lightGray flex flex-col gap-2">
                
                <div class="w-full flex flex-col lg:flex-row items-center lg:items-end justify-between gap-2">
                       
                    <div class="w-full lg:w-1/3">
                        <label for="pancasila" id="pancasilaLabel" class="font-bold text-gray-400 block">Pancasila</label>
                        <input name="pancasila" id="pancasila" type="number" step="0.01" class="bg-lightGray w-full text-darkGray py-2 pl-1 px-2 text-sm placeholder:text-gray-400 rounded-md" placeholder="80.00">
                        <p id="pancasilaErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                    </div>
                    
                    <div class="w-full lg:w-1/3">
                        <label for="pendidikanAgama" id="pendidikanAgamaLabel" class="font-bold text-gray-400 block">Pendidikan Agama</label>
                        <input name="pendidikanAgama" id="pendidikanAgama" type="number" step="0.01" class="bg-lightGray w-full text-darkGray py-2 pl-1 px-2 text-sm placeholder:text-gray-400 rounded-md" placeholder="80.00">
                        <p id="pendidikanAgamaErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                    </div>

                    <div class="w-full lg:w-1/3">
                        <label for="matematikaDiskrit2" id="matematikaDiskrit2Label" class="font-bold text-gray-400 block">Matematika Diskrit 2</label>
                        <input name="matematikaDiskrit_2" id="matematikaDiskrit2" type="number" step="0.01" class="bg-lightGray w-full text-darkGray py-2 pl-1 px-2 text-sm placeholder:text-gray-400 rounded-md" placeholder="80.00">
                        <p id="matematikaDiskrit2ErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                    </div>
                </div>
                
                <div class="w-full flex flex-col lg:flex-row items-center lg:items-end justify-between gap-2">    
                    
                    <div class="w-full lg:w-1/3">
                        <label for="pengantarProbabilitas" id="pengantarProbabilitasLabel" class="font-bold text-gray-400 block">Pengantar Probabilitas</label>
                        <input name="pengantarProbabilitas" id="pengantarProbabilitas" type="number" step="0.01" class="bg-lightGray w-full text-darkGray py-2 pl-1 px-2 text-sm placeholder:text-gray-400 rounded-md" placeholder="80.00">
                        <p id="pengantarProbabilitasErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                    </div>

                    <div class="w-full lg:w-1/3">
                        <label for="kewirausahaan" id="kewirausahaanLabel" class="font-bold text-gray-400 block">Kewirausahaan</label>
                        <input name="kewirausahaan" id="kewirausahaan" type="number" step="0.01" class="bg-lightGray w-full text-darkGray py-2 pl-1 px-2 text-sm placeholder:text-gray-400 rounded-md" placeholder="80.00">
                        <p id="kewirausahaanErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                    </div>
                    
                    <div class="w-full lg:w-1/3">
                        <label for="tataTulisKaryaIlmiah" id="tataTulisKaryaIlmiahLabel" class="font-bold text-gray-400 block">Tata Tulis Karya Ilmiah</label>
                        <input name="tataTulisKaryaIlmiah" id="tataTulisKaryaIlmiah" type="number" step="0.01" class="bg-lightGray w-full text-darkGray py-2 pl-1 px-2 text-sm placeholder:text-gray-400 rounded-md" placeholder="80.00">
                        <p id="tataTulisKaryaIlmiahErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                    </div>
                </div>
                
                <div class="w-full flex flex-col lg:flex-row items-center lg:items-end justify-between gap-2">
                    
                    <div class="w-full lg:w-1/3">
                        <label for="strukturData" id="strukturDataLabel" class="font-bold text-gray-400 block">Struktur Data</label>
                        <input name="strukturData" id="strukturData" type="number" step="0.01" class="bg-lightGray w-full text-darkGray py-2 pl-1 px-2 text-sm placeholder:text-gray-400 rounded-md" placeholder="80.00">
                        <p id="strukturDataErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                    </div>
                    
                    <div class="w-full lg:w-1/3">
                        <label for="sistemOperasi" id="sistemOperasiLabel" class="font-bold text-gray-400 block">Sistem Operasi</label>
                        <input name="sistemOperasi" id="sistemOperasi" type="number" step="0.01" class="bg-lightGray w-full text-darkGray py-2 pl-1 px-2 text-sm placeholder:text-gray-400 rounded-md" placeholder="80.00">
                        <p id="sistemOperasiErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                    </div>

                    <div class="w-full lg:w-1/3">
                        <label for="organisasiArsitekturKomputer" id="organisasiArsitekturKomputerLabel" class="font-bold text-gray-400 block">Organisasi dan Arsitektur Komputer</label>
                        <input name="organisasiArsitekturKomputer" id="organisasiArsitekturKomputer" type="number" step="0.01" class="bg-lightGray w-full text-darkGray py-2 pl-1 px-2 text-sm placeholder:text-gray-400 rounded-md" placeholder="80.00">
                        <p id="organisasiArsitekturKomputerErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                    </div>
                </div>
            </section> 

            {{-- Buttons container --}}
            <div class="px-4 rounded-b-2xl bg-white w-full h-auto border-x-2 border-b-2 border-lightGray flex flex-col lg:flex-row  items-center justify-center lg:justify-end gap-1 lg:gap-2">
                <div class="w-full lg:w-1/4 lg:h-30 flex flex-col lg:flex-row gap-2 pt-4 lg:justify-center lg:items-center lg:pt-0">
                    <button class="w-full lg:h-1/2 bg-red-200 rounded-md hover:cursor-pointer hover:bg-red-100" type="reset">Revert Changes</button>
                    <button class="w-full lg:h-1/2 bg-blue-200 rounded-md hover:cursor-pointer hover:bg-blue-100" type="submit">Next Form</button>
                </div>
            </div>
        </form>
    </section>
    @push('scripts')
        @vite('resources/js/Alert.js')
    @endpush
    @push('scripts')
        @if ($errors->any() || session('error'))
            <script>
                window.laravelErrors = [];

                @if ($errors->any())
                    window.laravelErrors = @json($errors->all());
                @endif

                @if (session('error'))
                    window.laravelErrors.push(@json(session('error')));
                @endif
            </script>
        @endif
        @if (session('success'))
            <script>
                window.laravelSuccess = @json(session('success'));
            </script>
        @endif
    @endpush
</x-dashboard-layout>