@extends('layouts.pdf')

@section('content')

<style>
    @page {
        margin: 110px 40px 80px 40px;
    }

    header {
        position: fixed;
        top: -90px;
        left: 0;
        right: 0;
        height: 80px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    footer {
        position: fixed;
        bottom: -60px;
        left: 0;
        right: 0;
        height: 50px;
        text-align: center;
        font-size: 11px;
        color: #666;
        border-top: 1px solid #ddd;
    }

    .pagenum:before {
        content: counter(page);
    }
</style>

<header>
    <table width="100%">
        <tr>
            <td>
                <h2 style="margin:0;">SMKN 1 Cibinong</h2>
                <p style="margin:0;font-size:12px;">Jl. Karedenan No.7, Karedenan, Kec. Cibinong, Kabupaten Bogor, Jawa Barat</p>
            </td>
        </tr>
    </table>
</header>

<footer>
    <div>
        Dicetak pada {{ now('Asia/Jakarta')->format('d-m-Y H:i') }} |
        Halaman <span class="pagenum"></span>
    </div>
</footer>

<main>
    <h1 style="text-align:center;margin-bottom:20px;font-family:'Times New Roman', Times, serif;">Rekap Keterangan Daftar Presensi Siswa <br> SMKN 1 Cibinong</h1>
    <h1 style="text-align:center;margin-bottom:20px;font-family:'Times New Roman', Times, serif;">Tahun {{ now()->year }}</h1>

    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr style="background:#f2f2f2;">
                <th style="border:1px solid #ddd;padding:8px;">No</th>
                <th style="border:1px solid #ddd;padding:8px;">Nama Siswa</th>
                <th style="border:1px solid #ddd;padding:8px;">Kelas</th>
                <th style="border:1px solid #ddd;padding:8px;">Tanggal</th>
                <th style="border:1px solid #ddd;padding:8px;">Waktu Masuk</th>
                <th style="border:1px solid #ddd;padding:8px;">Waktu Keluar</th>
                <th style="border:1px solid #ddd;padding:8px;">Status</th>
            </tr>
        </thead>
        <tbody>
        @forelse($attendances as $attendance)
            <tr>
                <td style="border:1px solid #ddd;padding:8px;">{{ $loop->iteration }}</td>
                <td style="border:1px solid #ddd;padding:8px;">{{ $attendance->student->name ?? '-' }}</td>
                <td style="border:1px solid #ddd;padding:8px;">{{ $attendance->student && $attendance->student->classes->count() ? $attendance->student->classes->pluck('name')->join(', ') : '-' }}</td>
                <td style="border:1px solid #ddd;padding:8px;">{{ $attendance->date }}</td>
                <td style="border:1px solid #ddd;padding:8px;">{{ $attendance->time_in ?? '-' }}</td>
                <td style="border:1px solid #ddd;padding:8px;">{{ $attendance->time_out ?? '-' }}</td>
                <td style="border:1px solid #ddd;padding:8px;">{{ $attendance->status->name ?? '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7" style="text-align:center;padding:10px;">Tidak ada data presensi.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</main>
@endsection
