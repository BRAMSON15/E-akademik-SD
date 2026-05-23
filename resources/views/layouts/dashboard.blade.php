<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'SIDIK SD') }} - @yield('title')</title>
    <!-- Modern Font: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('styles')
</head>
<body>
    <div class="dashboard-container">
        <!-- Mobile Header -->
        <div class="mobile-header">
            <div style="font-size: 1.25rem; font-weight: 800; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-graduation-cap" style="color: #6875eb;"></i> SIDIK SD
            </div>
            <button class="mobile-menu-btn" onclick="document.querySelector('.sidebar').classList.toggle('active')">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="brand">
                <i class="fas fa-graduation-cap"></i> SIDIK SD
            </div>
            <nav class="nav-links">
                @if(Auth::user()->isAdmin())
                    <div class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <i class="fas fa-users-cog"></i> Kelola User
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                            <i class="fas fa-cog"></i> Pengaturan
                        </a>
                    </div>
                @elseif(Auth::user()->isGuru())
                    <div class="nav-item">
                        <a href="{{ route('guru.dashboard') }}" class="nav-link {{ request()->routeIs('guru.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('guru.students.index') }}" class="nav-link {{ request()->routeIs('guru.students.*') ? 'active' : '' }}">
                            <i class="fas fa-user-graduate"></i> Kelola Siswa
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('guru.subjects.index') }}" class="nav-link {{ request()->routeIs('guru.subjects.*') ? 'active' : '' }}">
                            <i class="fas fa-book"></i> Kelola Mata Pelajaran
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('guru.grades') }}" class="nav-link {{ request()->routeIs('guru.grades') ? 'active' : '' }}">
                            <i class="fas fa-file-signature"></i> Input Nilai
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('guru.attendance') }}" class="nav-link {{ request()->routeIs('guru.attendance') ? 'active' : '' }}">
                            <i class="fas fa-calendar-check"></i> Absensi
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-bullhorn"></i> Pengumuman
                        </a>
                    </div>
                @elseif(Auth::user()->isOrangTua())
                    <div class="nav-item">
                        <a href="{{ route('parent.dashboard') }}" class="nav-link {{ request()->routeIs('parent.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('parent.attendance') }}" class="nav-link {{ request()->routeIs('parent.attendance') ? 'active' : '' }}">
                            <i class="fas fa-clock-rotate-left"></i> Kehadiran
                        </a>
                    </div>
                @endif
                
                <div class="nav-item" style="margin-top: auto; padding-top: 2rem;">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();" style="color: #fca5a5;">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </form>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="header animate-fade-in">
                <h1>@yield('header')</h1>
                <div class="user-info">
                    <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center; font-weight: bold; margin-right: 0.75rem;">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <span style="font-weight: 700; color: var(--gray-800);">{{ Auth::user()->name }}</span>
                    <span class="badge badge-primary" style="margin-left: 0.75rem; text-transform: uppercase;">
                        {{ str_replace('_', ' ', Auth::user()->role) }}
                    </span>
                </div>
            </header>

            <div class="content body animate-fade-in" style="animation-delay: 0.1s">
                @yield('content')
            </div>
        </main>
    </div>

    @yield('scripts')
</body>
</html>
