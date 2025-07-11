<x-dashboard-layout title="Penjaluran — Warja">
    <section class="lg:right-[2.7%] mt-25 lg:ml-[20%] lg:mt-20 lg:w-7/9 min-h-screen w-5/6 max-w-[86%] mx-auto rounded-sm mainMainContentDashboard transition-all duration-300 flex flex-col gap-5" enctype="multipart/form-data">
        <div class="flex flex-row items-center justify-between">
            <h1 class="font-poppins text-lg lg:text-xl font-bold">Penjaluran</h1>
            <div id="exam-timer" 
                class="fixed top-20 right-7 z-50 bg-gray-300 p-2 rounded-lg"
                data-end="{{ $endDateTime->format('Y-m-d H:i:s') }}">
                <span id="countdown">Loading...</span>
            </div>
        </div>

        <div class="rounded-2xl p-4 bg-white w-full h-fit border-x-2 border-y-3 py-6 border-lightGray flex flex-col gap-4 justify-center items-center">
            <form method="POST" action="{{ route('penjaluran.exam.save') }}" class="w-full p-2">
                @csrf

                <input type="hidden" name="current_page" value="{{ request()->get('page', 1) }}">

                @foreach ($soals as $soalUjian)
                    <div class="mb-4 p-2 bg-gray-100">
                        <p class="mb-2 font-bold">{{ ($soals->currentPage() - 1) * $soals->perPage() + $loop->iteration }}. {{ $soalUjian->soal->pertanyaan }}</p>
                        
                        @php
                            $savedAnswer = $soalUjian->jawaban->jawaban ?? null;
                        @endphp

                        @foreach (['A', 'B', 'C', 'D'] as $option)
                            <div class="mt-1">
                                <label class="hover:cursor-pointer">
                                    <input type="radio" name="answers[{{ $soalUjian->id }}]" value="{{ $option }}"
                                        {{ $savedAnswer === $option ? 'checked' : '' }} class="hover:cursor-pointer"> {{ strtolower($option) }}.
                                    {{ $soalUjian->soal->pertanyaan }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                @endforeach

                <div class="flex @if ($soals->currentPage() > 1)
                    justify-between @else justify-end
                @endif mt-6">
                    @if ($soals->currentPage() > 1)
                        <button type="submit" name="action" value="previous" class="bg-gray-400 text-white px-4 py-2 rounded hover:cursor-pointer hover:bg-gray-200 hover:text-black transition-all duration-100">Previous</button>
                    @endif

                    @if ($soals->currentPage() < $soals->lastPage())
                        <button type="submit" name="action" value="next" class="bg-blue-500 text-white px-4 py-2 rounded hover:cursor-pointer hover:bg-blue-200 hover:text-black transition-all duration-100">Next</button>
                    @else
                        <button type="submit" name="action" value="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:cursor-pointer hover:bg-green-200 hover:text-black transition-all duration-100">Submit Exam</button>
                    @endif
                </div>
            </form>
        </div>
    </section>

    @push('scripts')
        @vite('resources/js/penjaluranExam.js')
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