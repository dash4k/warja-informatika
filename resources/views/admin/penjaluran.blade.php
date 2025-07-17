<x-admin-dashboard title="Hasil Penjaluran">
    <section class="lg:right-[2.7%] mt-25 lg:ml-[20%] lg:mt-20 lg:w-7/9 min-h-screen w-5/6 max-w-[86%] mx-auto rounded-sm mainMainContentDashboard transition-all duration-300 flex flex-col gap-5" enctype="multipart/form-data">
        <h1 class="font-poppins text-lg lg:text-xl font-bold">Hasil Penjaluran</h1>

        <div class="rounded-2xl p-4 bg-white w-full h-fit border-x-2 border-y-3 py-6 border-lightGray flex flex-col gap-2 relative overflow-x-auto sm:rounded-lg">
            <div class="flex flex-col justify-center items-center lg:flex-row lg:justify-between lg:items-center gap-10">
                <table class="table-auto w-full text-center border-collapse border border-blue-300 text-sm break-words">
                    <caption class="text-left font-black mb-2">Jumlah Peminat</caption>
                    <thead class="">
                        <tr>
                            <th class="border px-4 py-2 bg-blue-100 text-left">Jalur</th>
                            <th class="border px-4 py-2">Jumlah</th>
                            <th class="border px-4 py-2">Preview</th>
                        </tr>
                    </thead>
                    @php
                        $jalurList = ['J1','J2','J3','J4','J5','J6','J7','J8','J9'];
                    @endphp

                    <tbody>
                        @foreach($jalurList as $jalur)
                            <tr class="soalRow"
                                data-jalur="{{ $jalur }}"
                                data-survey='@json($surveysPerJalur[$jalur] ?? [])'
                            >
                                <td class="border px-4 py-2 bg-blue-100 text-left">{{ $jalur }}</td>
                                <td class="border px-4 py-2">{{ $jumlahPerJalur[$jalur] ?? 0 }}</td>
                                <td class="border px-4 py-2">
                                    <button type="button"
                                            class="showButton bg-blue-300 hover:bg-blue-200 px-2 py-1 rounded hover:cursor-pointer"
                                            title="Preview">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @php
                    $totalSurvey = array_sum($jumlahPerJalur->toArray());
                @endphp

                @if ($totalSurvey > 0)
                    <div class="w-auto grow">
                        <h2 class="text-center font-black mb-2">Persebaran Peminatan</h2>
                        <canvas id="jalurPieChart"></canvas>
                    </div>
                @endif
            </div>
        </div>

        <h1 class="text-left font-black text-lg mt-4">Leaderboard Per Jalur</h1>
        <div class="rounded-2xl p-4 bg-white w-full h-fit border-x-2 border-y-3 py-6 border-lightGray flex flex-col gap-2 relative overflow-x-auto sm:rounded-lg">

            @foreach($jalurList as $jalur)
                @if(isset($leaderboards[$jalur]) && $leaderboards[$jalur]->count())
                    <div class="mb-6">
                        <h3 class="font-reguler text-black mb-2">Jalur {{ $jalur }}</h3>
                        <table class="table-auto w-full text-center border-collapse border border-green-300 text-sm overflow-y-scroll">
                            <thead>
                                <tr>
                                    <th class="border px-4 py-2 bg-blue-100">Peringkat</th>
                                    <th class="border px-4 py-2 bg-blue-100">NIM</th>
                                    <th class="border px-4 py-2 bg-blue-100">Nama</th>
                                    <th class="border px-4 py-2 bg-blue-100">Jawaban Benar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($leaderboards[$jalur] as $index => $mahasiswa)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $index + 1 }}</td>
                                        <td class="border px-4 py-2">{{ $mahasiswa->nim }}</td>
                                        <td class="border px-4 py-2">{{ $mahasiswa->nama }}</td>
                                        <td class="border px-4 py-2">{{ $mahasiswa->total_benar }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="mb-6">
                        <h3 class="font-reguler text-black mb-2">Jalur {{ $jalur }}</h3>
                        <p class="w-full text-center border-collapse border text-sm">Belum ada data untuk jalur ini.</p>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Modal -->
        <div id="previewModal" class="fixed inset-0 bg-blue-200/30 backdrop-blur-sm z-100 flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300 ease-out w-full h-full pl-5 pr-5 lg:pl-0 lg:pr-0">
            <div class="bg-white p-6 rounded max-w-5xl w-full max-h-[calc(100vh-4rem)]">
                <div class="flex flex-row justify-end items-center">
                    <button type="button" id="closeModal" class="rounded-full bg-red-300 text-white text-sm px-2 pt-1 hover:bg-red-100 hover:text-black hover:cursor-pointer transition-all duration-100">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <h3 class="text-lg font-bold mb-4" id="modalTitle">Daftar Responded</h3>
                <div class="overflow-y-auto max-h-[70vh] pr-2">
                    <table id="previewTable"></table>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            window.chartData = {
                labels: {!! json_encode(array_keys($jumlahPerJalur->toArray())) !!},
                data: {!! json_encode(array_values($jumlahPerJalur->toArray())) !!}
            };
        </script>
    @endpush
    @push('scripts')
        @vite('resources/js/adminPenjaluran.js')
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