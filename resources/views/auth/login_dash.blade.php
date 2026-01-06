@extends('landing.layout.app', ['title' => 'Login Dashboard'])

@push('style')
<style>
    .auth-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #0f172a 0%, #111827 60%, #0f172a 100%);
        padding: 2rem;
    }
    .login-card {
        width: 420px;
        background: rgba(255,255,255,0.04);
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(2,6,23,0.6);
        border: 1px solid rgba(255,255,255,0.04);
    }
    .login-header {
        display:flex;
        gap:0.75rem;
        align-items:center;
        margin-bottom:1rem;
    }
    .login-icon {
        width:48px;
        height:48px;
        border-radius:8px;
        background:linear-gradient(135deg,#7c3aed,#4f46e5);
        display:flex;
        align-items:center;
        justify-content:center;
        color:white;
        font-weight:700;
        font-size:18px;
    }
    .login-title { color:#e6edf3; font-size:1.25rem; font-weight:700; }
    .login-desc { color:#9aa4b2; font-size:0.9rem; }

    .form-group { margin-bottom:0.75rem; }
    .form-input {
        width:100%;
        padding:0.65rem 0.9rem;
        border-radius:8px;
        background:rgba(15,23,42,0.6);
        color:#e6edf3;
        border:1px solid rgba(148,163,184,0.06);
        outline:none;
    }
    .form-input::placeholder { color:#9aa4b2; }
    .btn-primary {
        width:100%;
        padding:0.7rem;
        border-radius:8px;
        background:linear-gradient(90deg,#4f46e5,#7c3aed);
        color:white;
        font-weight:600;
        border:none;
        cursor:pointer;
    }
    .text-error { color:#f87171; font-size:0.875rem; margin-top:0.35rem; }
    .helper-row { display:flex; justify-content:space-between; align-items:center; margin-top:0.5rem; color:#9aa4b2; font-size:0.9rem; }
    a.link-muted { color:#9aa4b2; text-decoration:underline; text-underline-offset:3px; }

    .checkbox-toggle { display:inline-flex; align-items:center; gap:0.6rem; cursor:pointer; user-select:none; }
    .checkbox-toggle input[type="checkbox"] { position:absolute; opacity:0; pointer-events:none; width:0; height:0; }
    .checkbox-box {
        width:18px;
        height:18px;
        border-radius:6px;
        background:rgba(255,255,255,0.02);
        border:1px solid rgba(148,163,184,0.06);
        display:inline-block;
        position:relative;
        transition: all .15s ease;
        box-shadow: inset 0 -2px 6px rgba(2,6,23,0.25);
    }
    .checkbox-box::after{
        content: '';
        position: absolute;
        left: 5px;
        top: 2px;
        width: 5px;
        height: 9px;
        border: 2px solid rgba(255,255,255,0.98);
        border-top: 0;
        border-left: 0;
        transform: rotate(40deg) scale(0);
        transform-origin: center;
        transition: transform .15s ease;
    }
    .checkbox-toggle input:checked + .checkbox-box {
        background: linear-gradient(90deg,#4f46e5,#7c3aed);
        border-color: transparent;
        box-shadow: 0 6px 18px rgba(79,70,229,0.18);
    }
    .checkbox-toggle input:checked + .checkbox-box::after {
        transform: rotate(40deg) scale(1);
    }
    .checkbox-label-text { font-weight:500; color:#9aa4b2; }
</style>
@endpush

@section('content')
<div class="auth-container">
    <div class="login-card">
        <div class="login-header">
            <div class="login-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <div>
                <div class="login-title">Login Dashboard</div>
                <div class="login-desc">Masuk untuk mengelola absensi & jurnal siswa.</div>
            </div>
        </div>

        <form method="POST" action="{{ route('login.dash') }}" novalidate>
            @csrf
            <div class="form-group">
                <label class="text-slate-300 text-sm">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus placeholder="you@example.com" class="form-input" />
                @error('email')
                    <div class="text-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="text-slate-300 text-sm">Password</label>
                <input id="password" name="password" type="password" required placeholder="••••••••" class="form-input" />
                @error('password')
                    <div class="text-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="helper-row">
                <label class="checkbox-toggle" for="remember">
                    <input type="checkbox" id="remember" name="remember" />
                    <span class="checkbox-box" aria-hidden="true"></span>
                    <span class="checkbox-label-text">Remember me</span>
                </label>
                <a href="" class="link-muted">Forgot?</a>
            </div>

            <div style="margin-top:1rem;">
                <button type="submit" class="btn-primary">Login</button>
            </div>
            <div class="mt-2" style="text-align:center; margin-top:0.75rem;">
                <a href="{{ route('auth.login-register') }}" style="font-size: 0.9rem; color:#6366f1;">Login sebagai Siswa</a>
            </div>
        </form
    </div>
</div>
@endsection