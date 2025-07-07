<x-admin-dashboard title="Validated Biodata">
    <section class="lg:right-[2.7%] mt-25 lg:ml-[20%] lg:mt-20 lg:w-7/9 min-h-screen lg:h-[75dvh] w-5/6 max-w-[86%] mx-auto rounded-sm mainMainContentDashboard transition-all duration-300 flex flex-col gap-5" enctype="multipart/form-data">
        <h1 class="font-poppins text-lg lg:text-xl font-bold">Biodata Mahasiswa</h1>

        <div class="rounded-2xl p-4 bg-white w-full h-fit border-x-2 border-y-3 py-6 border-lightGray flex flex-col gap-2 relative overflow-x-auto sm:rounded-lg">
            <table class="table-auto w-full text-center border-collapse border border-blue-300 text-sm break-words">
                <thead class="bg-blue-100">
                    <tr>
                        <th class="border px-4 py-2">NIM</th>
                        <th class="border px-4 py-2">Nama</th>
                        <th class="border px-4 py-2">Kelas</th>
                        <th class="border px-4 py-2">Foto</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($biodatas as $b)
                        <tr class="biodataRow">
                            <td class="border px-4 py-2 break-words max-w-[200px]">{{ $b->nim }}</td>
                            <td class="border px-4 py-2 break-words max-w-[200px] capitalize">{{ $b->nama }}</td>
                            <td class="border px-4 py-2 break-words max-w-[250px] capitalize">{{ $b->kelas }}</td>
                            <td class="border px-4 py-2 flex flex-row justify-center items-center">
                                <div class="aspect-[3/4] w-30 lg:w-30 border-4 border-lightGray bg-darkGray">
                                    <img src="{{ asset('storage/' . $b->profile_picture) }}" alt="Profile Picture" class="w-fit h-full object-cover" id="profilePreview">
                                </div>         
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div> 
        <div class="mt-4">
            {{ $biodatas->links() }}
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