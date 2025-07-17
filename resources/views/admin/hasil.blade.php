<x-admin-dashboard title="Hasil Penjaluran">
    <section class="lg:right-[2.7%] mt-25 lg:ml-[20%] lg:mt-20 lg:w-7/9 min-h-screen w-5/6 max-w-[86%] mx-auto rounded-sm mainMainContentDashboard transition-all duration-300 flex flex-col gap-5">
        <h1 class="font-poppins text-lg lg:text-xl font-bold">Hasil Penjaluran Angkatan {{ $angkatan }}</h1>

        <div class="rounded-2xl p-4 bg-white w-full h-fit border-x-2 border-y-3 py-6 border-lightGray flex flex-col gap-2 relative overflow-x-auto sm:rounded-lg">
            <div class="container mx-auto p-4">
                @foreach ($hasilPenjalurans as $jalur => $list)
                    <div class="mb-8">
                        <div class="w-full flex flex-row justify-end items-center">
                            <a href="{{ route('admin.penjaluran.download', substr($angkatan, -2)) }}" class="bg-red-500 text-white font-bold p-1 px-2 rounded hover:bg-red-600 text-lg self-end" title="Download PDF">
                                <i class="fa-solid fa-file-pdf"></i>
                            </a>
                        </div>
                        <h2 class="text-xl font-semibold mb-3 titlecase">Jalur {{ strtoupper($jalur) }}</h2>
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full border border-gray-300">
                                <thead class="bg-blue-100">
                                    <tr>
                                        <th class="px-4 py-2 border">No</th>
                                        <th class="px-4 py-2 border">NIM</th>
                                        <th class="px-4 py-2 border">Nama</th>
                                        <th class="px-4 py-2 border">Skor Akhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list as $index => $mhs)
                                        <tr class="text-center">
                                            <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                                            <td class="px-4 py-2 border">{{ $mhs->nim }}</td>
                                            <td class="px-4 py-2 border">{{ \App\Models\Mahasiswa::find($mhs->nim)?->nama ?? '-' }}</td>
                                            <td class="px-4 py-2 border">{{ number_format($mhs->skor_akhir, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
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
</x-admin-dashboard>
