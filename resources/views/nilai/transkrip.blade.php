<x-dashboard-layout title="Transkrip Nilai — Warja">
    <section class="lg:right-[2.7%] mt-25 lg:ml-[20%] lg:mt-20 lg:w-7/9 min-h-screen w-5/6 max-w-[86%] mx-auto rounded-sm mainMainContentDashboard transition-all duration-300 flex flex-col gap-5">
        <h1 class="font-poppins text-lg lg:text-xl font-bold">Transkrip Nilai</h1>
        <form method="post" action="{{ route('saveNilai') }}" enctype="multipart/form-data">
            @csrf
            {{-- Input Nilai Container --}}
            <section class="rounded-t-2xl p-4 bg-white w-full h-fit border-x-2 border-b-2 border-t-3 border-lightGray flex flex-col gap-2">
                                
                <div class="w-full flex flex-col lg:flex-row items-center lg:items-end justify-between gap-2">    
                    
                    <div class="w-full">
                        <div class="flex flex-col items-center justify-center w-full text-center">
                            <label for="transkrip" id="transkripLabel" class="flex flex-col items-center justify-center w-full lg:w-full h-30 lg:h-35 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6 px-4 gap-3">
                                    <i class="fa-solid fa-cloud-arrow-up text-gray-400"></i>
                                    <p class="hidden lg:block mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500">PDF (MAX. 2048 KB)</p>
                                </div>
                                <input id="transkrip" name="transkrip" type="file" class="hidden" />
                            </label>
                            <p id="transkripErrorMessage" class="text-red-500 mt-1 text-xs w-full text-start"></p>
                        </div>
                        <div class="w-full flex flex-col justify-start items-center max-h-[50dvh] lg:max-h-[100dvh] pt-5" id="pdfContainer">
                            <iframe id="pdfPreview" class="w-full h-[90vh] border-2 border-black hidden"></iframe>
                        </div>
                    </div>
                </div>
            </section> 
            
            {{-- Buttons container --}}
            <div class="px-4 rounded-b-2xl bg-white w-full h-auto border-x-2 border-b-2 border-lightGray flex flex-col lg:flex-row  items-center justify-center lg:justify-end gap-1 lg:gap-2">
                <div class="w-full lg:w-1/4 lg:h-30 flex flex-col lg:flex-row gap-2 pt-4 lg:justify-center lg:items-center lg:pt-0">
                    <button class="w-full lg:h-1/2 bg-red-200 rounded-md hover:cursor-pointer hover:bg-red-100" type="reset">Revert Changes</button>
                    <button class="w-full lg:h-1/2 bg-blue-200 rounded-md hover:cursor-pointer hover:bg-blue-100" type="submit">Submit</button>
                </div>
            </div>
        </form>
    </section>
    @push('scripts')
        @vite('resources/js/Alert.js')
        @vite('resources/js/transkrip.js')
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