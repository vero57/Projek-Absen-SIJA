@extends('dashboard.layout.app', ['title' => 'Tambah Detail Siswa'])

@section('content')
<div class="content-section max-w-xl mx-auto">
    <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-6 border border-slate-700">
        <h3 class="text-2xl font-semibold text-white mb-4">Tambah Detail Siswa</h3>
        <form action="{{ route('dashboard.siswa.detail.store', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-slate-300 mb-1 text-sm">Nama Siswa</label>
                <input type="text" value="{{ $user->name }}" disabled class="w-full bg-slate-900 text-slate-200 border border-slate-700 rounded px-3 py-2 text-sm" />
                <input type="hidden" name="user_id" value="{{ $user->id }}">
            </div>
            <div class="mb-4">
                <label class="block text-slate-300 mb-1 text-sm">NIS</label>
                <input type="text" name="nis" value="{{ old('nis') }}" required class="w-full bg-slate-900 text-slate-200 border border-slate-700 rounded px-3 py-2 text-sm" />
            </div>
            <div class="mb-4">
                <label class="block text-slate-300 mb-1 text-sm">NISN</label>
                <input type="text" name="nisn" value="{{ old('nisn') }}" class="w-full bg-slate-900 text-slate-200 border border-slate-700 rounded px-3 py-2 text-sm" />
            </div>
            <div class="mb-4">
                <label class="block text-slate-300 mb-1 text-sm">Gender</label>
                <select name="gender" required class="w-full bg-slate-900 text-slate-200 border border-slate-700 rounded px-3 py-2 text-sm">
                    <option value="" disabled selected>-- Pilih Gender --</option>
                    <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-slate-300 mb-1 text-sm">Tempat Lahir</label>
                <input type="text" name="birth_place" value="{{ old('birth_place') }}" required class="w-full bg-slate-900 text-slate-200 border border-slate-700 rounded px-3 py-2 text-sm" />
            </div>
            <div class="mb-4">
                <label class="block text-slate-300 mb-1 text-sm">Tanggal Lahir</label>
                <input type="date" name="birth_date" value="{{ old('birth_date') }}" required class="w-full bg-slate-900 text-slate-200 border border-slate-700 rounded px-3 py-2 text-sm" />
            </div>
            <div class="mb-4">
                <label class="block text-slate-300 mb-1 text-sm">Alamat</label>
                <input type="text" name="address" value="{{ old('address') }}" required class="w-full bg-slate-900 text-slate-200 border border-slate-700 rounded px-3 py-2 text-sm" />
            </div>
            <div class="mb-4">
                <label class="block text-slate-300 mb-1 text-sm">Foto</label>
                <input type="file" name="photo" accept="image/*" class="w-full bg-slate-900 text-slate-200 border border-slate-700 rounded px-3 py-2 text-sm" />
            </div>
            <div class="flex gap-2 mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded text-sm font-semibold">Simpan</button>
                <a href="{{ route('dashboard.siswa') }}" class="bg-slate-600 hover:bg-slate-500 text-white px-4 py-2 rounded text-sm font-semibold">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection