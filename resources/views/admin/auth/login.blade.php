<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yuvee Essence | Admin Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>

    <div class="login-container">

        <!-- Logo -->
        <img src="{{ asset('storage/products/logo.png') }}" class="logo" alt="Logo">

        <!-- Brand Name -->
        <h1 class="brand-title">Yuvee Essence</h1>

        <!-- Form Box -->
        <form action="{{ route('login.process') }}" method="POST" class="login-box">
            @csrf

            <!-- Email -->
            <div class="input-group">
                <span class="icon green">👤</span>
                <input type="email" name="email" placeholder="Email" required>
            </div>

            <!-- Password -->
            <div class="input-group">
                <span class="icon yellow">✏️</span>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <!-- Buttons -->
            <div class="btn-row">
                <a href="#" class="btn-forgot">🔒 Lost password?</a>
                <button type="submit" class="btn-login">Login</button>
            </div>

        </form>

    </div>

</body>

</html>