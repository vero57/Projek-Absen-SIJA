@extends('dashboard.layout.app', ['title' => 'Tambah Mata Pelajaran'])

@section('content')
<div class="content-section max-w-xl mx-auto">
    <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-6 border border-slate-700">
        <h3 class="text-2xl font-semibold text-white mb-4">Tambah Mata Pelajaran</h3>
        <form action="{{ route('dashboard.subjects.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-slate-300 mb-1 text-sm">Nama Mata Pelajaran</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full bg-slate-900 text-slate-200 border border-slate-700 rounded px-3 py-2 text-sm" />
                @error('name')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex gap-2 mt-6">
                <button type="submit" class="bg-green-600 hover:bg-green-500 text-white px-4 py-2 rounded text-sm font-semibold">Simpan</button>
                <a href="{{ route('dashboard.subjects.index') }}" class="bg-slate-600 hover:bg-slate-500 text-white px-4 py-2 rounded text-sm font-semibold">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
