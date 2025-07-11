<x-dashboard-layout title="Penjaluran — Warja">
    <section class="lg:right-[2.7%] mt-25 lg:ml-[20%] lg:mt-20 lg:w-7/9 min-h-screen w-5/6 max-w-[86%] mx-auto rounded-sm mainMainContentDashboard transition-all duration-300 flex flex-col gap-5" enctype="multipart/form-data">
        <h1 class="font-poppins text-lg lg:text-xl font-bold">Penjaluran</h1>
        
        <div class="rounded-2xl p-4 bg-white w-full h-fit border-x-2 border-y-3 py-6 border-lightGray flex flex-col gap-5 justify-between items-center">
            <h2 class="font-roboto text-lg lg:text-xl font-black text-white bg-midBlue p-2 px-4">PENGUMUMAN</h2>
            <p class="font-roboto w-1/2 text-center">Ujian akan segera dimulai! </br> Waktu tersisa sebelum ujian:</p>
            @php
                $start = \Carbon\Carbon::parse(
                    $ujian->ujian->tanggal_mulai->format('Y-m-d') . ' ' . $ujian->ujian->waktu_mulai->format('H:i:s')
                );
            @endphp

            <p id="countdown" class="p-2 bg-darkYellow text-white font-black w-1/8 text-center"
            data-start="{{ $start->toIso8601String() }}">
            </p>
            <p class="font-roboto w-1/2 text-center">Segera persiapkan diri Anda!</p>
        </div> 
    </section>
    @push('scripts')
        @vite('resources/js/ujianCountdown.js')
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