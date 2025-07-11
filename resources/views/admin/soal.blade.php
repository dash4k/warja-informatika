<x-admin-dashboard title="Soal Penjaluran">
    <section class="lg:right-[2.7%] mt-25 lg:ml-[20%] lg:mt-20 lg:w-7/9 min-h-screen w-5/6 max-w-[86%] mx-auto rounded-sm mainMainContentDashboard transition-all duration-300 flex flex-col gap-5" enctype="multipart/form-data">
        <h1 class="font-poppins text-lg lg:text-xl font-bold">Bank Soal Penjaluran</h1>

        <div class="w-full flex flex-row justify-end">
            <button id="addButton" class="w-auto px-4 py-2 bg-blue-200 rounded-md hover:cursor-pointer hover:bg-blue-100" title="Tambah Portofolio"><i class="fa-solid fa-plus"></i></button>
        </div>

        <div class="rounded-2xl p-4 bg-white w-full h-fit border-x-2 border-y-3 py-6 border-lightGray flex flex-col gap-2 relative overflow-x-auto sm:rounded-lg">
            <div class="flex flex-col justify-center items-center lg:flex-row lg:justify-between lg:items-center gap-10">
                <table class="table-auto w-full text-center border-collapse border border-blue-300 text-sm break-words">
                    <caption class="text-left font-black mb-2">Jumlah Soal</caption>
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
                                data-soals='@json($soalsPerJalur[$jalur] ?? [])'
                                data-delete-url="{{ route('admin.soal.destroy', '__id__') }}"
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
                    $totalSoal = array_sum($jumlahPerJalur->toArray());
                @endphp

                @if ($totalSoal > 0)
                    <div class="w-auto grow">
                        <h2 class="text-center font-black mb-2">Persebaran Soal</h2>
                        <canvas id="jalurPieChart"></canvas>
                    </div>
                @endif
            </div>
        </div>

        <!-- Modal -->
        <div id="previewModal" class="fixed inset-0 bg-blue-200/30 backdrop-blur-sm z-100 flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300 ease-out w-full h-full pl-5 pr-5 lg:pl-0 lg:pr-0">
            <div class="bg-white p-6 rounded max-w-5xl w-full h-auto">
                <div class="flex flex-row justify-end items-center">
                    <button type="button" id="closeModal" class="rounded-full bg-red-300 text-white text-sm px-2 pt-1 hover:bg-red-100 hover:text-black hover:cursor-pointer transition-all duration-100">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <h3 class="text-lg font-bold mb-4" id="modalTitle">Daftar Soal</h3>
                <div class="overflow-y-auto max-h-[70vh] pr-2">
                    <ul id="soalList" class="list-disc list-inside text-sm text-gray-800 space-y-5"></ul>
                </div>
            </div>
        </div>

        <div id="formContainer" class="fixed inset-0 bg-blue-200/30 backdrop-blur-sm z-100 flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300 ease-out w-full h-full pl-5 pr-5 lg:pl-0 lg:pr-0">
            <div class="bg-white p-6 rounded max-w-xl w-full max-h-[90vh] flex flex-col shadow-lg shadow-blue-300/50">
                    <form id="soalForm" 
                        class="flex flex-col gap-2 flex-grow min-h-0 overflow-y-auto" 
                        action="{{ route('admin.soal.store') }}" 
                        method="POST">
                    @csrf
                    <div class="mb-2 flex flex-row justify-center items-start gap-1">
                        <div class="w-6/8 lg:w-7/8">
                            <label for="pertanyaan" class="block mb-2 text-sm font-light text-gray-900">Pertanyaan</label>
                            <textarea id="pertanyaan" name="pertanyaan" placeholder="" class="border p-2 w-full rounded-md"></textarea>
                            <p id="pertanyaanErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                        </div>
                        <div class="w-2/8 lg:w-1/8">
                            <label for="jalur" class="block mb-2 text-sm font-light text-gray-900">Jalur</label>
                            <select id="jalur" name="jalur" class="border p-2 py-3 w-full rounded-md bg-white h-auto">
                            <option value="J1">J1</option>
                            <option value="J2">J2</option>
                            <option value="J3">J3</option>
                            <option value="J4">J4</option>
                            <option value="J5">J5</option>
                            <option value="J6">J6</option>
                            <option value="J7">J7</option>
                            <option value="J8">J8</option>
                            <option value="J9">J9</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-2 flex flex-col items-start justify-between w-full gap-2">
                        <h2 class="font-roboto text-sm">Pilihan Ganda</h2>
                        <div class="flex flex-row items-center justify-between w-full mb-2 gap-2">
                            <div class="w-1/2 flex flex-row">
                                <div class="flex items-center justify-center border px-3 rounded-l-md">
                                    <label for="a" class="block mb-2 text-sm font-light text-gray-900 mt-2">A</label>
                                </div>
                                <input type="text" id="a" name="a" placeholder="" class="border-y border-r p-2 w-full rounded-r-md">
                                <p id="aErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                            </div>
                            <div class="w-1/2 flex flex-row">
                                <div class="flex items-center justify-center border px-3 rounded-l-md">
                                    <label for="b" class="block mb-2 text-sm font-light text-gray-900 mt-2">B</label>
                                </div>
                                <input type="text" id="b" name="b" placeholder="" class="border-y border-r p-2 w-full rounded-r-md">
                                <p id="bErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                            </div>
                        </div>
                        <div class="flex flex-row items-center justify-between w-full mb-2 gap-2">
                            <div class="w-1/2 flex flex-row">
                                <div class="flex items-center justify-center border px-3 rounded-l-md">
                                    <label for="c" class="block mb-2 text-sm font-light text-gray-900 mt-2">C</label>
                                </div>
                                <input type="text" id="c" name="c" placeholder="" class="border-y border-r p-2 w-full rounded-r-md">
                                <p id="cErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                            </div>
                            <div class="w-1/2 flex flex-row">
                                <div class="flex items-center justify-center border px-3 rounded-l-md">
                                    <label for="d" class="block mb-2 text-sm font-light text-gray-900 mt-2">D</label>
                                </div>
                                <input type="text" id="d" name="d" placeholder="" class="border-y border-r p-2 w-full rounded-r-md">
                                <p id="dErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="jawaban" class="block mb-2 text-sm font-light text-gray-900">Jawaban</label>
                        <select id="jawaban" name="jawaban" class="border p-2 py-3 w-full rounded-md bg-white h-auto">
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        </select>
                    </div>
                    <div class="flex gap-2 justify-end">
                        <button id="cancelButton" type="button" onclick="hideForm()" class="px-4 py-2 bg-gray-300 hover:bg-gray-200 transition-all duration-100 rounded hover:cursor-pointer">Cancel</button>
                        <button id="submitButton" type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-300 hover:text-black transition-all duration-100 text-white rounded hover:cursor-pointer">Submit</button>
                    </div>
                </form>
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
        <script>
            window.storeSoalUrl = "{{ route('admin.soal.store') }}";
            window.updateSoalUrl = "{{ route('admin.soal.update', ['soal' => '__id__']) }}"; // Use a placeholder
        </script>
    @endpush
    @push('scripts')
        @vite('resources/js/adminSoal.js')
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