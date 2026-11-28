<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Informasi Perpustakaan Sederhana</title>

    @vite('resources/css/login.css')
</head>
<body>

    <main class="login-container">

        <div class="login-card">

            <div class="login-header">

                <h1>Welcome Back!</h1>

                <p>
                    Panel internal untuk mengelola katalog buku, 
                    data anggota, dan transaksi peminjaman secara terpusat.
                </p>
            </div>

            @if ($errors->any())
                <div class="error-message">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.submit') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Masukkan Email Anda" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan Password Anda" required>
                </div>

                <button type="submit" class="login-button">
                    Login
                </button>
            </form>

            <div class="login-footer">
                <p>Sistem Informasi Perpustakaan</p>
                <span>Tertib. Terkelola. Terpantau.</span>
            </div>

        </div>

    </main>

</body>
</html>
