<x-auth-layout title="Login — Warja">
    {{-- Body --}}
    <div class="flex min-h-screen w-full">

        {{-- Form Container --}}
        <div class="w-full md:w-1/2 min-h-screen flex flex-col justify-center">
            <form action="{{ route('login') }}" method="post" id="loginForm" class="flex flex-col px-20 gap-5">
                @csrf
                
                {{-- Server side validation + display error message --}}
                @if (session('error'))
                    <div class="text-red-500 bg-red-50 border border-red-300 p-2 rounded-md mb-2 text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Form header --}}
                <h1 class="font-poppins font-medium tracking-wide text-3xl">Login</h1>
                <p class="font-roboto tracking-wide text-sm">Don't have an account? <a href="{{ route('register') }}" class="underline text-midBlue hover:text-lightBlue">Register</a> </p>
                
                {{-- Email Input --}}
                <div class="w-full h-auto">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email (@student.unud.ac.id)" class="bg-white border-2 w-full p-3 rounded-lg border-gray-200 @error('email') border-red-500 @enderror" value="{{ old('email') }}">

                    {{-- Client side validation --}}
                    <p id="emailErrorMessage" class="text-red-500 mt-1 text-xs"></p>

                    {{-- Server side validation --}}
                    @error('email')
                        <div class="text-red-500 mt-1 text-xs">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Password Input --}}
                <div class="w-full h-auto">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password" class="bg-white border-2 w-full p-3 rounded-lg border-gray-200 @error('password') border-red-500 @enderror" value="{{ old('password') }}">
                    
                    {{-- Client side validation --}}
                    <p id="passwordErrorMessage" class="text-red-500 mt-1 text-xs"></p>

                    {{-- Server side validation --}}
                    @error('password')
                        <div class="text-red-500 mt-1 text-xs">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Form submit button --}}
                <button type="submit" class="mr-10 py-3 bg-midBlue self-baseline font-bold rounded-md text-paperWhite font-poppins font-bold hover:bg-lightBlue w-full">Login</button>

                {{-- Warja Logo (Mobile) --}}
                <a href="{{ route('/') }}" class="md:hidden w-screen flex items-end font-logo mt-2 ml-3">
                    <span class="flex items-start text-xs font-black mx-auto">
                    <span class="text-darkBlue">War</span><span class="text-stroke-blue">Ja</span><span class="font-light text-stroke-blue font-poppins text-xs translate-y-[-0.2em]">&trade;</span>
                    </span>
                </a>
            </form>
        </div>

        {{-- Logo and artwork (Desktop) --}}
        <div class="hidden md:flex w-1/2 min-h-screen justify-start items-center">
            <section class="min-w-[101dvh] min-h-[92dvh] rounded-xl bg-white shadow-md items-start px-10">

                {{-- Warja Logo (Desktop) --}}
                <a href="{{ route('/') }}" class="text-2xl font-logo ml-10">
                    <span class="flex items-start text-xl font-black">
                        <span class="text-darkBlue">War</span><span class="text-stroke-blue">Ja</span><span class="font-light text-stroke-blue font-poppins text-xs translate-y-[-0.2em]">&trade;</span>
                    </span>
                </a>
            </section>
        </div>
    </div>

    @push('scripts')
    @vite('resources/js/login.js')
    @endpush
</x-auth-layout>