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
    .password-wrapper {
        position: relative;
        width: 100%;
    }
    .password-wrapper input[type="password"],
    .password-wrapper input[type="text"] {
        padding-right: 2.5rem;
    }
    .toggle-password-icon {
        position: absolute;
        top: 50%;
        right: 1rem;
        transform: translateY(-50%);
        cursor: pointer;
        color: #6366f1;
        font-size: 1.2rem;
        z-index: 3;
        user-select: none;
    }
    .toggle-password-icon svg {
        width: 1.3em;
        height: 1.3em;
        vertical-align: middle;
        fill: none;
        stroke: #6366f1;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
        background: transparent;
        pointer-events: none;
    }
    .toggle-password-icon.active svg {
        stroke: #4338ca;
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
                    <div class="password-wrapper">
                        <input type="password" id="login-password" name="password" required autocomplete="current-password" placeholder="Password">
                        <span class="toggle-password-icon" onclick="togglePassword('login-password', this)" id="icon-login-password">
                            <!-- Eye SVG -->
                            <svg viewBox="0 0 24 24"><ellipse cx="12" cy="12" rx="9" ry="6"/><circle cx="12" cy="12" r="2.5"/></svg>
                        </span>
                    </div>
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
                    <div class="password-wrapper">
                        <input type="password" id="register-password" name="password" required autocomplete="new-password" placeholder="Password">
                        <span class="toggle-password-icon" onclick="togglePassword('register-password', this)" id="icon-register-password">
                            <svg viewBox="0 0 24 24"><ellipse cx="12" cy="12" rx="9" ry="6"/><circle cx="12" cy="12" r="2.5"/></svg>
                        </span>
                    </div>
                    @error('password')
                        <div style="color:#f87171; font-size:0.875rem;">{{ $message }}</div>
                    @enderror

                    <label for="register-password-confirm">Konfirmasi Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="register-password-confirm" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi Password">
                        <span class="toggle-password-icon" onclick="togglePassword('register-password-confirm', this)" id="icon-register-password-confirm">
                            <svg viewBox="0 0 24 24"><ellipse cx="12" cy="12" rx="9" ry="6"/><circle cx="12" cy="12" r="2.5"/></svg>
                        </span>
                    </div>
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

    // SVGs for eye and eye-off
    const eyeSVG = `<svg viewBox="0 0 24 24"><ellipse cx="12" cy="12" rx="9" ry="6"/><circle cx="12" cy="12" r="2.5"/></svg>`;
    const eyeOffSVG = `<svg viewBox="0 0 24 24"><ellipse cx="12" cy="12" rx="9" ry="6"/><circle cx="12" cy="12" r="2.5"/><line x1="4" y1="4" x2="20" y2="20" stroke="#6366f1" stroke-width="2"/></svg>`;

    function togglePassword(inputId, iconSpan) {
        const input = document.getElementById(inputId);
        if (input.type === "password") {
            input.type = "text";
            iconSpan.innerHTML = eyeOffSVG;
            iconSpan.classList.add('active');
        } else {
            input.type = "password";
            iconSpan.innerHTML = eyeSVG;
            iconSpan.classList.remove('active');
        }
    }

    // Set initial icon for all password fields
    document.addEventListener('DOMContentLoaded', function() {
        const icons = [
            {id: 'icon-login-password'},
            {id: 'icon-register-password'},
            {id: 'icon-register-password-confirm'}
        ];
        icons.forEach(obj => {
            const el = document.getElementById(obj.id);
            if (el) el.innerHTML = eyeSVG;
        });
    });
</script>
@endpush