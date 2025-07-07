<x-admin-dashboard title="Validated Nilai">
    <section class="lg:right-[2.7%] mt-25 lg:ml-[20%] lg:mt-20 lg:w-7/9 min-h-screen lg:h-[75dvh] w-5/6 max-w-[86%] mx-auto rounded-sm mainMainContentDashboard transition-all duration-300 flex flex-col gap-5" enctype="multipart/form-data">
        <h1 class="font-poppins text-lg lg:text-xl font-bold">Nilai Mahasiswa</h1>

        <div class="rounded-2xl p-4 bg-white w-full h-fit border-x-2 border-y-3 py-6 border-lightGray flex flex-col gap-2 relative overflow-x-auto sm:rounded-lg">
            <table class="table-auto w-full text-center border-collapse border border-blue-300 text-sm break-words">
                <thead class="bg-blue-100">
                    <tr>
                        <th class="border px-4 py-2">NIM</th>
                        <th class="border px-4 py-2">Nama</th>
                        <th class="border px-4 py-2">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($nilais as $n)
                        <tr class="nilaiRow"
                            data-nim="{{ $n->mahasiswa->nim }}"
                            data-etika-profesi="{{ $n->etika_profesi }}"
                            data-kewarganegaraan="{{ $n->kewarganegaraan }}"
                            data-bahasa-indonesia="{{ $n->bahasa_indonesia }}"
                            data-matematika-diskrit-1="{{ $n->matematika_diskrit_1 }}"
                            data-statistika-dasar="{{ $n->statistika_dasar }}"
                            data-algoritma-pemrograman="{{ $n->algoritma_pemrograman }}"
                            data-sistem-digital="{{ $n->sistem_digital }}"
                            data-matematika-informatika="{{ $n->matematika_informatika }}"
                            data-pancasila="{{ $n->pancasila }}"
                            data-pendidikan-agama="{{ $n->pendidikan_agama }}"
                            data-matematika-diskrit-2="{{ $n->matematika_diskrit_2 }}"
                            data-pengantar-probabilitas="{{ $n->pengantar_probabilitas }}"
                            data-kewirausahaan="{{ $n->kewirausahaan }}"
                            data-tata-tulis-karya-ilmiah="{{ $n->tata_tulis_karya_ilmiah }}"
                            data-struktur-data="{{ $n->struktur_data }}"
                            data-sistem-operasi="{{ $n->sistem_operasi }}"
                            data-organisasi-arsitektur-komputer="{{ $n->organisasi_arsitektur_komputer }}"
                            data-interaksi-manusia-komputer="{{ $n->interaksi_manusia_komputer }}"
                            data-basis-data="{{ $n->basis_data }}"
                            data-desain-analisis-algoritma="{{ $n->desain_analisis_algoritma }}"
                            data-rekayasa-perangkat-lunak="{{ $n->rekayasa_perangkat_lunak }}"
                            data-pemrograman-berorientasi-obyek="{{ $n->pemrograman_berorientasi_obyek }}"
                            data-komunikasi-data-jaringan-komputer="{{ $n->komunikasi_data_jaringan_komputer }}"
                            data-teori-bahasa-otomata="{{ $n->teori_bahasa_otomata }}"
                            data-transkrip="{{ asset('storage/' . $n->transkrip_sementara) }}"
                        >
                            <td class="border px-4 py-2 break-words max-w-[200px]">{{ $n->mahasiswa->nim }}</td>
                            <td class="border px-4 py-2 break-words max-w-[200px] capitalize">{{ $n->mahasiswa->nama }}</td>
                            <td class="border px-4 py-2 break-words max-w-[250px] capitalize">
                                <button type="button" class="showNilai bg-snowWhite hover:bg-black hover:text-snowWhite px-2 py-1 rounded hover:cursor-pointer transition-all duration-100" title="Nilai"><i class="fa-solid fa-graduation-cap"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
            <div id="nilaiContainer" class="fixed inset-0 bg-blue-200/30 backdrop-blur-sm z-100 flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300 ease-out w-full h-full pl-5 pr-5 lg:pl-0 lg:pr-0">
                <div class="bg-white p-6 rounded max-w-5xl w-full transform transition-all duration-300 ease-in-out">
                    <div class="flex flex-row justify-end items-center">
                        <button type="button" id="closeNilai" class="rounded-full bg-red-300 text-white text-sm px-2 pt-1 hover:bg-red-100 hover:text-black hover:cursor-pointer transition-all duration-100">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="flex flex-col p-1 mb-2 font-black">
                        <p>NIM. <span id="nim"></span></p>
                    </div>
                    <div class="flex flex-row justify-between items-start w-full gap-5">
                        <table class="table-auto w-full p-1 text-center text-sm break-words">
                            <caption class="text-left font-black mb-2">Semester 1</caption>
                            <thead>
                                <tr>
                                    <th class="font-bold text-center border px-1 py-1">Mata Kuliah</th>
                                    <th class="font-bold text-center border px-1 py-1">Nilai</th>
                                    <th class="font-bold text-center border px-1 py-1">Mata Kuliah</th>
                                    <th class="font-bold text-center border px-1 py-1">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-sm">
                                    <td class="border px-1 py-1 break-words max-w-[100px]">IF22102001</td>
                                    <td class="border px-1 py-1 bg-blue-200" id="etikaProfesi"></td>
                                    <td class="border px-1 py-1 break-words max-w-[100px]">IF22102002</td>
                                    <td class="border px-1 py-1 bg-blue-200" id="kewarganegaraan"></td>
                                </tr>
                                <tr class="text-sm">
                                    <td class="border px-1 py-1 break-words max-w-[100px]">IF22102003</td>
                                    <td class="border px-1 py-1 bg-blue-200" id="bahasaIndonesia"></td>
                                    <td class="border px-1 py-1 break-words max-w-[100px]">IF22102004</td>
                                    <td class="border px-1 py-1 bg-blue-200" id="matematikaDiskrit1"></td>
                                </tr>
                                <tr class="text-sm">
                                    <td class="border px-1 py-1 break-words max-w-[100px]">IF22102007</td>
                                    <td class="border px-1 py-1 bg-blue-200" id="statistikaDasar"></td>
                                    <td class="border px-1 py-1 break-words max-w-[100px]">IF22102106</td>
                                    <td class="border px-1 py-1 bg-blue-200" id="algoritmaPemrograman"></td>
                                </tr>
                                <tr class="text-sm">
                                    <td class="border px-1 py-1 break-words max-w-[100px]">IF22102108</td>
                                    <td class="border px-1 py-1 bg-blue-200" id="sistemDigital"></td>
                                    <td class="border px-1 py-1 break-words max-w-[100px]">IF22102005</td>
                                    <td class="border px-1 py-1 bg-blue-200" id="matematikaInformatika"></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table-auto w-full p-1 text-center text-sm break-words">
                            <caption class="text-left font-black mb-2">Semester 2</caption>
                            <thead>
                                <tr>
                                    <th class="font-bold text-center border px-1 py-1">Mata Kuliah</th>
                                    <th class="font-bold text-center border px-1 py-1">Nilai</th>
                                    <th class="font-bold text-center border px-1 py-1">Mata Kuliah</th>
                                    <th class="font-bold text-center border px-1 py-1">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-sm">
                                    <td class="border px-1 py-1 break-words max-w-[100px]">IF22202001</td>
                                    <td class="border px-1 py-1 bg-blue-200" id="pancasila"></td>
                                    <td class="border px-1 py-1 break-words max-w-[100px]">IF22202002</td>
                                    <td class="border px-1 py-1 bg-blue-200" id="pendidikanAgama"></td>
                                </tr>
                                <tr class="text-sm">
                                    <td class="border px-1 py-1 break-words max-w-[100px]">IF22202003</td>
                                    <td class="border px-1 py-1 bg-blue-200" id="matematikaDiskrit2"></td>
                                    <td class="border px-1 py-1 break-words max-w-[100px]">IF22202006</td>
                                    <td class="border px-1 py-1 bg-blue-200" id="pengantarProbabilitas"></td>
                                </tr>
                                <tr class="text-sm">
                                    <td class="border px-1 py-1 break-words max-w-[100px]">IF22202008</td>
                                    <td class="border px-1 py-1 bg-blue-200" id="kewirausahaan"></td>
                                    <td class="border px-1 py-1 break-words max-w-[100px]">IF22202009</td>
                                    <td class="border px-1 py-1 bg-blue-200" id="tataTulisKaryaIlmiah"></td>
                                </tr>
                                <tr class="text-sm">
                                    <td class="border px-1 py-1 break-words max-w-[100px]">IF22202104</td>
                                    <td class="border px-1 py-1 bg-blue-200" id="strukturData"></td>
                                    <td class="border px-1 py-1 break-words max-w-[100px]">IF22202105</td>
                                    <td class="border px-1 py-1 bg-blue-200" id="sistemOperasi"></td>
                                </tr>
                                <tr class="text-sm">
                                    <td></td>
                                    <td></td>
                                    <td class="border px-1 py-1 break-words max-w-[100px]">IF22203007</td>
                                    <td class="border px-1 py-1 bg-blue-200" id="organisasiArsitekturKomputer"></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table-auto w-full p-1 text-center text-sm break-words">
                            <caption class="text-left font-black mb-2">Semester 3</caption>
                            <thead>
                                <tr>
                                    <th class="font-bold text-center border px-1 py-1">Mata Kuliah</th>
                                    <th class="font-bold text-center border px-1 py-1">Nilai</th>
                                    <th class="font-bold text-center border px-1 py-1">Mata Kuliah</th>
                                    <th class="font-bold text-center border px-1 py-1">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-sm">
                                    <td class="border px-1 py-1 break-words max-w-[100px]">24SIFH16X014</td>
                                    <td class="border px-1 py-1 bg-blue-200" id="interaksiManusiaKomputer"></td>
                                    <td class="border px-1 py-1 break-words max-w-[100px]">24SIFH16X015</td>
                                    <td class="border px-1 py-1 bg-blue-200" id="basisData"></td>
                                </tr>
                                <tr class="text-sm">
                                    <td class="border px-1 py-1 break-words max-w-[100px]">24SIFH16X016</td>
                                    <td class="border px-1 py-1 bg-blue-200" id="desainAnalisisAlgoritma"></td>
                                    <td class="border px-1 py-1 break-words max-w-[100px]">24SIFH16X017</td>
                                    <td class="border px-1 py-1 bg-blue-200" id="rekayasaPerangkatLunak"></td>
                                </tr>
                                <tr class="text-sm">
                                    <td class="border px-1 py-1 break-words max-w-[100px]">24SIFH16X018</td>
                                    <td class="border px-1 py-1 bg-blue-200" id="pemrogramanBerorientasiObyek"></td>
                                    <td class="border px-1 py-1 break-words max-w-[100px]">24SIFH16X019</td>
                                    <td class="border px-1 py-1 bg-blue-200" id="komunikasiDataJaringanKomputer"></td>
                                </tr>
                                <tr class="text-sm">
                                    <td></td>
                                    <td></td>
                                    <td class="border px-1 py-1 break-words max-w-[100px]">24SIFH16X020</td>
                                    <td class="border px-1 py-1 bg-blue-200" id="teoriBahasaOtomata"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="w-full flex flex-col justify-start items-center max-h-[40dvh] pt-5" id="transkripContainer">
                        <iframe id="transkrip" class="w-full h-[40dvh] border-2 border-black"></iframe>
                    </div>
                </div>
            </div>
        </div> 
        <div class="mt-4">
            {{ $nilais->links() }}
        </div>
    </section>
    @push('scripts')
        @vite('resources/js/adminNilai.js')
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
</x-admin-dashboard>