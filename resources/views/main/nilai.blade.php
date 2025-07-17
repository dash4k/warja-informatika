<x-dashboard-layout title="Nilai — Warja">
    <section class="lg:right-[2.7%] mt-25 lg:ml-[20%] lg:mt-20 lg:w-7/9 min-h-screen w-5/6 max-w-[86%] mx-auto rounded-sm mainMainContentDashboard transition-all duration-300 flex flex-col gap-5" enctype="multipart/form-data">
        @if ($nilai && ($nilai->admin_notes != null || $nilai->validated))
        <h1 class="font-poppins text-lg lg:text-xl font-bold">Validation</h1>
            <div class="flex flex-col items-start bg-white w-full p-4 rounded-2xl h-auto border-2 border-lightGray mb-2 gap-5">
                @if ($nilai && $nilai->admin_notes != null)
                    <div class="flex w-full border rounded-lg overflow-hidden mb-2">
                        <label class="font-bold bg-yellow-300 text-black p-2 flex items-center justify-center whitespace-nowrap">
                            Admin's Note
                        </label>
                        <p class="p-2 grow">
                            {{ $nilai->admin_notes }}
                        </p>
                    </div>
                @elseif ($nilai && $nilai->validated)
                    <div class="flex justify-between w-full rounded-lg">
                        <div class="flex w-auto overflow-hidden mb-2">
                            <label class="font-bold text-black p-2 flex items-center justify-center whitespace-nowrap">
                                Validated at:
                            </label>
                            <p class="p-2">
                                {{ $nilai->validated_at }}
                            </p>
                        </div>
                        <div class="flex w-auto border rounded-lg overflow-hidden mb-2">
                            <label class="font-bold bg-yellow-300 text-black p-2 flex items-center justify-center whitespace-nowrap">
                                Validated by:
                            </label>
                            <p class="p-2">
                                {{ $nilai->id_admin }}
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        @endif

        <h1 class="font-poppins text-lg lg:text-xl font-bold">Nilai Semester 1</h1>
        
        {{-- Input Nilai Container --}}
        <div class="rounded-2xl p-4 bg-white w-full h-fit border-x-2 border-y-3 py-6 border-lightGray flex flex-col gap-2">
            
            <div class="w-full flex flex-col lg:flex-row items-center lg:items-end justify-between gap-2">
                    
                <div class="w-full lg:w-1/2">
                    <label class="font-bold text-gray-400">Etika Profesi</label>
                    <div class="bg-lightGray rounded-md text-darkGray py-2 pl-1 text-sm">
                        {{ $nilai?->etika_profesi }}
                    </div>
                </div>
                
                <div class="w-full lg:w-1/2">
                    <label class="font-bold text-gray-400">Kewarganegaraan</label>
                    <div class="bg-lightGray rounded-md text-darkGray py-2 pl-1 text-sm">
                        {{ $nilai?->kewarganegaraan }}
                    </div>
                </div>
            </div>
            
            <div class="w-full flex flex-col lg:flex-row items-center lg:items-end justify-between gap-2">    
                
                <div class="w-full lg:w-1/2">
                    <label class="font-bold text-gray-400">Bahasa Indonesia</label>
                    <div class="bg-lightGray rounded-md text-darkGray py-2 pl-1 text-sm">
                        {{ $nilai?->bahasa_indonesia }}
                    </div>
                </div>
    
                <div class="w-full lg:w-1/2">
                    <label class="font-bold text-gray-400">Matematika Diskrit 1</label>
                    <div class="bg-lightGray rounded-md text-darkGray py-2 pl-1 text-sm">
                        {{ $nilai?->matematika_diskrit_1 }}
                    </div>
                </div>
            </div>
            
            <div class="w-full flex flex-col lg:flex-row items-center lg:items-end justify-between gap-2">
                
                <div class="w-full lg:w-1/2">
                    <label class="font-bold text-gray-400">Statistika Dasar</label>
                    <div class="bg-lightGray rounded-md text-darkGray py-2 pl-1 text-sm">
                        {{ $nilai?->statistika_dasar }}
                    </div>
                </div>
                
                <div class="w-full lg:w-1/2">
                    <label class="font-bold text-gray-400">Algoritma dan Pemrograman</label>
                    <div class="bg-lightGray rounded-md text-darkGray py-2 pl-1 text-sm">
                        {{ $nilai?->algoritma_pemrograman }}
                    </div>
                </div>
            </div>
            
            <div class="w-full flex flex-col lg:flex-row items-center lg:items-end justify-between gap-2">
                
                <div class="w-full lg:w-1/2">
                    <label class="font-bold text-gray-400">Sistem Digital</label>
                    <div class="bg-lightGray rounded-md text-darkGray py-2 pl-1 text-sm">
                        {{ $nilai?->sistem_digital }}
                    </div>
                </div>
                
                <div class="w-full lg:w-1/2">
                    <label class="font-bold text-gray-400">Matematika Informatika</label>
                    <div class="bg-lightGray rounded-md text-darkGray py-2 pl-1 text-sm">
                        {{ $nilai?->matematika_informatika }}
                    </div>
                </div>
            </div>
        </div> 
        <br>

        <h1 class="font-poppins text-lg lg:text-xl font-bold">Nilai Semester 2</h1>
        {{-- Input Nilai Container --}}
        <div class="rounded-2xl p-4 bg-white w-full h-fit border-x-2 border-y-3 py-6 border-lightGray flex flex-col gap-2">
            
            <div class="w-full flex flex-col lg:flex-row items-center lg:items-end justify-between gap-2">
                    
                <div class="w-full lg:w-1/2">
                    <label class="font-bold text-gray-400">Pancasila</label>
                    <div class="bg-lightGray rounded-md text-darkGray py-2 pl-1 text-sm">
                        {{ $nilai?->pancasila }}
                    </div>
                </div>
                
                <div class="w-full lg:w-1/2">
                    <label class="font-bold text-gray-400">Pendidikan Agama</label>
                    <div class="bg-lightGray rounded-md text-darkGray py-2 pl-1 text-sm">
                        {{ $nilai?->pendidikan_agama }}
                    </div>
                </div>
            </div>
            
            <div class="w-full flex flex-col lg:flex-row items-center lg:items-end justify-between gap-2">    
                
                <div class="w-full lg:w-1/2">
                    <label class="font-bold text-gray-400">Matematika Diskrit 2</label>
                    <div class="bg-lightGray rounded-md text-darkGray py-2 pl-1 text-sm">
                        {{ $nilai?->matematika_diskrit_2 }}
                    </div>
                </div>

                <div class="w-full lg:w-1/2">
                    <label class="font-bold text-gray-400">Pengantar Probabilitas</label>
                    <div class="bg-lightGray rounded-md text-darkGray py-2 pl-1 text-sm">
                        {{ $nilai?->pengantar_probabilitas }}
                    </div>
                </div>
            </div>
            
            <div class="w-full flex flex-col lg:flex-row items-center lg:items-end justify-between gap-2">
                
                <div class="w-full lg:w-1/2">
                    <label class="font-bold text-gray-400">Kewirausahaan</label>
                    <div class="bg-lightGray rounded-md text-darkGray py-2 pl-1 text-sm">
                        {{ $nilai?->kewirausahaan }}
                    </div>
                </div>
                
                <div class="w-full lg:w-1/2">
                    <label class="font-bold text-gray-400">Tata Tulis Karya Ilmiah</label>
                    <div class="bg-lightGray rounded-md text-darkGray py-2 pl-1 text-sm">
                        {{ $nilai?->tata_tulis_karya_ilmiah }}
                    </div>
                </div>
            </div>
            
            <div class="w-full flex flex-col lg:flex-row items-center lg:items-end justify-between gap-2">
                
                <div class="w-full lg:w-1/2">
                    <label class="font-bold text-gray-400">Struktur Data</label>
                    <div class="bg-lightGray rounded-md text-darkGray py-2 pl-1 text-sm">
                        {{ $nilai?->struktur_data }}
                    </div>
                </div>
                
                <div class="w-full lg:w-1/2">
                    <label class="font-bold text-gray-400">Sistem Operasi</label>
                    <div class="bg-lightGray rounded-md text-darkGray py-2 pl-1 text-sm">
                        {{ $nilai?->sistem_operasi }}
                    </div>
                </div>
            </div>
            
            <div class="w-full flex flex-col lg:flex-row items-center lg:items-end justify-between lg:justify-end gap-2">
                
                <div class="w-full lg:w-1/2">
                    <label class="font-bold text-gray-400">Organisasi dan Arsitektur Komputer</label>
                    <div class="bg-lightGray rounded-md text-darkGray py-2 pl-1 text-sm">
                        {{ $nilai?->organisasi_arsitektur_komputer }}
                    </div>
                </div>
            </div>
        </div>
        <br>

        <h1 class="font-poppins text-lg lg:text-xl font-bold">Nilai Semester 3</h1>
        {{-- Input Nilai Container --}}
        <div class="rounded-2xl p-4 bg-white w-full h-fit border-x-2 border-y-3 py-6 border-lightGray flex flex-col gap-2">
            
            <div class="w-full flex flex-col lg:flex-row items-center lg:items-end justify-between gap-2">
                    
                <div class="w-full lg:w-1/2">
                    <label class="font-bold text-gray-400">Interaksi Manusia dan Komputer</label>
                    <div class="bg-lightGray rounded-md text-darkGray py-2 pl-1 text-sm">
                        {{ $nilai?->interaksi_manusia_komputer }}
                    </div>
                </div>
                
                <div class="w-full lg:w-1/2">
                    <label class="font-bold text-gray-400">Basis Data</label>
                    <div class="bg-lightGray rounded-md text-darkGray py-2 pl-1 text-sm">
                        {{ $nilai?->basis_data }}
                    </div>
                </div>
            </div>
            
            <div class="w-full flex flex-col lg:flex-row items-center lg:items-end justify-between gap-2">    
                
                <div class="w-full lg:w-1/2">
                    <label class="font-bold text-gray-400">Desain dan Analisis Algoritma</label>
                    <div class="bg-lightGray rounded-md text-darkGray py-2 pl-1 text-sm">
                        {{ $nilai?->desain_analisis_algoritma }}
                    </div>
                </div>
    
                <div class="w-full lg:w-1/2">
                    <label class="font-bold text-gray-400">Rekayasa Perangkat Lunak</label>
                    <div class="bg-lightGray rounded-md text-darkGray py-2 pl-1 text-sm">
                        {{ $nilai?->rekayasa_perangkat_lunak }}
                    </div>
                </div>
            </div>
            
            <div class="w-full flex flex-col lg:flex-row items-center lg:items-end justify-between gap-2">
                
                <div class="w-full lg:w-1/2">
                    <label class="font-bold text-gray-400">Pemrograman Berbasis Obyek</label>
                    <div class="bg-lightGray rounded-md text-darkGray py-2 pl-1 text-sm">
                        {{ $nilai?->pemrograman_berbasis_obyek }}
                    </div>
                </div>
                
                <div class="w-full lg:w-1/2">
                    <label class="font-bold text-gray-400">Komunikasi Data dan Jaringan Komputer</label>
                    <div class="bg-lightGray rounded-md text-darkGray py-2 pl-1 text-sm">
                        {{ $nilai?->komunikasi_data_jaringan_komputer }}
                    </div>
                </div>
            </div>
            
            <div class="w-full flex flex-col lg:flex-row items-center lg:items-end justify-between lg:justify-end gap-2">
                
                <div class="w-full lg:w-1/2">
                    <label class="font-bold text-gray-400">Teori Bahasa dan Otomata</label>
                    <div class="bg-lightGray rounded-md text-darkGray py-2 pl-1 text-sm">
                        {{ $nilai?->teori_bahasa_otomata }}
                    </div>
                </div>
            </div>
        </div>
        <br>
    
        <h1 class="font-poppins text-lg lg:text-xl font-bold">Transkrip Sementara</h1>
        <div class="h-[50dvh] w-full lg:min-h-[100dvh] border-4 border-lightGray bg-darkGray">
            @if ($nilai && $nilai->transkrip_sementara)
                <iframe 
                    src="{{ asset('storage/' . $nilai->transkrip_sementara) }}" 
                    class="w-full h-full" 
                    frameborder="0"
                ></iframe>
            @else
                <p class="text-white text-center p-4">No PDF available</p>
            @endif

        </div>  
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