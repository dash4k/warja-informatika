<x-admin-dashboard title="Soal Penjaluran">
    <section class="lg:right-[2.7%] mt-25 lg:ml-[20%] lg:mt-20 lg:w-7/9 min-h-screen w-5/6 max-w-[86%] mx-auto rounded-sm mainMainContentDashboard transition-all duration-300 flex flex-col gap-5" enctype="multipart/form-data">
        
        <div class="flex flex-row justify-between items-start">
            <h1 class="font-poppins text-lg lg:text-xl font-bold">Ujian Penjaluran</h1>
            <button id="addButton" class="w-auto px-4 py-2 bg-blue-200 rounded-md hover:cursor-pointer hover:bg-blue-100" title="Tambah Ujian"><i class="fa-solid fa-plus"></i></button>
        </div>
        <div class="rounded-2xl p-4 bg-white w-full h-fit border-x-2 border-y-3 py-6 border-lightGray flex flex-col gap-2 relative overflow-x-auto sm:rounded-lg">
            <div class="flex flex-col justify-center items-center lg:flex-row lg:justify-between lg:items-center gap-10 w-full">
                <table class="table-auto w-full text-center border-collapse border border-blue-300 text-sm break-words">
                    <thead class="bg-blue-100">
                        <tr>
                            <th class="border px-4 py-2 text-left">Title</th>
                            <th class="border px-4 py-2">Deskripsi</th>
                            <th class="border px-4 py-2">Durasi Ujian</th>
                            <th class="border px-4 py-2">Tanggal Mulai</th>
                            <th class="border px-4 py-2">Waktu Mulai</th>
                            <th class="border px-4 py-2">Status</th>
                            <th class="border px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ujians as $u)
                            <tr class="ujianRow"
                                data-id="{{ $u->id }}"
                                data-title="{{ $u->title }}"
                                data-deskripsi="{{ $u->deskripsi }}"
                                data-tanggal-mulai="{{ $u->tanggal_mulai->format('Y-m-d') }}"
                                data-waktu-mulai="{{ $u->waktu_mulai->format('H:i') }}"
                                data-durasi-ujian="{{ $u->durasi_ujian }}"
                            >
                                <td class="border px-4 py-2 break-words max-w-[200px] capitalize">{{ $u->title }}</td>
                                <td class="border px-4 py-2 break-words max-w-[200px] capitalize">{{ $u->deskripsi }}</td>
                                <td class="border px-4 py-2 break-words max-w-[200px] capitalize">{{ $u->durasi_ujian }}</td>
                                <td class="border px-4 py-2">{{ $u->tanggal_mulai->format('Y-m-d') }}</td>
                                <td class="border px-4 py-2">{{ $u->waktu_mulai->format('H:i') }}</td>
                                @if (now() < $u->waktu_mulai)
                                    <td class="border px-4 py-2">Belum Dimulai</td>
                                @elseif (now() >= $u->waktu_mulai && now() <= $u->waktu_mulai->addMinutes((int) ($u->durasi_ujian ?? 0)))
                                    <td class="border px-4 py-2">Berlangsung</td>
                                @else
                                    <td class="border px-4 py-2">Selesai</td>
                                @endif
                                <td class="border px-4 py-2 flex flex-col gap-2">
                                    <div>
                                        <button type="button" class="editButton bg-yellow-300 hover:bg-yellow-200 px-2 py-1 rounded hover:cursor-pointer" title="Edit Ujian"><i class="fa-solid fa-pen-to-square"></i></button>
                                    </div>
                                    <form action="{{ route('admin.ujian.destroy', $u->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="deleteUjianButton bg-red-300 hover:bg-red-200 px-2 py-1 rounded hover:cursor-pointer" title="Hapus Ujian"><i class="fa-solid fa-eraser"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div id="formContainer" class="fixed inset-0 bg-blue-200/30 backdrop-blur-sm z-100 flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300 ease-out w-full h-full pl-5 pr-5 lg:pl-0 lg:pr-0">
            <div class="bg-white p-6 rounded max-w-xl w-full max-h-[90vh] flex flex-col shadow-lg shadow-blue-300/50">
                <form id="ujianForm" 
                    class="flex flex-col gap-2 flex-grow min-h-0 overflow-y-auto" 
                    action="{{ route('admin.ujian.store') }}" 
                    data-default-action="{{ route('admin.ujian.store') }}"
                    method="POST">
                    @csrf
                    <div class="mb-2">
                        <label for="title" class="block mb-2 text-sm font-bold text-gray-900">Title</label>
                        <input type="text" id="title" name="title" placeholder="" class="border p-2 w-full rounded-md">
                        <p id="titleErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                    </div>
                    <div class="mb-2">
                        <label for="deskripsi" class="block mb-2 text-sm font-bold text-gray-900">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" placeholder="" class="border p-2 w-full rounded-md"></textarea>
                        <p id="deskripsiErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                    </div>
                    <div class="mb-2 flex flex-row items-center justify-between w-full gap-2">
                        <div class="w-1/2 grow">
                            <label for="tanggalMulai" class="block mb-2 text-sm font-bold text-gray-900">Tanggal Mulai</label>
                            <input type="date" id="tanggalMulai" name="tanggalMulai" placeholder="" class="border p-2 w-full rounded-md">
                            <p id="tanggalMulaiErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                        </div>
                        <div class="w-1/2">
                            <label for="waktuMulai" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Waktu/Durasi</label>
                            <div class="flex">
                                <input type="time" id="waktuMulai" name="waktuMulai" class="rounded-none rounded-s-lg bg-gray-50 border text-gray-900 leading-none block flex-1 w-full text-sm border-black p-2.5" min="06:00" max="18:00" value="09:00">
                                <input type="number" name="durasiUjian" id="durasiUjian" class="border-r border-y rounded-r-lg w-1/2 border-black hover:bg-gray-200 text-center transition-all duration-100">
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-2 justify-end">
                        <button id="cancelButton" type="button" onclick="hideForm()" class="px-4 py-2 bg-gray-300 hover:bg-gray-200 transition-all duration-100 rounded hover:cursor-pointer">Cancel</button>
                        <button id="submitButton" type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-300 hover:text-black transition-all duration-100 text-white rounded hover:cursor-pointer">Submit</button>
                    </div>
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold">Tambah Mahasiswa</label>
                        <div class="max-h-[200px] overflow-y-auto border rounded-md p-2">
                            @foreach ($mahasiswas as $m)
                                <div class="flex items-center gap-2 mb-1">
                                    <input type="checkbox" id="mahasiswa_{{ $m->nim }}" name="mahasiswas[]" value="{{ $m->nim }}">
                                    <label for="mahasiswa_{{ $m->nim }}">{{ $m->nim }} - {{ $m->nama }}</label>
                                </div>
                            @endforeach
                        </div>
                        <p id="mahasiswaErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                    </div>
                    <div class="mb-2" id="editMahasiswaContainer">
                        <label class="block mb-2 text-sm font-bold">Edit Mahasiswa</label>
                        <div class="max-h-[200px] overflow-y-auto border rounded-md p-2" id="editMahasiswa" data-ujian-mahasiswa='@json($ujians->keyBy("id")->map->ujianMahasiswa)'>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    @push('scripts')
        @vite('resources/js/adminUjian.js')
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