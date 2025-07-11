<x-dashboard-layout title="Penjaluran — Warja">
    <section class="lg:right-[2.7%] mt-25 lg:ml-[20%] lg:mt-20 lg:w-7/9 min-h-screen w-5/6 max-w-[86%] mx-auto rounded-sm mainMainContentDashboard transition-all duration-300 flex flex-col gap-5" enctype="multipart/form-data">
        <h1 class="font-poppins text-lg lg:text-xl font-bold">Penjaluran</h1>
        
        <div class="rounded-2xl p-4 bg-white w-full h-fit border-x-2 border-y-3 py-6 border-lightGray flex flex-col gap-5 justify-between items-center">
            <h2 class="font-roboto text-lg lg:text-xl font-black text-white bg-midBlue p-2 px-4">SURVEY</h2>
            <p class="font-roboto w-1/2 text-center">Silahkan pilih jalur yang tertarik untuk Anda tekuni!</p>
            <form action="{{ route('survey.store') }}" method="post" class="flex items-center justify-center gap-0">
                @csrf
                <select id="jalur" name="jalur"
                    class="border-y border-l border-black px-4 py-2 bg-white h-[42px] rounded-l-md rounded-r-none focus:outline-none">
                    @foreach ($jalurs as $j)
                        <option value="{{ $j->id_jalur }}" class="text-center">{{ $j->id_jalur }} ({{ $j->nama }})</option>
                    @endforeach
                </select>
                <button id="submitButton" type="submit"
                    class="h-[42px] px-4 bg-green-600 hover:bg-green-300 hover:text-black hover:cursor-pointer text-white border-y border-r border-black rounded-r-md rounded-l-none">
                    Submit
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