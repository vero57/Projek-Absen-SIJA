@extends('landing.layout.app', ['title' => 'Login / Register'])

@push('style')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700&family=Inter:wght@400;500;700&display=swap');
    body {
        font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
    }
    .auth-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
    }
    .flip-card {
        background: transparent;
        width: 480px;
        height: 650px;
        perspective: 1000px;
        position: relative;
    }
    .flip-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        transition: transform 0.7s cubic-bezier(.4,2,.3,1);
        transform-style: preserve-3d;
    }
    .flip-card.flipped .flip-card-inner {
        transform: rotateY(180deg);
    }
    .flip-card-front, .flip-card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        background: rgba(255,255,255,0.08);
        border-radius: 1.5rem;
        box-shadow: 0 8px 32px rgba(0,0,0,0.18);
        padding: 2.5rem 2rem 2rem 2rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .flip-card-back {
        transform: rotateY(180deg);
    }
    .switch-btn {
        position: absolute;
        top: 1.5rem;
        right: 2rem;
        background: #6366f1;
        color: #fff;
        border: none;
        border-radius: 999px;
        padding: 0.5rem 1.2rem;
        font-weight: 500;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(99,102,241,0.15);
        transition: background 0.2s;
        z-index: 2;
    }
    .switch-btn:hover {
        background: #4338ca;
    }
    .auth-title {
        font-size: 1.7rem;
        font-weight: 700;
        color: #6366f1;
        margin-bottom: 1.2rem;
        text-align: center;
    }
    .auth-form label {
        font-weight: 500;
        color: white;
        margin-bottom: 0.3rem;
    }
    .auth-form input {
        width: 100%;
        padding: 0.7rem 1rem;
        border-radius: 0.7rem;
        border: 1px solid #cbd5e1;
        margin-bottom: 5px;
        font-size: 1rem;
        background: #f1f5f9;
        transition: border 0.2s;
    }
    .auth-form input:focus {
        border-color: #6366f1;
        outline: none;
    }
    .auth-form button {
        width: 100%;
        padding: 0.8rem;
        border-radius: 0.7rem;
        background: #6366f1;
        color: #fff;
        font-weight: 600;
        border: none;
        font-size: 1.1rem;
        cursor: pointer;
        transition: background 0.2s;
        margin-top: 0.5rem;
    }
    .auth-form button:hover {
        background: #4338ca;
    }
    .auth-form select {
        width: 100%;
        padding: 0.7rem 1rem;
        border-radius: 0.7rem;
        border: 1.5px solid #6366f1;
        margin-bottom: 5px;
        font-size: 1rem;
        background: #f1f5f9;
        color: #334155;
        appearance: none;
        transition: border 0.2s, box-shadow 0.2s;
        box-shadow: 0 2px 8px rgba(99,102,241,0.05);
        position: relative;
        outline: none;
    }
    .auth-form select:focus {
        border-color: #4338ca;
        box-shadow: 0 0 0 2px #6366f1;
        background: #e0e7ef;
    }
    /* Custom arrow for select */
    .auth-form select {
        background-image: url("data:image/svg+xml,%3Csvg width='16' height='16' fill='none' stroke='%236366f1' stroke-width='2' viewBox='0 0 24 24'%3E%3Cpath d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 1.2em;
    }
    .auth-form option {
        color: #334155;
        background: #f1f5f9;
    }
</style>
@endpush

@section('content')
<div class="auth-container">
    <div class="flip-card" id="flipCard">
        <button class="switch-btn" id="switchBtn"
            type="button"
            onclick="switchPanel()">
            Register
        </button>
        <div class="flip-card-inner">
            <!-- Login Form -->
            <div class="flip-card-front">
                <div class="auth-title">Login</div>
                <form class="auth-form" method="POST" action="{{ route('auth.loginsiswa') }}">
                    @csrf
                    <label for="login-email">Email</label>
                    <input type="email" id="login-email" name="email" required autocomplete="email" placeholder="Email" value="{{ old('email') }}">
                    @error('email')
                        <div style="color:#f87171; font-size:0.875rem;">{{ $message }}</div>
                    @enderror

                    <label for="login-password">Password</label>
                    <input type="password" id="login-password" name="password" required autocomplete="current-password" placeholder="Password">
                    @error('password')
                        <div style="color:#f87171; font-size:0.875rem;">{{ $message }}</div>
                    @enderror

                    <button type="submit">Login</button>
                    <div class="mt-2 text-center">
                        <a href="{{ route('auth.login-dash') }}" style="font-size: 0.9rem; color:#6366f1;">Login sebagai Admin/Guru</a>
                    </div>
                </form>
            </div>
            <!-- Register Form -->
            <div class="flip-card-back">
                <div class="auth-title">Register</div>
                <form class="auth-form" method="POST" action="{{ route('auth.registersiswa') }}">
                    @csrf
                    <label for="register-name">Nama</label>
                    <input type="text" id="register-name" name="nama_siswa" required autocomplete="name" placeholder="Nama Lengkap" value="{{ old('nama_siswa') }}">
                    @error('nama_siswa')
                        <div style="color:#f87171; font-size:0.875rem;">{{ $message }}</div>
                    @enderror

                    <label for="register-email">Email</label>
                    <input type="email" id="register-email" name="email" required autocomplete="email" placeholder="Email" value="{{ old('email') }}">
                    @error('email')
                        <div style="color:#f87171; font-size:0.875rem;">{{ $message }}</div>
                    @enderror

                    <label for="register-password">Password</label>
                    <input type="password" id="register-password" name="password" required autocomplete="new-password" placeholder="Password">
                    @error('password')
                        <div style="color:#f87171; font-size:0.875rem;">{{ $message }}</div>
                    @enderror

                    <label for="register-password-confirm">Konfirmasi Password</label>
                    <input type="password" id="register-password-confirm" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi Password">
                    @error('password_confirmation')
                        <div style="color:#f87171; font-size:0.875rem;">{{ $message }}</div>
                    @enderror

                    <label for="register-phone">No. Telp</label>
                    <input type="text" id="register-phone" name="no_telp" required autocomplete="tel" placeholder="Nomor Telepon" value="{{ old('no_telp') }}">
                    @error('no_telp')
                        <div style="color:#f87171; font-size:0.875rem;">{{ $message }}</div>
                    @enderror

                    <label for="register-class">Kelas</label>
                    <select id="register-class" name="class_id" required class="auth-form-select">
                        <option value="">Pilih Kelas</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                        @endforeach
                    </select>
                    @error('class_id')
                        <div style="color:#f87171; font-size:0.875rem;">{{ $message }}</div>
                    @enderror

                    <button type="submit">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    const flipCard = document.getElementById('flipCard');
    const switchBtn = document.getElementById('switchBtn');
    let isLogin = true;

    function switchPanel() {
        if (isLogin) {
            window.location.search = '?panel=register';
        } else {
            window.location.search = '?panel=login';
        }
    }

    // Panel logic on load
    let panel = 'login';
    const params = new URLSearchParams(window.location.search);
    if (params.get('panel') === 'register') {
        flipCard.classList.add('flipped');
        isLogin = false;
        switchBtn.textContent = 'Login';
        panel = 'register';
    } else {
        flipCard.classList.remove('flipped');
        isLogin = true;
        switchBtn.textContent = 'Register';
        panel = 'login';
    }
</script>
@endpush