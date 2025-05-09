<x-dashboard-layout title="Dashboard — Warja">
    @include('dashboard.pengumumanPanduan')
    @push('scripts')
        @vite('resources/js/dashboard.js')
    @endpush
</x-dashboard-layout>