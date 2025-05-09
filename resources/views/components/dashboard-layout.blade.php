{{-- Penjaluran Layout --}}

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title }}</title>

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-paperWhite">
        @include('partials.nav-dashboard')
        @include('partials.side')
        
        <main>
            {{ $slot }}
        </main>

        @stack('scripts')
    </body>
</html>
