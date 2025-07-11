<x-dashboard-layout title="Penjaluran — Warja">
    <section class="min-h-screen lg:ml-[20%] lg:w-4/5 w-11/12 mx-auto mt-24 flex flex-col gap-6 transition-all duration-300">
        
        <h1 class="text-xl font-bold text-gray-800">Penjaluran</h1>

        <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 w-full max-w-3xl mx-auto flex flex-col gap-3 items-center text-center">
            
            <h2 class="text-xl font-semibold text-blue-700">
                {{ $ujian->ujian->title ?? 'Judul tidak tersedia' }}
            </h2>

            <p class="text-gray-600 text-base">
                {{ $ujian->ujian->deskripsi ?? 'Deskripsi tidak tersedia' }}
            </p>

            <p class="text-sm text-gray-500">
                <strong>Tanggal Mulai:</strong> {{ \Carbon\Carbon::parse($ujian->ujian->tanggal_mulai)->format('d M Y') }}
            </p>

            <p class="text-sm text-gray-500">
                <strong>Waktu Mulai:</strong> {{ \Carbon\Carbon::parse($ujian->ujian->waktu_mulai)->format('H:i') }}
            </p>

            <p class="text-sm text-gray-500">
                <strong>Durasi Ujian:</strong> {{ $ujian->ujian->durasi_ujian ?? 'N/A' }} menit
            </p>

            <form action="{{ route('penjaluran.startExam') }}">
                <button id="submitButton" type="submit"
                    class="h-[42px] px-4 bg-green-600 hover:bg-green-300 hover:text-black hover:cursor-pointer text-white border border-black rounded-md">
                    Start
                </button>
            </form>

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