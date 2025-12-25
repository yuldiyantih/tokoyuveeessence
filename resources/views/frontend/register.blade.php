<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yuvee Essence | Register</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <style>
        .error-text {
            color: #d9534f;
            font-size: 13px;
            margin-top: 5px;
        }

        .login-link {
            margin-top: 18px;
            text-align: center;
            font-size: 14px;
        }

        .login-link a {
            color: #4CAF50;
            font-weight: 600;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="login-container">

        <!-- Logo -->
        <img src="{{ asset('storage/products/logo.png') }}" class="logo" alt="Logo">

        <!-- Brand Name -->
        <h1 class="brand-title">Yuvee Essence</h1>

        <!-- GLOBAL ERROR -->
        @if ($errors->any())
        <div class="error-text" style="text-align:center; margin-bottom:15px;">
            Mohon periksa kembali data yang kamu isi.
        </div>
        @endif

        <!-- Form Box -->
        <form action="{{ route('customer.register.process') }}"
            method="POST"
            class="login-box"
            novalidate>
            @csrf

            <!-- Full Name -->
            <div class="input-group">
                <span class="icon green">👤</span>
                <input type="text"
                    name="name"
                    placeholder="Full Name"
                    value="{{ old('name') }}">
            </div>
            @error('name')
            <div class="error-text">{{ $message }}</div>
            @enderror

            <!-- Email -->
            <div class="input-group">
                <span class="icon green">📧</span>
                <input type="email"
                    name="email"
                    placeholder="Email"
                    value="{{ old('email') }}">
            </div>
            @error('email')
            <div class="error-text">{{ $message }}</div>
            @enderror

            <!-- Password -->
            <div class="input-group">
                <span class="icon yellow">✏️</span>
                <input type="password"
                    name="password"
                    placeholder="Password">
            </div>
            @error('password')
            <div class="error-text">{{ $message }}</div>
            @enderror

            <!-- Confirm Password -->
            <div class="input-group">
                <span class="icon yellow">🔒</span>
                <input type="password"
                    name="password_confirmation"
                    placeholder="Confirm Password">
            </div>

            <!-- Button -->
            <div class="btn-row" style="justify-content: center;">
                <button type="submit" class="btn-login">Register</button>
            </div>

        </form>

        <!-- LOGIN LINK -->
        <div class="login-link">
            <p>Sudah punya akun?
                <a href="{{ route('login') }}">Login di sini</a>
            </p>
        </div>

    </div>

</body>

</html>