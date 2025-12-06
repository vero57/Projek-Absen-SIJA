
@extends(
    "dashboard.layout.app",
    [
        "title" => "Absen PRojek",
    ]
)

@section('content')
    <div id="contentArea" class="h-full max-sm:overflow-x-scroll">
        <div id="dashboard-content" class="content-section pb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-6 border border-slate-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-400 text-sm">Total Siswa</p>
                            <p class="text-2xl font-bold text-white">1,234</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-500/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-users text-blue-400 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-6 border border-slate-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-400 text-sm">Siswa Masuk</p>
                            <p class="text-2xl font-bold text-white">$12,345</p>
                        </div>
                        <div class="w-12 h-12 bg-green-500/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-dollar-sign text-green-400 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-6 border border-slate-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-400 text-sm">Siswa Sakit</p>
                            <p class="text-2xl font-bold text-white">567</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-500/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-shopping-cart text-purple-400 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-6 border border-slate-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-400 text-sm">Siswa Izin</p>
                            <p class="text-2xl font-bold text-white">567</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-500/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-shopping-cart text-purple-400 text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-6 border border-slate-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-400 text-sm">Siswa Dispen</p>
                            <p class="text-2xl font-bold text-white">567</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-500/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-shopping-cart text-purple-400 text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-6 border border-slate-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-400 text-sm">Tanpa Keterangan/Alfa</p>
                            <p class="text-2xl font-bold text-white">567</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-500/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-shopping-cart text-purple-400 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-6 border border-slate-700">
                <h3 class="text-lg font-semibold text-white mb-4">Analytics Overview</h3>
                <div class="h-64 flex items-center justify-center text-slate-400">
                    <i class="fas fa-chart-bar text-4xl mb-4"></i>
                    <p class="ml-4">Chart akan ditampilkan di sini</p>
                </div>
            </div>
        </div>
    </div>
@endsection
