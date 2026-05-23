<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - SIDIK SD</title>
    <!-- Modern Font: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="auth-body">
    <div class="auth-card" style="max-width: 450px;">
        <div style="text-align: center; margin-bottom: 1rem; font-size: 3rem;">
            <div style="display: inline-flex; align-items: center; justify-content: center; width: 80px; height: 80px; border-radius: 24px; background: linear-gradient(135deg, var(--secondary), #059669); color: white; box-shadow: 0 10px 25px rgba(16, 185, 129, 0.4);">
                <i class="fas fa-user-plus"></i>
            </div>
        </div>
        <h2>Buat Akun Baru</h2>
        <p style="text-align: center; color: var(--gray-500); margin-top: 0.25rem; margin-bottom: 2rem; font-size: 0.95rem; font-weight: 500;">Sistem Informasi Akademik Sekolah</p>

        @if($errors->any())
            <div style="background: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: 0.75rem; margin-bottom: 1.5rem; font-size: 0.875rem; border: 1px solid #fca5a5; font-weight: 600;">
                <i class="fas fa-exclamation-circle" style="margin-right: 0.5rem;"></i> Terdapat kesalahan pengisian form.
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <div style="position: relative;">
                    <i class="fas fa-id-card" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--gray-400);"></i>
                    <input type="text" name="name" id="name" class="form-control" style="padding-left: 2.75rem;" placeholder="Masukkan nama lengkap" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Alamat Email</label>
                <div style="position: relative;">
                    <i class="fas fa-envelope" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--gray-400);"></i>
                    <input type="email" name="email" id="email" class="form-control" style="padding-left: 2.75rem;" placeholder="nama@email.com" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <div style="position: relative;">
                    <i class="fas fa-lock" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--gray-400);"></i>
                    <input type="password" name="password" id="password" class="form-control" style="padding-left: 2.75rem;" placeholder="Buat kata sandi yang kuat" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                <div style="position: relative;">
                    <i class="fas fa-check-circle" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--gray-400);"></i>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" style="padding-left: 2.75rem;" placeholder="Ulangi kata sandi" required>
                </div>
            </div>

            <button type="submit" class="btn-auth" style="background: linear-gradient(to right, var(--secondary), #059669); box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);">
                Daftar Sekarang <i class="fas fa-paper-plane" style="margin-left: 0.5rem; font-size: 0.875rem;"></i>
            </button>
        </form>

        <div style="margin-top: 2rem; text-align: center; font-size: 0.875rem; color: var(--gray-500); font-weight: 500;">
            Sudah memiliki akun? <br>
            <a href="{{ route('login') }}" style="color: var(--primary); font-weight: 700; text-decoration: none;">Masuk di sini</a>
        </div>
    </div>
</body>
</html>
