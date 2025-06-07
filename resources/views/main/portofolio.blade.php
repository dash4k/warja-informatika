<x-dashboard-layout title="Portofolio — Warja">
    <section class="lg:right-[2.7%] mt-25 lg:ml-[20%] lg:mt-20 lg:w-7/9 min-h-screen w-5/6 max-w-[86%] mx-auto rounded-sm mainMainContentDashboard transition-all duration-300 flex flex-col gap-2" enctype="multipart/form-data">
        <h1 class="font-poppins text-lg lg:text-xl font-bold">Portofolio</h1>
        
        {{-- Input Nilai Container --}}
        <div class="w-full flex flex-row justify-end">
            <button id="addButton" class="w-auto px-4 py-2 bg-blue-200 rounded-md hover:cursor-pointer hover:bg-blue-100" title="Tambah Portofolio"><i class="fa-solid fa-plus"></i></button>
        </div>

        <div class="rounded-2xl p-4 bg-white w-full h-fit border-x-2 border-y-3 py-6 border-lightGray flex flex-col gap-2 relative overflow-x-auto sm:rounded-lg">
            <table class="table-auto w-full text-center border-collapse border border-blue-300 text-sm break-words">
                <thead class="bg-blue-100">
                    <tr>
                        <th class="border px-4 py-2 text-left">Nama</th>
                        <th class="border px-4 py-2">Tanggal</th>
                        <th class="border px-4 py-2">Tempat</th>
                        <th class="border px-4 py-2">Bukti</th>
                        <th class="border px-4 py-2">Bobot</th>
                        <th class="border px-4 py-2">Status</th>
                        <th class="border px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($portofolios as $p)
                        <tr class="portofolioRow"
                            data-id="{{ $p->id_portofolio }}"
                            data-nama="{{ $p->nama_kegiatan }}"
                            data-bobot="{{ $p->bobot }}"
                            data-mulai="{{ $p->tanggal_mulai }}"
                            data-berakhir="{{ $p->tanggal_berakhir }}"
                            data-tempat="{{ $p->tempat_kegiatan }}"
                        >
                            <td class="border px-4 py-2 text-left break-words max-w-[200px] capitalize">{{ $p->nama_kegiatan }}</td>
                            <td class="border px-4 py-2">{{ $p->tanggal_mulai }} — {{ $p->tanggal_berakhir }}</td>
                            <td class="border px-4 py-2 break-words max-w-[250px] capitalize">{{ $p->tempat_kegiatan }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ asset('storage/' . $p->bukti) }}" target="_blank" class="text-blue-600 hover:cursor-pointer" title="Attachment"><i class="fa-solid fa-link"></i></a>
                            </td>
                            <td class="border px-4 py-2">{{ $p->bobot }}</td>
                            @switch($p->status)
                                @case('accepted')
                                    <td class="border px-4 py-2"><i class="fa-solid fa-circle-check text-lg" title="Accepted"></i></td>
                                    @break
                                @case('rejected')
                                    <td class="border px-4 py-2"><i class="fa-solid fa-circle-xmark text-lg" title="Rejected"></i></td>
                                    @break
                                @default
                                    <td class="border px-4 py-2"><i class="fa-solid fa-clock text-lg" title="Pending"></i></td>
                            @endswitch
                            @switch($p->action)
                                @case('locked')
                                    <td class="border px-4 py-2"><i class="fa-solid fa-lock text-lg" title="Locked"></i></td>
                                    @break                                
                                @default
                                    <td class="border px-4 py-2"><button type="button" class="editButton bg-yellow-300 hover:bg-yellow-200 px-2 py-1 rounded hover:cursor-pointer" title="Edit"><i class="fa-solid fa-pen-to-square"></i></button></td>
                            @endswitch
                                {{-- <td class="border px-4 py-2 capitalize">{{ $p->action }}</td> --}}
                            </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">Belum ada portofolio</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div> 
 
        <div id="formContainer" class="fixed inset-0 bg-blue-200/30 backdrop-blur-sm z-100 flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300 ease-out w-full h-full pl-5 pr-5 lg:pl-0 lg:pr-0">
            <div class="bg-white p-6 rounded max-w-lg w-full transform transition-all duration-300 ease-in-out shadow-lg shadow-blue-300/50">
                <form id="portofolioForm" class="flex flex-col gap-2" action="{{ route('portofolio') }}" method="POST" enctype="multipart/form-data" data-default-action="{{ route('portofolio') }}">
                    @csrf
                    <div class="mb-2 flex flex-row justify-center items-start gap-1">
                        <div class="w-1/2">
                            <label for="namaKegiatan" class="block mb-2 text-sm font-light text-gray-900">Nama Kegiatan</label>
                            <input type="text" id="namaKegiatan" name="namaKegiatan" placeholder="" class="border p-2 w-full rounded-md">
                            <p id="namaKegiatanErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                        </div>
                        <div class="w-1/2">
                            <label for="bobot" class="block mb-2 text-sm font-light text-gray-900">Tingkat Kegiatan</label>
                            <select id="bobot" name="bobot" class="border p-2 py-3 w-full rounded-md bg-white h-auto">
                            <option value="1">Prodi</option>
                            <option value="3">Fakultas</option>
                            <option value="5">Universitas</option>
                            <option value="8">Nasional</option>
                            <option value="10">Internasional</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-2 flex flex-row justify-center items-start gap-1">
                        <div class="w-1/2 grow-0">
                            <label for="tanggalMulai" class="block mb-2 text-sm font-light text-gray-900">Tanggal Mulai</label>
                            <input type="date" id="tanggalMulai" name="tanggalMulai" placeholder="" class="border p-2 w-full rounded-md">
                            <p id="tanggalMulaiErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                        </div>
                        <div class="w-1/2 grow-0">
                            <label for="tanggalBerakhir" class="block mb-2 text-sm font-light text-gray-900">Tanggal Berakhir</label>
                            <input type="date" id="tanggalBerakhir" name="tanggalBerakhir" placeholder="" class="border p-2 w-full rounded-md">
                            <p id="tanggalBerakhirErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="tempatKegiatan" class="block mb-2 text-sm font-light text-gray-900">Tempat Kegiatan</label>
                        <input type="text" id="tempatKegiatan" name="tempatKegiatan" placeholder="" class="border p-2 w-full rounded-md">
                        <p id="tempatKegiatanErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                    </div>
                    <div class="mb-2">
                        <label for="bukti" class="block mb-2 text-sm font-light text-gray-900">Bukti/Sertifikat</label>
                        <input type="file" id="bukti" name="bukti" class="border p-2 w-full rounded-md">
                        <p class="mt-2 text-xs text-gray-500">PDF (MAX. 16 MB).</p>
                        <p id="buktiErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                    </div>
                    <div class="flex gap-2 justify-end">
                        <button id="cancelButton" type="button" onclick="hideForm()" class="px-4 py-2 bg-gray-300 hover:bg-gray-200 rounded">Cancel</button>
                        <button id="submitButton" type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-300 text-white rounded">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    @push('scripts')
    @vite('resources/js/portofolio.js')
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