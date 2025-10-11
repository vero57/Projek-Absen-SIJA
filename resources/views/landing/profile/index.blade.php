@extends("landing.layout.app", ["title" => "Profil"])

@push("style")
<style>
    .profile-card {
        background: rgba(255,255,255,0.04);
        border-radius: 1.5rem;
        box-shadow: 0 10px 40px rgba(2,6,23,0.6);
        backdrop-filter: blur(10px);
    }
    .avatar-circle {
        width: 140px;
        height: 140px;
        border-radius: 9999px;
        display: grid;
        place-items: center;
        background: linear-gradient(135deg, rgba(99,102,241,0.9), rgba(139,92,246,0.85));
        box-shadow: 0 12px 30px rgba(99,102,241,0.15);
    }
    @media (max-width: 640px) {
        .avatar-circle { width: 110px; height: 110px; }
    }
    .info-row { display: flex; gap: .75rem; align-items: center; }
    .info-icon { width: 18px; height: 18px; flex: 0 0 18px; color: #94a3b8; }
</style>
@endpush

@section("content")
<section class="min-h-screen text-slate-200">
    <div class="container mx-auto px-6 py-8">
        @include("landing.partials.header")
        <div class="mx-auto">
            <div class="profile-card p-8">
                <div class="flex flex-col items-center">
                    <div class="avatar-circle mb-6">
                        <svg class="w-16 h-16 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 20C3.732 16.943 6.79 15 12 15s8.268 1.943 9.542 5" />
                        </svg>
                    </div>

                    <h1 class="text-2xl font-semibold text-slate-100 mb-1">
                        UdayanaTampanDKV1
                    </h1>
                    <p class="text-sm text-slate-400 mb-6">XII DKV 10</p>

                    <div class="w-full space-y-4">
                        <div class="bg-slate-800/40 rounded-lg p-4">
                            <div class="info-row">
                                <svg class="info-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 12a4 4 0 10-8 0 4 4 0 008 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14v7" />
                                </svg>
                                <div>
                                    <div class="text-xs text-slate-400">Nama</div>
                                    <div class="text-sm text-slate-100 font-medium">Udayana Warmadewa</div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-slate-800/40 rounded-lg p-4">
                            <div class="info-row">
                                <svg class="info-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 12v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2h6" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 12v-.5a2.5 2.5 0 00-2.5-2.5H18" />
                                </svg>
                                <div>
                                    <div class="text-xs text-slate-400">Email</div>
                                    <div class="text-sm text-slate-100 font-medium">udayana@smkn1.com</div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-slate-800/40 rounded-lg p-4">
                            <div class="info-row">
                                <svg class="info-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5h12M9 3v2m0 4v12" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 8v6a2 2 0 01-2 2h-3l-4 3v-5H5a2 2 0 01-2-2V8a2 2 0 012-2h14a2 2 0 012 2z" />
                                </svg>
                                <div>
                                    <div class="text-xs text-slate-400">Nomor Telepon</div>
                                    <div class="text-sm text-slate-100 font-medium">08212122121</div>
                                </div>
                            </div>
                        </div>

                        <!-- Optional actions -->
                        <div class="flex gap-3">
                            <a href="" class="w-full text-center bg-purple-600 hover:bg-purple-700 text-white py-2 rounded-lg text-sm">Edit Profil</a>
                            <a href="{{ url()->previous() }}" class="w-full text-center border border-slate-700 text-slate-100 py-2 rounded-lg text-sm">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection