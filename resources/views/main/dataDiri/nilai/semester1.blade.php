<x-dashboard-layout title="Nilai Semester 1 — Warja">
    <section action="" method="post" class="lg:absolute lg:right-[2.7%] mt-25 lg:ml-[20%] lg:mt-20 lg:w-7/9 h-screen w-5/6 max-w-[86%] mx-auto rounded-sm mainMainContentDashboard transition-all duration-300 flex flex-col gap-5" enctype="multipart/form-data">
        <h1 class="font-poppins text-lg lg:text-xl font-bold">Nilai Semester 1</h1>
        <form method="post" action="{{ route('nilai', ['semester' => 1]) }}">
            @csrf
            {{-- Input Nilai Container --}}
            <section class="rounded-t-2xl p-4 bg-white w-full h-fit border-x-2 border-b-2 border-t-3 border-lightGray flex flex-col gap-2">
                
                <div class="w-full flex flex-col lg:flex-row items-center lg:items-end justify-between gap-2">
                       
                    <div class="w-full lg:w-1/2">
                        <label for="etikaProfesi" id="etikaProfesiLabel" class="font-bold text-gray-400 block">Etika Profesi</label>
                        <input name="etikaProfesi" id="etikaProfesi" type="number" step="0.01" class="bg-lightGray w-full text-darkGray py-2 pl-1 px-2 text-sm placeholder:text-gray-400" placeholder="80.00">
                        <p id="etikaProfesiErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                    </div>
                    
                    <div class="w-full lg:w-1/2">
                        <label for="kewarganegaraan" id="kewarganegaraanLabel" class="font-bold text-gray-400 block">Kewarganegaraan</label>
                        <input name="kewarganegaraan" id="kewarganegaraan" type="number" step="0.01" class="bg-lightGray w-full text-darkGray py-2 pl-1 px-2 text-sm placeholder:text-gray-400" placeholder="80.00">
                        <p id="kewarganegaraanErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                    </div>
                </div>
                
                <div class="w-full flex flex-col lg:flex-row items-center lg:items-end justify-between gap-2">    
                    
                    <div class="w-full lg:w-1/2">
                        <label for="bahasaIndonesia" id="bahasaIndonesiaLabel" class="font-bold text-gray-400 block">Bahasa Indonesia</label>
                        <input name="bahasaIndonesia" id="bahasaIndonesia" type="number" step="0.01" class="bg-lightGray w-full text-darkGray py-2 pl-1 px-2 text-sm placeholder:text-gray-400" placeholder="80.00">
                        <p id="bahasaIndonesiaErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                    </div>

                    <div class="w-full lg:w-1/2">
                        <label for="matematikaDiskrit1" id="matematikaDiskrit1Label" class="font-bold text-gray-400 block">Matematika Diskrit 1</label>
                        <input name="matematikaDiskrit1" id="matematikaDiskrit1" type="number" step="0.01" class="bg-lightGray w-full text-darkGray py-2 pl-1 px-2 text-sm placeholder:text-gray-400" placeholder="80.00">
                        <p id="matematikaDiskrit1ErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                    </div>
                </div>
                
                <div class="w-full flex flex-col lg:flex-row items-center lg:items-end justify-between gap-2">
                    
                    <div class="w-full lg:w-1/2">
                        <label for="statistikaDasar" id="statistikaDasarLabel" class="font-bold text-gray-400 block">Statistika Dasar</label>
                        <input name="statistikaDasar" id="statistikaDasar" type="number" step="0.01" class="bg-lightGray w-full text-darkGray py-2 pl-1 px-2 text-sm placeholder:text-gray-400" placeholder="80.00">
                        <p id="statistikaDasarErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                    </div>
                    
                    <div class="w-full lg:w-1/2">
                        <label for="algoritmaPemrograman" id="algoritmaPemrogramanLabel" class="font-bold text-gray-400 block">Algoritma dan Pemrograman</label>
                        <input name="algoritmaPemrograman" id="algoritmaPemrograman" type="number" step="0.01" class="bg-lightGray w-full text-darkGray py-2 pl-1 px-2 text-sm placeholder:text-gray-400" placeholder="80.00">
                        <p id="algoritmaPemrogramanErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                    </div>
                </div>
                
                <div class="w-full flex flex-col lg:flex-row items-center lg:items-end justify-between gap-2">
                    
                    <div class="w-full lg:w-1/2">
                        <label for="sistemDigital" id="sistemDigitalLabel" class="font-bold text-gray-400 block">Sistem Digital</label>
                        <input name="sistemDigital" id="sistemDigital" type="number" step="0.01" class="bg-lightGray w-full text-darkGray py-2 pl-1 px-2 text-sm placeholder:text-gray-400" placeholder="80.00">
                        <p id="sistemDigitalErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                    </div>
                    
                    <div class="w-full lg:w-1/2">
                        <label for="matematikaInformatika" id="matematikaInformatikaLabel" class="font-bold text-gray-400 block">Matematika Informatika</label>
                        <input name="matematikaInformatika" id="matematikaInformatika" type="number" step="0.01" class="bg-lightGray w-full text-darkGray py-2 pl-1 px-2 text-sm placeholder:text-gray-400" placeholder="80.00">
                        <p id="matematikaInformatikaErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                    </div>
                </div>
            </section> 
            
            {{-- Buttons container --}}
            <div class="px-4 rounded-b-2xl bg-white w-full h-auto border-x-2 border-b-2 border-lightGray flex flex-col lg:flex-row  items-center justify-center lg:justify-end gap-1 lg:gap-2">
                <div class="w-full lg:w-1/4 lg:h-30 flex flex-col lg:flex-row gap-2 pt-4 lg:justify-center lg:items-center lg:pt-0">
                    <button class="w-full lg:h-1/2 bg-red-100">Revert Changes</button>
                    <button class="w-full lg:h-1/2 bg-blue-100" type="submit">Next Form</button>
                </div>
            </div>
        </form>
    </section>
    @push('scripts')
        @vite('resources/js/errorAlert.js')
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
    @endpush
</x-dashboard-layout>