@extends("landing.layout.app", ["title" => "Pengajuan Izin"])

@push("style")
<style>
    .izin-container {
        display: flex;
        gap: 2rem;
        margin-top: 2rem;
        margin-bottom: 2rem;
    }
    .izin-left, .izin-right {
        width: 50%;
        max-height: 460px;
        background: rgba(255,255,255,0.05);
        border-radius: 1.5rem;
        padding: 2em;
        box-shadow: 0 8px 32px rgba(0,0,0,0.12);
        backdrop-filter: blur(10px);
    }
    @media (max-width: 900px) {
        .izin-container {
            flex-direction: column;
            gap: 0rem;
            margin-bottom: 0rem;

        }
        .izin-left {
            width: 100%;
            margin-bottom: 1.5rem;
        }
        .izin-right {
            width: 100%;
            padding: 2rem 1.5rem;
            max-height: 600px;
            margin-bottom: 0rem;
        }
    }
    .izin-form-input {
        font-size: 0.95rem;
        padding-top: 5px;
        padding-bottom: 5px;
        padding-left: 0.75rem;
        padding-right: 0.75rem;
    }
    .drop-zone {
        border: 2px dashed #64748b;
        border-radius: 1rem;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: border-color 0.3s;
        background: rgba(255,255,255,0.02);
    }
    .drop-zone.dragover {
        border-color: #10b981;
        background: rgba(16, 185, 129, 0.1);
    }
    .drop-zone.has-file {
        border-color: #10b981;
        background: rgba(16, 185, 129, 0.05);
    }
    .file-input {
        display: none;
    }
</style>
@endpush

@section("content")
<section class="min-h-screen text-slate-200">
    <div class="container mx-auto px-6 py-8">
        @include("landing.partials.header")
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="text-center mb-1">
            <h1 class="text-2xl font-bold text-slate-100 mb-2">Pengajuan Izin</h1>
            <p class="text-slate-400">Isi form berikut untuk mengajukan izin (sakit, izin, atau dispensasi)</p>
        </div>
        <form action="{{ route('feature.izin.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            <div class="izin-container">
                    @csrf
                <!-- Kontainer Kiri -->
                <div class="izin-left flex flex-col items-center justify-center">
                    <div id="drop-zone" class="drop-zone w-full">
                        <svg class="w-20 h-20 text-slate-300 mb-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <div class="text-center px-4">
                            <h2 class="text-lg font-semibold text-slate-100 mb-2">Upload File</h2>
                            <p class="text-slate-400" id="drop-text">Seret dan jatuhkan file di sini atau klik untuk memilih</p>
                            <p class="text-xs text-slate-400 mt-1">Max file 10mb. Format: jpg, png, jpeg, pdf</p>
                        </div>
                    </div>
                    <input type="file" id="file-input" name="file" class="file-input" accept="image/*,application/pdf" required multiple>
                </div>
                <!-- Kontainer Kanan -->
                <div class="izin-right flex items-center justify-center">
                    <div class="w-full max-sm:max-w-md max-w-xl space-y-4">

                        <div class="flex flex-col lg:flex-row lg:gap-2 w-full">
                            <div class="lg:w-full">
                                <label for="student_id" class="block text-slate-300 mb-1">Nama Siswa</label>
                                <input type="hidden" name="student_id" value="{{ auth()->user()->id }}">
                                <input type="text" id="student_id_display" value="{{ auth()->user()->name }}" readonly class="izin-form-input w-full rounded-lg bg-slate-800 text-slate-100 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-400 cursor-not-allowed">
                            </div>
                        </div>

                        <div class="flex flex-col lg:flex-row lg:gap-2 w-full">
                            <div class="lg:w-full">
                                <label for="parent_name" class="block text-slate-300 mb-1">Nama Orang Tua</label>
                                <input type="text" id="parent_name" name="parent_name" required class="izin-form-input w-full rounded-lg bg-slate-800 text-slate-100 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-400">
                            </div>
                        </div>


                        <div>
                            <label for="type" class="block text-slate-300 mb-1">Tipe Izin</label>
                            <select id="type" name="type" required class="izin-form-input w-full rounded-lg bg-slate-800 text-slate-100 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-400">
                                <option value="">Pilih Tipe Izin</option>
                                <option value="sakit">Sakit</option>
                                <option value="izin">Izin</option>
                                <option value="dispen">Dispen</option>
                            </select>
                        </div>
                        <div>
                            <label for="description" class="block text-slate-300 mb-1">Deskripsi</label>
                            <textarea id="description" name="description" rows="3" required class="w-full rounded-lg bg-slate-800 text-slate-100 border border-slate-700 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400"></textarea>
                        </div>
                        <button type="submit" class="w-full max-sm:mt-4 bg-green-500 hover:bg-green-600 text-white font-semibold py-2 rounded-lg transition">Kirim Pengajuan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

@push("script")
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropZone = document.getElementById('drop-zone');
    const fileInput = document.getElementById('file-input');
    const dropText = document.getElementById('drop-text');

    // Klik untuk pilih file
    dropZone.addEventListener('click', () => fileInput.click());

    // Drag over
    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('dragover');
    });

    // Drag leave
    dropZone.addEventListener('dragleave', () => {
        dropZone.classList.remove('dragover');
    });

    // Drop
    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('dragover');
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            dropZone.classList.add('has-file');
            dropText.textContent = `${files.length} file(s) dipilih`;
        }
    });

    // File input change
    fileInput.addEventListener('change', () => {
        if (fileInput.files.length > 0) {
            dropZone.classList.add('has-file');
            dropText.textContent = `${fileInput.files.length} file(s) dipilih`;
        } else {
            dropZone.classList.remove('has-file');
            dropText.textContent = 'Seret dan jatuhkan file di sini atau klik untuk memilih';
        }
    });
});
</script>
@endpush
@endsection
