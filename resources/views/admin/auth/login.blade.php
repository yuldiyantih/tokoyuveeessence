<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yuvee Essence | Admin Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <style>
        .error-text {
            color: #d9534f;
            font-size: 13px;
            margin-top: 5px;
        }

        .register-link {
            margin-top: 18px;
            text-align: center;
            font-size: 14px;
        }

        .register-link a {
            color: #4CAF50;
            font-weight: 600;
            text-decoration: none;
        }

        .register-link a:hover {
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

        <!-- GLOBAL LOGIN ERROR -->
        @if(session('login_error'))
        <div class="error-text" style="text-align:center; margin-bottom:15px;">
            {{ session('login_error') }}
        </div>
        @endif

        <!-- Form Box -->
        <form action="{{ route('login.process') }}" method="POST">
            @csrf
            <div class="login-box"
                novalidate
                onsubmit="return validateForm()">
                @csrf

                <!-- Email -->
                <div class="input-group">
                    <span class="icon green">👤</span>
                    <input type="email"
                        id="email"
                        name="email"
                        placeholder="Email">
                </div>
                <div id="emailError" class="error-text"></div>

                <!-- Password -->
                <div class="input-group">
                    <span class="icon yellow">✏️</span>
                    <input type="password"
                        id="password"
                        name="password"
                        placeholder="Password">
                </div>
                <div id="passwordError" class="error-text"></div>

                <!-- Buttons -->
                <div class="btn-row">
                    <a href="#" class="btn-forgot">🔒 Lost password?</a>
                    <button type="submit" class="btn-login">Login</button>
                </div>

        </form>

        <!-- ✅ REGISTER LINK -->
        <div class="register-link">
            <p>Belum punya akun?
                <a href="{{ route('customer.register') }}">Daftar di sini</a>
            </p>
        </div>

    </div>

    <!-- VALIDATION SCRIPT -->
    <script>
        function validateForm() {
            let valid = true;

            const email = document.getElementById('email');
            const password = document.getElementById('password');

            const emailError = document.getElementById('emailError');
            const passwordError = document.getElementById('passwordError');

            emailError.textContent = '';
            passwordError.textContent = '';

            if (email.value.trim() === '') {
                emailError.textContent = 'Email is required';
                valid = false;
            }

            if (password.value.trim() === '') {
                passwordError.textContent = 'Password is required';
                valid = false;
            }

            return valid;
        }
    </script>

</body>

</html>