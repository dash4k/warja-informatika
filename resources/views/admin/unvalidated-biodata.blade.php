<x-admin-dashboard title="Unvalidated Biodata">
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
                        <th class="border px-4 py-2">Notes</th>
                        <th class="border px-4 py-2">Validate</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($biodatas as $b)
                        <tr class="biodataRow"
                            data-profile="{{ asset('storage/' . $b->profile_picture) }}"
                        >
                            <td class="border px-4 py-2 break-words max-w-[200px]">{{ $b->nim }}</td>
                            <td class="border px-4 py-2 break-words max-w-[200px] capitalize">{{ $b->nama }}</td>
                            <td class="border px-4 py-2 break-words max-w-[250px] capitalize">{{ $b->kelas }}</td>
                            {{-- <td class="border px-4 py-2">
                                <a href="{{ asset('storage/' . $b->profile_picture) }}" target="_blank" class="text-blue-600 hover:cursor-pointer" title="Foto Profile"><i class="fa-solid fa-link"></i></a>
                            </td> --}}
                            <td class="border px-4 py-2">
                                <button type="button" class="showProfile bg-snowWhite hover:bg-black hover:text-snowWhite px-2 py-1 rounded hover:cursor-pointer transition-all duration-100" title="Profile"><i class="fa-solid fa-camera"></i></button>
                            </td>
                            <td class="border px-4 py-2">
                                <form action="{{ route('admin.biodata.update', $b->nim) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('PUT')

                                    <textarea 
                                        name="pesan"
                                        class="auto-resize w-full resize-none overflow-hidden bg-transparent border-none outline-none text-sm focus:ring-1 focus:ring-darkBlue p-2 overflow-y-auto"
                                        disabled
                                        oninput="autoResize(this)"
                                    >{{ $b->admin_notes }}</textarea>

                                    <div class="flex justify-end gap-1 items-center p-1">
                                        <button type="button" class="cancelEditButton bg-red-300 text-white text-sm px-4 py-1 rounded hover:bg-red-100 hover:text-black hover:cursor-pointer transition-all duration-100">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                        <button type="submit" class="bg-midBlue text-white text-sm px-4 py-1 rounded hover:bg-lightBlue hover:text-black hover:cursor-pointer transition-all duration-100">
                                            <i class="fa-solid fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </form>

                                <button type="button" class="editButton bg-yellow-300 hover:bg-yellow-200 px-2 py-1 rounded hover:cursor-pointer transition-all duration-100" title="Catatan"><i class="fa-solid fa-pen-to-square"></i></button>
                            </td>
                            <td class="border px-4 py-2">
                                <form action="{{ route('admin.biodata.validate', $b->nim) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="validateButton bg-midBlue hover:bg-lightBlue text-white hover:text-black px-2 py-1 rounded hover:cursor-pointer transition-all duration-100">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div id="profileContainer" class="fixed inset-0 bg-blue-200/30 backdrop-blur-sm z-100 flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300 ease-out w-full h-full pl-5 pr-5">
                <div class="p-6 rounded h-full w-full transform transition-all duration-300 ease-in-out">
                    <div class="flex flex-col justify-start items-end">
                        <button type="button" id="closeProfile" class="rounded-full bg-red-300 text-white text-sm px-2 pt-1 hover:bg-red-100 hover:text-black hover:cursor-pointer transition-all duration-100">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="flex flex-row justify-center items-center w-full h-full">
                        <div class="aspect-[3/4] w-30 lg:w-30 border-4 border-lightGray bg-darkGray pt-5">
                            <img src="" alt="Profile Picture" id="profile" class="w-fit h-full object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </section>
    @push('scripts')
        @vite('resources/js/adminBiodata.js')
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