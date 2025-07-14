<x-dashboard-layout title="Penjaluran — Warja">
    <section class="lg:right-[2.7%] mt-25 lg:ml-[20%] lg:mt-20 lg:w-7/9 min-h-screen w-5/6 max-w-[86%] mx-auto rounded-sm mainMainContentDashboard transition-all duration-300 flex flex-col gap-5" enctype="multipart/form-data">
        <h1 class="font-poppins text-lg lg:text-xl font-bold">Penjaluran</h1>
        <div class="rounded-2xl p-4 bg-white w-full h-fit border-x-2 border-y-3 py-6 border-lightGray flex flex-col gap-2 justify-center items-center">
            <div class="flex flex-col justify-center items-center gap-2">
                <h2 class="font-roboto font-black bg-midBlue text-white p-2">SELAMAT!</h2>
                <p class="font-roboto w-1/2 text-center">Kamu telah sukses melaksanakan penjaluran di Program Studi Informatika Fakultas Matematika dan Ilmu Pengetahuan Alam Universitas Udayana</p>
                <div class="flex flex-col justify-center items-center gap-2 mt-4 w-[50%]">
                    <table class="table-auto w-full p-1 text-center text-sm break-words">
                        <caption class="font-roboto text-midBlue font-bold">Hasil Penjaluran Kamu</caption>
                        <tbody class="w-full">
                            <tr class="text-sm w-full">
                                <td class="border px-1 py-1 break-words bg-blue-200">Jalur</td>
                                <td class="border px-1 py-1" id="etikaProfesi">{{ $hasil->jalur->id_jalur . ' ' . $hasil->jalur->nama }}</td>
                            </tr>
                            <tr class="text-sm w-full">
                                <td class="border px-1 py-1 break-words bg-blue-200">Skor Akhir</td>
                                <td class="border px-1 py-1" id="etikaProfesi">{{ $hasil->skor_akhir }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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
</x-dashboard-layout>