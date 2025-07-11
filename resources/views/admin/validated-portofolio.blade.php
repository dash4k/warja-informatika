<x-admin-dashboard title="Unvalidated Portofolio">
    <section class="lg:right-[2.7%] mt-25 lg:ml-[20%] lg:mt-20 lg:w-7/9 min-h-screen lg:h-[75dvh] w-5/6 max-w-[86%] mx-auto rounded-sm mainMainContentDashboard transition-all duration-300 flex flex-col gap-5" enctype="multipart/form-data">
        <h1 class="font-poppins text-lg lg:text-xl font-bold">Portofolio Mahasiswa</h1>

        <div class="rounded-2xl p-4 bg-white w-full h-fit border-x-2 border-y-3 py-6 border-lightGray flex flex-col gap-2 relative overflow-x-auto sm:rounded-lg">
            <table class="table-auto w-full text-center border-collapse border border-blue-300 text-sm break-words">
                <thead class="bg-blue-100">
                    <tr>
                        <th class="border px-4 py-2">NIM</th>
                        <th class="border px-4 py-2">Nama</th>
                        <th class="border px-4 py-2">Portofolio</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mahasiswas as $m)
                        <tr class="portofolioRow" data-id="{{ $m->id }}">
                            <td class="border px-4 py-2 break-words max-w-[200px]">{{ $m->nim }}</td>
                            <td class="border px-4 py-2 break-words max-w-[200px] capitalize">{{ $m->nama }}</td>
                            <td class="border px-4 py-2 break-words max-w-[250px] capitalize">
                                <button type="button" class="showPortofolio bg-snowWhite hover:bg-black hover:text-snowWhite px-2 py-1 rounded hover:cursor-pointer transition-all duration-100" title="Portofolio"><i class="fa-solid fa-award"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
            <div id="portofolioContainer" class="fixed inset-0 bg-blue-200/30 backdrop-blur-sm z-100 flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300 ease-out w-full h-full pl-5 pr-5 lg:pl-0 lg:pr-0">
                <div class="bg-white p-6 rounded max-w-4xl w-full transform transition-all duration-300 ease-in-out shadow-lg shadow-blue-300/50">
                    <div class="flex flex-row justify-end items-center">
                        <button type="button" id="closePortofolio" class="rounded-full bg-red-300 text-white text-sm px-2 pt-1 hover:bg-red-100 hover:text-black hover:cursor-pointer transition-all duration-100">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="flex flex-col p-1 mb-2 font-black">
                        <p>NIM. <span id="nim"></span></p>
                    </div>
                    <div class="flex flex-row justify-between items-start w-full gap-5 mb-2 max-h-[400px] overflow-y-auto">
                        <table class="table-auto w-full p-1 text-center text-sm break-words">
                            <thead class="bg-blue-200 sticky top-0 z-10">
                                <tr>
                                    <th class="border font-bold text-center px-1 py-1">Nama</th>
                                    <th class="border font-bold text-center px-1 py-1">Tanggal</th>
                                    <th class="border font-bold text-center px-1 py-1">Tempat</th>
                                    <th class="border font-bold text-center px-1 py-1">Bobot</th>
                                    <th class="border font-bold text-center px-1 py-1">Jalur</th>
                                    <th class="border font-bold text-center px-1 py-1">Sertifikat</th>
                                </tr>
                            </thead>
                            <tbody id="portofolioList">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> 
        <div class="mt-4">
            {{ $mahasiswas->links() }}
        </div>
    </section>
    @push('scripts')
        @vite('resources/js/adminValidatedPortofolio.js')
        @vite('resources/js/Alert.js')
    @endpush
    @php
        $collection = $mahasiswas->getCollection();

        $portofoliosJsData = $collection->mapWithKeys(function ($m) {
            $list = $m->portofolio ?? collect();

            return [ $m->id => $list->map(function ($p) {
                return [
                    'id'             => $p->id_portofolio,
                    'nama'           => $p->nama_kegiatan,
                    'tanggal'        => $p->tanggal_mulai . ' s/d ' . $p->tanggal_berakhir,
                    'tempat'         => $p->tempat_kegiatan,
                    'bobot'          => $p->bobot,
                    'jalur'          => $p->jalur,
                    'sertifikat_url' => asset('storage/' . $p->bukti),
                    'nim' => $p->nim,
                ];
            })->values()->all() ]; 
        })->all();
    @endphp
    @push('scripts')
    <script>
        window.portofolios = @json($portofoliosJsData);
    </script>
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