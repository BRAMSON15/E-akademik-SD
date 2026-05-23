<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIDIK SD</title>
    <!-- Modern Font: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .tab-btn {
            flex: 1;
            padding: 0.875rem;
            background: transparent;
            border: none;
            font-weight: 700;
            color: var(--gray-500);
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            font-size: 0.95rem;
        }
        .tab-btn:hover {
            color: var(--primary);
        }
        .tab-btn.active {
            color: var(--primary);
        }
        .tab-indicator {
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 3px;
            background: var(--primary);
            border-radius: 3px 3px 0 0;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }
        .tab-btn.active .tab-indicator {
            transform: scaleX(1);
        }
    </style>
</head>
<body class="auth-body">
    <div class="auth-card" style="padding: 2.5rem 3rem;">
        <div style="text-align: center; margin-bottom: 1.5rem;">
            <div style="display: inline-flex; align-items: center; justify-content: center; width: 72px; height: 72px; border-radius: 20px; background: linear-gradient(135deg, var(--primary), #db2777); color: white; box-shadow: 0 10px 25px rgba(79, 85, 223, 0.4); font-size: 2.5rem;">
                <i class="fas fa-graduation-cap"></i>
            </div>
        </div>
        <h2 style="font-size: 1.75rem; margin-bottom: 0.25rem;">SIDIK SD</h2>
        <p style="text-align: center; color: var(--gray-500); margin-bottom: 2rem; font-size: 0.95rem; font-weight: 500;">Sistem Informasi Akademik Sekolah</p>

        @if($errors->any())
            <div style="background: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: 0.75rem; margin-bottom: 1.5rem; font-size: 0.875rem; border: 1px solid #fca5a5; font-weight: 600;">
                <i class="fas fa-exclamation-circle" style="margin-right: 0.5rem;"></i> {{ $errors->first() }}
            </div>
        @endif

        <!-- Tabs -->
        <div style="display: flex; margin-bottom: 2rem; border-bottom: 2px solid var(--gray-200);">
            <button type="button" class="tab-btn active" id="tab-guru" onclick="switchTab('guru')">
                <i class="fas fa-user-tie" style="margin-right: 0.5rem;"></i> Admin / Guru
                <div class="tab-indicator"></div>
            </button>
            <button type="button" class="tab-btn" id="tab-parent" onclick="switchTab('parent')">
                <i class="fas fa-users" style="margin-right: 0.5rem;"></i> Orang Tua
                <div class="tab-indicator"></div>
            </button>
        </div>

        <!-- Form Guru/Admin -->
        <form method="POST" action="{{ route('login') }}" id="form-guru">
            @csrf
            <div class="form-group">
                <label for="username">Nama Pengguna / Username</label>
                <div style="position: relative;">
                    <i class="fas fa-user" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--gray-400);"></i>
                    <input type="text" name="username" id="username" class="form-control" style="padding-left: 2.75rem;" placeholder="Masukkan username Anda">
                </div>
            </div>
            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <div style="position: relative;">
                    <i class="fas fa-lock" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--gray-400);"></i>
                    <input type="password" name="password" id="password" class="form-control" style="padding-left: 2.75rem;" placeholder="••••••••">
                </div>
            </div>
            
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <label style="display: flex; align-items: center; font-size: 0.875rem; color: var(--gray-600); cursor: pointer; font-weight: 500;">
                    <input type="checkbox" name="remember" style="margin-right: 0.5rem; width: 16px; height: 16px; accent-color: var(--primary);"> Ingat Saya
                </label>
            </div>

            <button type="submit" class="btn-auth">
                Masuk ke Portal <i class="fas fa-arrow-right" style="margin-left: 0.5rem; font-size: 0.875rem;"></i>
            </button>
        </form>

        <!-- Form Orang Tua -->
        <form method="POST" action="{{ route('parent.login') }}" id="form-parent" style="display: none;">
            @csrf
            <div class="form-group">
                <label for="student_name">Nama Lengkap Siswa</label>
                <div style="position: relative;">
                    <i class="fas fa-child" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--gray-400);"></i>
                    <input type="text" name="student_name" id="student_name" class="form-control" style="padding-left: 2.75rem;" placeholder="Bram Petra">
                </div>
            </div>
            <div class="form-group">
                <label for="nis">NIS (Nomor Induk Siswa)</label>
                <div style="position: relative;">
                    <i class="fas fa-id-badge" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--gray-400);"></i>
                    <input type="text" name="nis" id="nis" class="form-control" style="padding-left: 2.75rem;" placeholder="12155201220001">
                </div>
            </div>

            <button type="submit" class="btn-auth" style="background: linear-gradient(to right, var(--primary), var(--secondary)); margin-top: 1rem;">
                Masuk sebagai Orang Tua <i class="fas fa-arrow-right" style="margin-left: 0.5rem; font-size: 0.875rem;"></i>
            </button>
        </form>

    </div>

    <script>
        function switchTab(tab) {
            // Update buttons
            document.getElementById('tab-guru').classList.remove('active');
            document.getElementById('tab-parent').classList.remove('active');
            document.getElementById('tab-' + tab).classList.add('active');

            // Update forms
            if (tab === 'guru') {
                document.getElementById('form-guru').style.display = 'block';
                document.getElementById('form-parent').style.display = 'none';
            } else {
                document.getElementById('form-guru').style.display = 'none';
                document.getElementById('form-parent').style.display = 'block';
            }
        }

        // Check if there are specific errors for parent login
        @if($errors->has('student_name') || $errors->has('nis'))
            switchTab('parent');
        @endif
    </script>
</body>
</html>
