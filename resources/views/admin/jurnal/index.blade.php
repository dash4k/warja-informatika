@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-2xl font-bold">Daftar Jurnal</h1>
    <a href="{{ route('admin.jurnal.create') }}" class="mb-4 inline-block px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Tambah Jurnal</a>
    @if(session('success'))
        <div class="mb-4 p-2 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif
    <table class="w-full table-auto border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border">Judul</th>
                <th class="p-2 border">Penulis</th>
                <th class="p-2 border">Jalur</th>
                <th class="p-2 border">Tahun</th>
                <th class="p-2 border">Link</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jurnals as $jurnal)
            <tr>
                <td class="p-2 border">{{ $jurnal->judul }}</td>
                <td class="p-2 border">{{ $jurnal->penulis }}</td>
                <td class="p-2 border">{{ $jurnal->jalur }}</td>
                <td class="p-2 border">{{ $jurnal->tahun }}</td>
                <td class="p-2 border">
                    @if($jurnal->link)
                        <a href="{{ $jurnal->link }}" target="_blank" class="text-indigo-600 underline">Lihat</a>
                    @else
                        -
                    @endif
                </td>
                <td class="p-2 border">
                    <a href="{{ route('admin.jurnal.edit', $jurnal) }}" class="text-blue-600 underline">Edit</a> |
                    <form action="{{ route('admin.jurnal.destroy', $jurnal) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">{{ $jurnals->links() }}</div>
</div>
@endsection
