@extends('landing.layout.app', ['title' => 'Login / Register'])

@push('style')
<style>
    body {
        font-family: 'Inter', sans-serif;
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
        width: 400px;
        height: 480px;
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
        color: #334155;
        margin-bottom: 0.3rem;
    }
    .auth-form input {
        width: 100%;
        padding: 0.7rem 1rem;
        border-radius: 0.7rem;
        border: 1px solid #cbd5e1;
        margin-bottom: 1rem;
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
</style>
@endpush

@section('content')
<div class="auth-container">
    <div class="flip-card" id="flipCard">
        <button class="switch-btn" id="switchBtn">Register</button>
        <div class="flip-card-inner">
            <!-- Login Form -->
            <div class="flip-card-front">
                <div class="auth-title">Login</div>
                <form class="auth-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <label for="login-email">Email</label>
                    <input type="email" id="login-email" name="email" required autocomplete="email" placeholder="Email">
                    
                    <label for="login-password">Password</label>
                    <input type="password" id="login-password" name="password" required autocomplete="current-password" placeholder="Password">
                    
                    <button type="submit">Login</button>
                </form>
            </div>
            <!-- Register Form -->
            <div class="flip-card-back">
                <div class="auth-title">Register</div>
                <form class="auth-form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <label for="register-name">Nama</label>
                    <input type="text" id="register-name" name="name" required autocomplete="name" placeholder="Nama Lengkap">
                    
                    <label for="register-email">Email</label>
                    <input type="email" id="register-email" name="email" required autocomplete="email" placeholder="Email">
                    
                    <label for="register-password">Password</label>
                    <input type="password" id="register-password" name="password" required autocomplete="new-password" placeholder="Password">
                    
                    <label for="register-phone">No. Telp</label>
                    <input type="text" id="register-phone" name="phone" required autocomplete="tel" placeholder="Nomor Telepon">
                    
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

    switchBtn.addEventListener('click', function() {
        flipCard.classList.toggle('flipped');
        isLogin = !isLogin;
        switchBtn.textContent = isLogin ? 'Register' : 'Login';
    });
</script>
@endpush