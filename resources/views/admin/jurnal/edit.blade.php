@extends('layouts.app')
@section('content')
<div class="container py-4 max-w-lg mx-auto">
    <h1 class="mb-4 text-2xl font-bold">Edit Jurnal</h1>
    <form action="{{ route('admin.jurnal.update', $jurnal) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="block mb-1 font-semibold">Judul</label>
            <input type="text" name="judul" class="w-full border rounded px-3 py-2" required value="{{ old('judul', $jurnal->judul) }}">
        </div>
        <div class="mb-3">
            <label class="block mb-1 font-semibold">Penulis</label>
            <input type="text" name="penulis" class="w-full border rounded px-3 py-2" required value="{{ old('penulis', $jurnal->penulis) }}">
        </div>
        <div class="mb-3">
            <label class="block mb-1 font-semibold">Jalur</label>
            <input type="text" name="jalur" class="w-full border rounded px-3 py-2" required value="{{ old('jalur', $jurnal->jalur) }}">
        </div>
        <div class="mb-3">
            <label class="block mb-1 font-semibold">Tahun</label>
            <input type="text" name="tahun" class="w-full border rounded px-3 py-2" required value="{{ old('tahun', $jurnal->tahun) }}">
        </div>
        <div class="mb-3">
            <label class="block mb-1 font-semibold">Link (opsional)</label>
            <input type="text" name="link" class="w-full border rounded px-3 py-2" value="{{ old('link', $jurnal->link) }}">
        </div>
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Update</button>
        <a href="{{ route('admin.jurnal.index') }}" class="ml-2 text-gray-600 underline">Batal</a>
    </form>
</div>
@endsection
