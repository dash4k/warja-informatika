<x-dashboard-layout title="Nilai Semester 3 — Warja">
    <section action="" method="post" class="lg:absolute lg:right-[2.7%] mt-25 lg:ml-[20%] lg:mt-20 lg:w-7/9 h-screen w-5/6 max-w-[86%] mx-auto rounded-sm mainMainContentDashboard transition-all duration-300 flex flex-col gap-5" enctype="multipart/form-data">
        <h1 class="font-poppins text-lg lg:text-xl font-bold">Nilai Semester 3</h1>
        <form method="post" action="{{ route('nilai', ['semester' => 3]) }}">
            @csrf
            {{-- Input Nilai Container --}}
            <section class="rounded-t-2xl p-4 bg-white w-full h-fit border-x-2 border-b-2 border-t-3 border-lightGray flex flex-col gap-2">
                
                <div class="w-full flex flex-col lg:flex-row items-center lg:items-end justify-between gap-2">
                       
                    <div class="w-full lg:w-1/2">
                        <label for="interaksiManusiaKomputer" id="interaksiManusiaKomputerLabel" class="font-bold text-gray-400 block">Interaksi Manusia dan Komputer</label>
                        <input name="interaksiManusiaKomputer" id="interaksiManusiaKomputer" type="number" step="0.01" class="bg-lightGray w-full text-darkGray py-2 pl-1 px-2 text-sm placeholder:text-gray-400" placeholder="80.00">
                        <p id="interaksiManusiaKomputerErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                    </div>
                    
                    <div class="w-full lg:w-1/2">
                        <label for="basisData" id="basisDataLabel" class="font-bold text-gray-400 block">Basis Data</label>
                        <input name="basisData" id="basisData" type="number" step="0.01" class="bg-lightGray w-full text-darkGray py-2 pl-1 px-2 text-sm placeholder:text-gray-400" placeholder="80.00">
                        <p id="basisDataErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                    </div>
                </div>
                
                <div class="w-full flex flex-col lg:flex-row items-center lg:items-end justify-between gap-2">    
                    
                    <div class="w-full lg:w-1/2">
                        <label for="desainAnalisisAlgoritma" id="desainAnalisisAlgoritmaLabel" class="font-bold text-gray-400 block">Desain dan Analisis Algoritma</label>
                        <input name="desainAnalisisAlgoritma" id="desainAnalisisAlgoritma" type="number" step="0.01" class="bg-lightGray w-full text-darkGray py-2 pl-1 px-2 text-sm placeholder:text-gray-400" placeholder="80.00">
                        <p id="desainAnalisisAlgoritmaErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                    </div>

                    <div class="w-full lg:w-1/2">
                        <label for="rekayasaPerangkatLunak" id="rekayasaPerangkatLunakLabel" class="font-bold text-gray-400 block">Rekayasa Perangkat Lunak</label>
                        <input name="rekayasaPerangkatLunak" id="rekayasaPerangkatLunak" type="number" step="0.01" class="bg-lightGray w-full text-darkGray py-2 pl-1 px-2 text-sm placeholder:text-gray-400" placeholder="80.00">
                        <p id="rekayasaPerangkatLunakErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                    </div>
                </div>
                
                <div class="w-full flex flex-col lg:flex-row items-center lg:items-end justify-between gap-2">
                    
                    <div class="w-full lg:w-1/2">
                        <label for="pemrogramanBerbasisObyek" id="pemrogramanBerbasisObyekLabel" class="font-bold text-gray-400 block">Pemrograman Berbasis Obyek</label>
                        <input name="pemrogramanBerbasisObyek" id="pemrogramanBerbasisObyek" type="number" step="0.01" class="bg-lightGray w-full text-darkGray py-2 pl-1 px-2 text-sm placeholder:text-gray-400" placeholder="80.00">
                        <p id="pemrogramanBerbasisObyekErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                    </div>
                    
                    <div class="w-full lg:w-1/2">
                        <label for="komunikasiDataJaringanKomputer" id="komunikasiDataJaringanKomputerLabel" class="font-bold text-gray-400 block">Komunikasi Data dan Jaringan Komputer</label>
                        <input name="komunikasiDataJaringanKomputer" id="komunikasiDataJaringanKomputer" type="number" step="0.01" class="bg-lightGray w-full text-darkGray py-2 pl-1 px-2 text-sm placeholder:text-gray-400" placeholder="80.00">
                        <p id="komunikasiDataJaringanKomputerErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                    </div>
                </div>
                
                <div class="w-full flex flex-col lg:flex-row items-center justify-between gap-2">
                    
                    <div class="w-full lg:w-full">
                        <label for="teoriBahasaOtomata" id="teoriBahasaOtomataLabel" class="font-bold text-gray-400 block">Teori Bahasa dan Otomata</label>
                        <input name="teoriBahasaOtomata" id="teoriBahasaOtomata" type="number" step="0.01" class="bg-lightGray w-full text-darkGray py-2 pl-1 px-2 text-sm placeholder:text-gray-400" placeholder="80.00">
                        <p id="teoriBahasaOtomataErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                    </div>
                </div>
            </section> 

            {{-- Buttons container --}}
            <div class="px-4 rounded-b-2xl bg-white w-full h-auto border-x-2 border-b-2 border-lightGray flex flex-col lg:flex-row  items-center justify-center lg:justify-end gap-1 lg:gap-2">
                <div class="w-full lg:w-1/4 lg:h-30 flex flex-col lg:flex-row gap-2 pt-4 lg:justify-center lg:items-center lg:pt-0">
                    <button class="w-full lg:h-1/2 bg-red-100" type="reset">Revert Changes</button>
                    <button class="w-full lg:h-1/2 bg-blue-100" type="submit">Next Form</button>
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