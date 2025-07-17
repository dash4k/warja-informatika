{{-- TO DO: Benerin width input foto, line 30 --}}

<x-dashboard-layout title="Biodata — Warja">
    {{-- Main Container --}}
    <form id="biodataForm" method="post" action="{{ $mahasiswa ? route('biodata.update', $mahasiswa->nim) : route('biodata') }}" class="lg:right-[2.7%] mt-25 lg:ml-[20%] lg:mt-20 lg:w-7/9 min-h-screen lg:h-[75dvh] w-5/6 max-w-[86%] mx-auto rounded-sm mainMainContentDashboard transition-all duration-300 flex flex-col gap-5" enctype="multipart/form-data">
        @csrf
        @if ($mahasiswa)
            @method('put')
        @endif
        {{-- Biodata header --}}
        <h1 class="font-poppins text-lg lg:text-xl font-bold">Biodata Mahasiswa</h1>
        
        {{-- Biodata main container --}}
        <div class="mb-2">

            {{-- Biodata header --}}
            <div class="p-4 rounded-t-2xl bg-white w-full h-auto lg:h-[40dvh] border-x-2 border-t-2 border-lightGray flex flex-col lg:flex-row  items-center justify-center lg:justify-between gap-5 lg:gap-2">
                
                {{-- Profile Picture --}}
                <div class="flex flex-row justify-between items-center gap-5 lg:gap-4">

                    {{-- Display --}}
                    <div class="aspect-[3/4] w-30 lg:w-30 border-4 border-lightGray bg-darkGray">
                        <img src="{{ $mahasiswa && $mahasiswa->profile_picture ? asset('storage/' . $mahasiswa->profile_picture) : '' }}" alt="Profile Picture" class="w-fit h-full object-cover" id="profilePreview">
                    </div>            

                    {{-- File input --}}
                    <div>
                        <div class="flex flex-col items-center justify-center w-full text-center">
                            <label for="profilePicture" id="profilePictureLabel" class="flex flex-col items-center justify-center w-full lg:w-screen lg:max-w-[70dvh] h-30 lg:h-35 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6 px-4 gap-3">
                                    <i class="fa-solid fa-cloud-arrow-up text-gray-400"></i>
                                    <p class="hidden lg:block mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500">PNG, JPG or JPEG (MAX. 2048 KB)</p>
                                </div>
                                <input id="profilePicture" name="profilePicture" type="file" class="hidden" />
                            </label>
                            <p id="profilePictureErrorMessage" class="text-red-500 mt-1 text-xs w-full text-start"></p>
                        </div>
                    </div>
                </div>
                
                {{-- User's credential --}}
                <div class="py-4 w-full lg:w-1/3 h-auto flex flex-col gap-2">

                    {{-- Email --}}
                    <div>
                        <label class="font-bold text-gray-400">Email</label>
                        <div class="bg-lightGray text-darkGray py-2 pl-1 text-sm break-all">
                            {{ auth()->user()->email }}
                        </div>
                    </div>

                    {{-- NIM/NPDN --}}
                    <div>
                        <label class="font-bold text-gray-400">NIM</label>
                        <div class="bg-lightGray text-darkGray py-2 pl-1 text-sm break-all">
                            {{ auth()->user()->id_user }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Biodata main container --}}
            <div class="rounded-b-2xl p-4 bg-white w-full h-fit border-x-2 border-b-2 border-t-3 border-lightGray flex flex-col lg:flex-row lg:justify-between lg:gap-4">

                {{-- Nama --}}
                <div class="w-full lg:w-1/2">
                    <label for="namaLengkap" id="namaLengkapLabel" class="font-bold text-gray-400 block">Nama Lengkap</label>
                    <input name="namaLengkap" id="namaLengkap" value="{{ old('namaLengkap', $mahasiswa?->nama) }}" type="text" class="bg-lightGray w-full text-darkGray py-2 pl-1 text-sm placeholder:text-gray-400 break-all" placeholder="John Doe">
                    <p id="namaLengkapErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                </div>
                
                {{-- Kelas --}}
                <div class="w-full lg:w-1/2">
                    <label for="kelas" class="font-bold text-gray-400 block">Kelas</label>
                    <select id="kelas" name="kelas" class="bg-lightGray border border-gray-300 text-darkGray text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @foreach (['a', 'b', 'c', 'd', 'e', 'f'] as $kelas)
                        <option value="{{ $kelas }}" {{ old('kelas', $mahasiswa?->kelas) == $kelas ? 'selected' : '' }}>
                            {{ strtoupper($kelas) }}
                        </option>
                    @endforeach
                    </select>
                </div>

                {{-- Button --}}
                <div class="w-full lg:w-1/4 flex flex-col gap-2 pt-4 lg:justify-center lg:items-center lg:pt-0">
                    <button class="w-full font-bold hover:font-normal bg-lightBlue text-paperWhite hover:cursor-pointer hover:bg-blue-100 hover:text-black transition-all duration-100 " type="submit">Save Changes</button>
                    <button class="w-full font-bold hover:font-normal bg-red-400 text-paperWhite hover:cursor-pointer hover:bg-red-100 hover:text-black transition-all duration-100">Revert Changes</button>
                </div>

            </div> 
        </div>

        @if ($mahasiswa && ($mahasiswa->admin_notes != null || $mahasiswa->validated))
            <div class="flex flex-col items-start bg-white w-full p-4 rounded-2xl h-auto border-2 border-lightGray mb-2 gap-5">
                @if ($mahasiswa && $mahasiswa->admin_notes != null)
                    <div class="flex w-full border rounded-lg overflow-hidden mb-2">
                        <label class="font-bold bg-yellow-300 text-black p-2 flex items-center justify-center whitespace-nowrap">
                            Admin's Note
                        </label>
                        <p class="p-2 grow">
                            {{ $mahasiswa->admin_notes }}
                        </p>
                    </div>
                @elseif ($mahasiswa && $mahasiswa->validated)
                    <div class="flex justify-between w-full rounded-lg">
                        <div class="flex w-auto overflow-hidden mb-2">
                            <label class="font-bold text-black p-2 flex items-center justify-center whitespace-nowrap">
                                Validated at:
                            </label>
                            <p class="p-2">
                                {{ $mahasiswa->validated_at }}
                            </p>
                        </div>
                        <div class="flex w-auto border rounded-lg overflow-hidden mb-2">
                            <label class="font-bold bg-yellow-300 text-black p-2 flex items-center justify-center whitespace-nowrap">
                                Validated by:
                            </label>
                            <p class="p-2">
                                {{ $mahasiswa->id_admin }}
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </form>
    @push('scripts')
        @vite('resources/js/biodata.js')
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