<x-admin-dashboard title="Hasil Penjaluran">
    <section class="lg:right-[2.7%] mt-25 lg:ml-[20%] lg:mt-20 lg:w-7/9 min-h-screen w-5/6 max-w-[86%] mx-auto rounded-sm mainMainContentDashboard transition-all duration-300 flex flex-col gap-5" enctype="multipart/form-data">
        <h1 class="font-poppins text-lg lg:text-xl font-bold">Hasil Penjaluran</h1>

        <div class="rounded-2xl p-4 bg-white w-full h-fit border-x-2 border-y-3 py-6 border-lightGray flex flex-col gap-5 justify-between items-center">
            <h2 class="font-roboto text-lg lg:text-xl font-black text-white bg-midBlue p-2 px-4">Buat Penjaluran</h2>
            <p class="font-roboto w-1/2 text-center">Belum ada data penjaluran terakhir! Silahkan buat data penjaluran baru!</p>
            <form action="{{ route('admin.penjaluran.store') }}" method="post" class="flex items-center justify-center gap-0">
                @csrf
                <label for="tahun">Angkatan Penjaluran</label>
                <input type="text" name="tahun" id="tahun" placeholder="Tahun Penjaluran (YY): 23" class="bg-white border-2 w-full p-3 rounded-l-lg border-gray-200 @error('tahun') border-red-500 @enderror" value="{{ old('tahun') }}">
                <button id="submitButton" type="submit"
                    class="px-4 bg-green-600 hover:bg-green-300 hover:text-black hover:cursor-pointer text-white rounded-r-md border-2 border-gray-200">
                    Submit Penjaluran
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
</x-admin-dashboard>