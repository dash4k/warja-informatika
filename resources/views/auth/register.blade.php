<x-auth-layout title="Register — Warja">
    {{-- Body --}}
    <div class="flex min-h-screen w-full justify-center">

        {{-- Logo and artwork container (Desktop)--}}
        <div class="hidden md:flex w-1/2 min-h-screen justify-end items-center">
            <section class="min-w-[101dvh] min-h-[92dvh] rounded-xl bg-white shadow-md items-start px-10">

                {{-- Warja logo (desktop) --}}
                <a href="{{ route('/') }}" class="text-2xl font-logo ml-10">
                    <span class="flex items-start text-xl font-black">
                    <span class="text-darkBlue">War</span><span class="text-stroke-blue">Ja</span><span class="font-light text-stroke-blue font-poppins text-xs translate-y-[-0.2em]">&trade;</span>
                    </span>
                </a>
            </section>
        </div>

        {{-- Form container --}}
        <div class="w-full md:w-1/2 min-h-screen flex flex-col justify-center">
            <form action="{{ route('register') }}" method="post" onsubmit="" id='registerForm' class="flex flex-col px-20 gap-3">
                @csrf
                
                {{-- Form header --}}
                <div class="flex flex-col gap-2">
                    <h1 class="font-poppins font-medium tracking-wide text-2xl md:text-3xl">Create an account</h1>
                    <p class="font-roboto tracking-wide text-sm">Already have an account? <a href="{{ route('login') }}" class="underline text-midBlue hover:text-lightBlue">Log in</a> </p>
                </div>

                {{-- NIM/NPDN Input --}}
                <div class="w-full h-auto">
                    <label for="id_user" class="sr-only">NIM / NPDN</label>
                    <input type="text" name="id_user" id="id_user" placeholder="NIM / NPDN" class="bg-white border-2 w-full p-3 rounded-lg border-gray-200 @error('id_user') border-red-500 @enderror" value="{{ old('id_user') }}">

                    {{-- Client side validation --}}
                    <p id="idErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                </div>

                {{-- Email Input --}}
                <div class="w-full h-auto">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email (@student.unud.ac.id)" class="bg-white border-2 w-full p-3 rounded-lg border-gray-200 @error('email') border-red-500 @enderror" value="{{ old('email') }}">

                    {{-- Client side validation --}}
                    <p id="emailErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                </div>

                {{-- Password Input --}}
                <div class="w-full h-auto">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password" class="bg-white border-2 w-full p-3 rounded-lg border-gray-200 @error('password') border-red-500 @enderror" value="{{ old('password') }}">

                    {{-- Client side validation --}}
                    <p id="passwordErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                </div>

                {{-- Password Confirtmation Input --}}
                <div class="w-full h-auto">
                    <label for="password_confirmation" class="sr-only">Password Confirmation</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Password Confirmation" class="bg-white border-2 w-full p-3 rounded-lg border-gray-200 @error('password_confirmation') border-red-500 @enderror" value="{{ old('password_confirmation') }}">

                    {{-- Client side validation --}}
                    <p id="passwordConfirmationErrorMessage" class="text-red-500 mt-1 text-xs"></p>
                </div>

                {{-- Submit button --}}
                <button type="submit" class="mr-10 py-3 bg-midBlue self-baseline font-bold rounded-md text-paperWhite font-poppins font-bold hover:bg-lightBlue w-full">Create Account</button>

                {{-- Warja logo (mobile) --}}
                <a href="{{ route('/') }}" class="md:hidden w-screen flex items-end font-logo mt-2 ml-3">
                    <span class="flex items-start text-xs font-black mx-auto">
                    <span class="text-darkBlue">War</span><span class="text-stroke-blue">Ja</span><span class="font-light text-stroke-blue font-poppins text-xs translate-y-[-0.2em]">&trade;</span>
                    </span>
                </a>
            </form>
        </div>
    </div>

    @push('scripts')
        @vite('resources/js/register.js')
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
</x-auth-layout>