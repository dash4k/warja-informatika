<x-admin-dashboard title="Unvalidated Portofolio">
    <section class="lg:right-[2.7%] mt-25 lg:ml-[20%] lg:mt-20 lg:w-7/9 min-h-screen lg:h-[75dvh] w-5/6 max-w-[86%] mx-auto rounded-sm mainMainContentDashboard transition-all duration-300 flex flex-col gap-5" enctype="multipart/form-data">
        <h1 class="font-poppins text-lg lg:text-xl font-bold">Portofolio Mahasiswa</h1>

        <div class="rounded-2xl p-4 bg-white w-full h-fit border-x-2 border-y-3 py-6 border-lightGray flex flex-col gap-2 relative overflow-x-auto sm:rounded-lg">
            <table class="table-auto w-full text-center border-collapse border border-blue-300 text-sm break-words">
                <thead class="bg-blue-100">
                    <tr>
                        <th class="border px-4 py-2">ID Portofolio</th>
                        <th class="border px-4 py-2">NIM</th>
                        <th class="border px-4 py-2">Nama</th>
                        <th class="border px-4 py-2">Deskripsi</th>
                        {{-- <th class="border px-4 py-2">Sertifikat</th> --}}
                        <th class="border px-4 py-2">Notes</th>
                        <th class="border px-4 py-2">Validate</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($portofolios as $p)
                        <tr class="portofolioRow"
                            data-id-portofolio="{{ $p->id_portofolio }}"
                            data-nama="{{ $p->nama_kegiatan }}"
                            data-tanggal="{{ $p->tanggal_mulai . ' s/d ' . $p->tanggal_berakhir }}"
                            data-tempat="{{ $p->tempat_kegiatan }}"
                            data-bobot="{{ $p->bobot }}"
                            data-jalur="{{ $p->jalur }}"
                            data-sertifikat="{{ asset('storage/' . $p->bukti) }}"
                        >
                            <td class="border px-4 py-2 break-words max-w-[200px]">{{ $p->id_portofolio }}</td>
                            <td class="border px-4 py-2 break-words max-w-[200px]">{{ $p->mahasiswa->nim }}</td>
                            <td class="border px-4 py-2 break-words max-w-[200px] capitalize">{{ $p->mahasiswa->nama }}</td>
                            <td class="border px-4 py-2 break-words max-w-[250px] capitalize">
                                <button type="button" class="showDeskripsi bg-snowWhite hover:bg-black hover:text-snowWhite px-2 py-1 rounded hover:cursor-pointer transition-all duration-100" title="Deskripsi"><i class="fa-solid fa-award"></i></button>
                            </td>
                            {{-- <td class="border px-4 py-2">
                                <a href="{{ asset('storage/' . $p->bukti) }}" target="_blank" class="text-darkBlue hover:text-lightBlue hover:cursor-pointer transition-all duration-100" title="Sertifikat"><i class="fa-solid fa-link"></i></a>
                            </td> --}}
                            <td class="border px-4 py-2">
                                <form action="{{ route('admin.portofolio.update', $p->id_portofolio) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('PUT')

                                    <textarea 
                                        name="pesan"
                                        class="auto-resize w-full resize-none overflow-hidden bg-transparent border-none outline-none text-sm focus:ring-1 focus:ring-darkBlue p-2 overflow-y-auto"
                                        disabled
                                        oninput="autoResize(this)"
                                    >{{ $p->admin_notes }}</textarea>

                                    <div class="flex justify-end gap-1 items-center p-1">
                                        <button type="button" class="cancelEditButton bg-red-300 text-white text-sm px-4 py-1 rounded hover:bg-red-100 hover:text-black hover:cursor-pointer transition-all duration-100">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                        <button type="submit" class="bg-midBlue text-white text-sm px-4 py-1 rounded hover:bg-lightBlue hover:text-black hover:cursor-pointer transition-all duration-100">
                                            <i class="fa-solid fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </form>

                                <button type="button" class="editButton bg-yellow-300 text-black hover:text-yellow-300 hover:bg-black px-2 py-1 rounded hover:cursor-pointer transition-all duration-100" title="Catatan"><i class="fa-solid fa-pen-to-square"></i></button>
                            </td>
                            <td class="border px-4 py-2">
                                <form action="{{ route('admin.portofolio.validate', $p->id_portofolio) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="validateButton bg-midBlue hover:bg-lightBlue text-white hover:text-black px-2 py-1 rounded hover:cursor-pointer transition-all duration-100">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
            <div id="deskripsiContainer" class="fixed inset-0 bg-blue-200/30 backdrop-blur-sm z-100 flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300 ease-out w-full h-full pl-5 pr-5 lg:pl-0 lg:pr-0">
                <div class="bg-white p-6 rounded max-w-4xl w-full transform transition-all duration-300 ease-in-out shadow-lg shadow-blue-300/50">
                    <div class="flex flex-row justify-end items-center">
                        <button type="button" id="closeDeskripsi" class="rounded-full bg-red-300 text-white text-sm px-2 pt-1 hover:bg-red-100 hover:text-black hover:cursor-pointer transition-all duration-100">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="flex flex-col p-1 mb-2 font-black">
                        <p>Id Portofolio. <span id="idPortofolio"></span></p>
                    </div>
                    <div class="flex flex-row justify-between items-start w-full gap-5 mb-2">
                        <table class="table-auto w-full p-1 text-center text-sm break-words">
                            <thead class="bg-blue-200">
                                <tr>
                                    <th class="font-bold text-center border px-1 py-1">Nama</th>
                                    <th class="font-bold text-center border px-1 py-1">Tanggal</th>
                                    <th class="font-bold text-center border px-1 py-1">Tempat</th>
                                    <th class="font-bold text-center border px-1 py-1">Bobot</th>
                                    <th class="font-bold text-center border px-1 py-1">Jalur</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-sm">
                                    <td class="border px-1 py-1" id="nama"></td>
                                    <td class="border px-1 py-1" id="tanggal"></td>
                                    <td class="border px-1 py-1" id="tempat"></td>
                                    <td class="border px-1 py-1" id="bobot"></td>
                                    <td class="border px-1 py-1" id="jalur"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="w-full flex flex-col justify-start items-center max-h-[50dvh] pt-5" id="sertifikatContainer">
                        <iframe id="sertifikat" class="w-full h-[50vh] border-2 border-black"></iframe>
                    </div>
                </div>
            </div>
        </div> 
    </section>
    @push('scripts')
        @vite('resources/js/adminPortofolio.js')
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