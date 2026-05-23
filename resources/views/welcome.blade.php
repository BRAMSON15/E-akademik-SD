<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Manajemen Sekolah Modern - Solusi digital terintegrasi untuk mengelola data siswa, absensi, nilai (e-rapor), dan komunikasi sekolah.">
    <title>Sistem Manajemen Sekolah - Beranda</title>
    
    <!-- Google Fonts: Plus Jakarta Sans & Playfair Display -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet"> 
    <!-- Tailwind CSS Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome 6.4.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Alpine.js for interactive elements -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Tailwind Play CDN Configuration -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f4f6fe',
                            100: '#eaedfcf',
                            200: '#d9dffb',
                            300: '#bac4f7',
                            400: '#94a1f1',
                            500: '#6875eb',
                            600: '#4f55df',
                            700: '#3e41ca',
                            800: '#3537a6',
                            900: '#2f3185',
                            950: '#1d1e4e',
                        },
                        guru: {
                            50: '#f0fdf4',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                        },
                        ortu: {
                            50: '#fef8e6',
                            500: '#f59e0b',
                            600: '#d97706',
                            700: '#b45309',
                        }
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'float-slow': 'floatSlow 8s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-12px)' },
                        },
                        floatSlow: {
                            '0%, 100%': { transform: 'translateY(0px) rotate(0deg)' },
                            '50%': { transform: 'translateY(-8px) rotate(1deg)' },
                        }
                    }
                }
            }
        }
    </script>

    <style type="text/tailwindcss">
        @layer utilities {
            .glassmorphism {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.3);
            }
            .glassmorphism-dark {
                background: rgba(15, 23, 42, 0.75);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
            .mesh-gradient {
                background-color: #f4f6fe;
                background-image: 
                    radial-gradient(at 0% 0%, rgba(217, 224, 251, 0.5) 0px, transparent 50%),
                    radial-gradient(at 100% 0%, rgba(234, 179, 8, 0.1) 0px, transparent 50%),
                    radial-gradient(at 100% 100%, rgba(244, 246, 254, 0.8) 0px, transparent 50%),
                    radial-gradient(at 0% 100%, rgba(104, 117, 235, 0.15) 0px, transparent 50%);
            }
            .mesh-gradient-dark {
                background-color: #0f172a;
                background-image: 
                    radial-gradient(at 0% 0%, rgba(79, 85, 223, 0.25) 0px, transparent 50%),
                    radial-gradient(at 100% 100%, rgba(219, 39, 119, 0.1) 0px, transparent 50%);
            }
        }
    </style>
</head>
<body class="bg-brand-50 text-gray-800 font-sans antialiased selection:bg-brand-500 selection:text-white overflow-x-hidden">
    <!-- Navigation Header -->
    <nav class="sticky top-0 z-50 transition-all duration-300 w-full bg-white/70 backdrop-blur-md border-b border-gray-200/50"
         x-data="{ isOpen: false, isScrolled: false }"
         x-init="window.addEventListener('scroll', () => { isScrolled = window.scrollY > 10 })"
         :class="isScrolled ? 'shadow-sm py-2 bg-white/90' : 'py-4'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <!-- Logo & Brand -->
                <a href="#" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-500 to-brand-700 flex items-center justify-center shadow-md shadow-brand-500/20 group-hover:scale-105 transition-all duration-300">
                        <i class="fas fa-graduation-cap text-white text-xl"></i>
                    </div>
                    <div class="flex flex-col">
                        <!-- <span class="text-lg font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-brand-900 to-brand-700 leading-tight">SD NEGERI KARYA</span> -->
                        <span class="text-[10px] font-bold text-gray-500 tracking-wider uppercase">Sistem Informasi Akademik</span>
                    </div>
                </a>

                <!-- Desktop Navigation Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-sm font-semibold text-brand-900 hover:text-brand-600 transition-colors">Beranda</a>
                    <a href="#features" class="text-sm font-semibold text-gray-600 hover:text-brand-600 transition-colors">Fitur</a>
                    <a href="#roles" class="text-sm font-semibold text-gray-600 hover:text-brand-600 transition-colors">Peran</a>
                    <a href="#how-to" class="text-sm font-semibold text-gray-600 hover:text-brand-600 transition-colors">Cara Kerja</a>
                </div>
                <!-- Mobile Menu Button -->
                <div class="flex items-center md:hidden">
                    <button @click="isOpen = !isOpen" class="inline-flex items-center justify-center p-2 rounded-xl text-gray-500 hover:text-brand-600 hover:bg-brand-50 focus:outline-none transition-colors" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <i class="fas" :class="isOpen ? 'fa-times text-xl' : 'fa-bars text-xl'"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div class="md:hidden" x-show="isOpen" x-collapse x-cloak>
            <div class="px-4 pt-2 pb-6 space-y-2 bg-white border-t border-gray-100 shadow-lg">
                <a href="#" @click="isOpen = false" class="block px-4 py-3 rounded-xl text-base font-bold text-brand-900 hover:bg-brand-50">Beranda</a>
                <a href="#features" @click="isOpen = false" class="block px-4 py-3 rounded-xl text-base font-medium text-gray-600 hover:bg-brand-50">Fitur</a>
                <a href="#roles" @click="isOpen = false" class="block px-4 py-3 rounded-xl text-base font-medium text-gray-600 hover:bg-brand-50">Peran</a>
                <a href="#how-to" @click="isOpen = false" class="block px-4 py-3 rounded-xl text-base font-medium text-gray-600 hover:bg-brand-50">Cara Kerja</a>
                <a href="#faq" @click="isOpen = false" class="block px-4 py-3 rounded-xl text-base font-medium text-gray-600 hover:bg-brand-50">FAQ</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative mesh-gradient overflow-hidden py-16 sm:py-24 lg:py-32">
        <!-- Floating Blur Circles -->
        <div class="absolute top-1/4 left-1/4 w-72 h-72 bg-brand-300 rounded-full mix-blend-multiply filter blur-[80px] opacity-20 animate-pulse-slow"></div>
        <div class="absolute top-1/3 right-1/4 w-80 h-80 bg-pink-300 rounded-full mix-blend-multiply filter blur-[100px] opacity-20 animate-pulse-slow" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-1/4 right-1/3 w-64 h-64 bg-indigo-300 rounded-full mix-blend-multiply filter blur-[80px] opacity-30 animate-pulse-slow" style="animation-delay: 4s;"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                <!-- Text Column -->
                <div class="lg:col-span-6 text-center lg:text-left space-y-6 sm:space-y-8 animate-fade-in">
                    <!-- Brand Pill Badge -->
                    <div class="inline-flex items-center space-x-2 bg-brand-500/10 border border-brand-500/20 text-brand-700 px-4 py-1.5 rounded-full text-xs sm:text-sm font-bold tracking-wide">
                        <span class="flex h-2 w-2 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-brand-600"></span>
                        </span>
                        <span>Sistem Manajemen Sekolah Generasi Baru</span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-[1.1] tracking-tight">
                        Mengelola Sekolah Kini Lebih <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-600 via-indigo-600 to-pink-600">Mudah & Efisien</span>
                    </h1>
                    
                    <p class="text-base sm:text-lg lg:text-xl text-gray-600 font-medium max-w-xl mx-auto lg:mx-0 leading-relaxed">
                        Satu platform digital terintegrasi untuk menghubungkan sekolah, guru, siswa, dan orang tua guna menciptakan ekosistem akademik yang transparan dan dinamis.
                    </p>

                    <!-- CTAs -->
                    <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4 pt-2">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 rounded-2xl text-base font-bold text-white bg-gradient-to-r from-brand-600 to-brand-700 hover:from-brand-700 hover:to-brand-800 shadow-xl shadow-brand-600/20 hover:shadow-brand-600/35 hover:-translate-y-0.5 transition-all duration-300">
                                    <i class="fas fa-sign-in-alt mr-2.5"></i> Masuk Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 rounded-2xl text-base font-bold text-white bg-gradient-to-r from-brand-600 to-brand-700 hover:from-brand-700 hover:to-brand-800 shadow-xl shadow-brand-600/20 hover:shadow-brand-600/35 hover:-translate-y-0.5 transition-all duration-300">
                                    <i class="fas fa-sign-in-alt mr-2.5"></i> Mulai Sekarang
                                </a>
                            @endauth
                        @endif
                        <a href="#features" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 rounded-2xl text-base font-bold text-gray-700 bg-white/80 hover:bg-white border border-gray-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 backdrop-blur-sm">
                            <i class="fas fa-arrow-down mr-2.5 text-xs text-gray-500"></i> Pelajari Fitur
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- User Roles Section -->
    <section id="roles" class="py-20 sm:py-28 bg-gray-50 border-y border-gray-200/50 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-80 h-80 bg-brand-200/20 rounded-full blur-[80px] -z-10"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-pink-100/30 rounded-full blur-[80px] -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 sm:mb-22">
                <span class="text-xs sm:text-sm font-extrabold text-brand-600 uppercase tracking-widest bg-brand-50 px-4 py-1.5 rounded-full">Akses Terkelola</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mt-4 leading-tight">
                    Hak Akses Berdasarkan Peran
                </h2>
                <p class="text-base sm:text-lg text-gray-500 mt-4">
                    Sistem dirancang dengan portal khusus yang dipersonalisasi sesuai kebutuhan masing-masing pengguna.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
                <!-- Admin Card -->
                <div class="bg-white rounded-[32px] shadow-lg shadow-gray-200/50 border border-gray-100 flex flex-col justify-between overflow-hidden hover:shadow-2xl hover:shadow-brand-500/10 transition-all duration-300 hover:-translate-y-1">
                    <div class="p-8 sm:p-10">
                        <div class="flex items-center justify-between mb-8">
                            <span class="px-3.5 py-1 rounded-full text-xs font-bold bg-brand-50 text-brand-700 border border-brand-100">Portal Utama</span>
                            <div class="w-12 h-12 rounded-2xl bg-brand-500 flex items-center justify-center text-white shadow-md shadow-brand-500/30">
                                <i class="fas fa-user-shield text-xl"></i>
                            </div>
                        </div>
                        <h3 class="text-2xl font-extrabold text-gray-900 mb-2">Administrator</h3>
                        <p class="text-gray-500 text-sm mb-6">Memegang kendali penuh atas konfigurasi sistem dan manajemen data inti.</p>
                        
                        <div class="w-full h-px bg-gray-100 mb-6"></div>

                        <ul class="space-y-4">
                            <li class="flex items-start text-sm text-gray-600 font-medium">
                                <span class="text-brand-500 bg-brand-50 rounded-full p-0.5 mr-3 mt-0.5 w-5 h-5 flex items-center justify-center text-[10px]">
                                    <i class="fas fa-check"></i>
                                </span>
                                Kelola & buat akun guru, siswa, wali murid
                            </li>
                            <li class="flex items-start text-sm text-gray-600 font-medium">
                                <span class="text-brand-500 bg-brand-50 rounded-full p-0.5 mr-3 mt-0.5 w-5 h-5 flex items-center justify-center text-[10px]">
                                    <i class="fas fa-check"></i>
                                </span>
                                Konfigurasi data kelas, mata pelajaran, & KKM
                            </li>
                            <li class="flex items-start text-sm text-gray-600 font-medium">
                                <span class="text-brand-500 bg-brand-50 rounded-full p-0.5 mr-3 mt-0.5 w-5 h-5 flex items-center justify-center text-[10px]">
                                    <i class="fas fa-check"></i>
                                </span>
                                Monitoring aktivitas & ekspor laporan menyeluruh
                            </li>
                            <li class="flex items-start text-sm text-gray-600 font-medium">
                                <span class="text-brand-500 bg-brand-50 rounded-full p-0.5 mr-3 mt-0.5 w-5 h-5 flex items-center justify-center text-[10px]">
                                    <i class="fas fa-check"></i>
                                </span>
                                Publikasi pengumuman tingkat sekolah
                            </li>
                        </ul>
                    </div>
                    <div class="px-8 pb-8 pt-4">
                        <!-- <a href="{{ route('login') }}" class="w-full py-3 px-4 inline-flex items-center justify-center rounded-2xl text-sm font-bold bg-brand-50 text-brand-700 hover:bg-brand-600 hover:text-white transition-all duration-300">
                            Masuk Portal Admin <i class="fas fa-arrow-right ml-2 text-xs"></i>
                        </a> -->
                    </div>
                </div>

                <!-- Guru Card -->
                <div class="bg-white rounded-[32px] shadow-lg shadow-gray-200/50 border border-gray-100 flex flex-col justify-between overflow-hidden hover:shadow-2xl hover:shadow-guru-500/10 transition-all duration-300 hover:-translate-y-1">
                    <div class="p-8 sm:p-10">
                        <div class="flex items-center justify-between mb-8">
                            <span class="px-3.5 py-1 rounded-full text-xs font-bold bg-guru-50 text-guru-700 border border-green-100">Portal Akademik</span>
                            <div class="w-12 h-12 rounded-2xl bg-guru-600 flex items-center justify-center text-white shadow-md shadow-guru-600/30">
                                <i class="fas fa-chalkboard-user text-xl"></i>
                            </div>
                        </div>
                        <h3 class="text-2xl font-extrabold text-gray-900 mb-2">Guru Pendidik</h3>
                        <p class="text-gray-500 text-sm mb-6">Membantu guru dalam kegiatan administrasi kelas dengan lebih praktis.</p>
                        
                        <div class="w-full h-px bg-gray-100 mb-6"></div>

                        <ul class="space-y-4">
                            <li class="flex items-start text-sm text-gray-600 font-medium">
                                <span class="text-guru-600 bg-guru-50 rounded-full p-0.5 mr-3 mt-0.5 w-5 h-5 flex items-center justify-center text-[10px]">
                                    <i class="fas fa-check"></i>
                                </span>
                                Penginputan nilai harian, UTS, & UAS siswa
                            </li>
                            <li class="flex items-start text-sm text-gray-600 font-medium">
                                <span class="text-guru-600 bg-guru-50 rounded-full p-0.5 mr-3 mt-0.5 w-5 h-5 flex items-center justify-center text-[10px]">
                                    <i class="fas fa-check"></i>
                                </span>
                                Pencatatan presensi siswa secara berkala
                            </li>
                            <li class="flex items-start text-sm text-gray-600 font-medium">
                                <span class="text-guru-600 bg-guru-50 rounded-full p-0.5 mr-3 mt-0.5 w-5 h-5 flex items-center justify-center text-[10px]">
                                    <i class="fas fa-check"></i>
                                </span>
                                Akses data profil akademik siswa di kelas asuhan
                            </li>
                            <li class="flex items-start text-sm text-gray-600 font-medium">
                                <span class="text-guru-600 bg-guru-50 rounded-full p-0.5 mr-3 mt-0.5 w-5 h-5 flex items-center justify-center text-[10px]">
                                    <i class="fas fa-check"></i>
                                </span>
                                Publikasi materi & pengumuman tugas kelas
                            </li>
                        </ul>
                    </div>
                    <div class="px-8 pb-8 pt-4">
                        <!-- <a href="{{ route('login') }}" class="w-full py-3 px-4 inline-flex items-center justify-center rounded-2xl text-sm font-bold bg-guru-50 text-guru-700 hover:bg-guru-600 hover:text-white transition-all duration-300">
                            Masuk Portal Guru <i class="fas fa-arrow-right ml-2 text-xs"></i>
                        </a> -->
                    </div>
                </div>

                <!-- Parents Card -->
                <div class="bg-white rounded-[32px] shadow-lg shadow-gray-200/50 border border-gray-100 flex flex-col justify-between overflow-hidden hover:shadow-2xl hover:shadow-ortu-500/10 transition-all duration-300 hover:-translate-y-1">
                    <div class="p-8 sm:p-10">
                        <div class="flex items-center justify-between mb-8">
                            <span class="px-3.5 py-1 rounded-full text-xs font-bold bg-ortu-50 text-ortu-700 border border-amber-100">Portal Monitoring</span>
                            <div class="w-12 h-12 rounded-2xl bg-ortu-600 flex items-center justify-center text-white shadow-md shadow-ortu-600/30">
                                <i class="fas fa-users-line text-xl"></i>
                            </div>
                        </div>
                        <h3 class="text-2xl font-extrabold text-gray-900 mb-2">Orang Tua / Wali</h3>
                        <p class="text-gray-500 text-sm mb-6">Memudahkan orang tua memantau perkembangan belajar anak kapan saja.</p>
                        
                        <div class="w-full h-px bg-gray-100 mb-6"></div>

                        <ul class="space-y-4">
                            <li class="flex items-start text-sm text-gray-600 font-medium">
                                <span class="text-ortu-600 bg-ortu-50 rounded-full p-0.5 mr-3 mt-0.5 w-5 h-5 flex items-center justify-center text-[10px]">
                                    <i class="fas fa-check"></i>
                                </span>
                                Pantau grafik capaian nilai & e-rapor anak
                            </li>
                            <li class="flex items-start text-sm text-gray-600 font-medium">
                                <span class="text-ortu-600 bg-ortu-50 rounded-full p-0.5 mr-3 mt-0.5 w-5 h-5 flex items-center justify-center text-[10px]">
                                    <i class="fas fa-check"></i>
                                </span>
                                Notifikasi kehadiran & kepatuhan sekolah anak
                            </li>
                            <li class="flex items-start text-sm text-gray-600 font-medium">
                                <span class="text-ortu-600 bg-ortu-50 rounded-full p-0.5 mr-3 mt-0.5 w-5 h-5 flex items-center justify-center text-[10px]">
                                    <i class="fas fa-check"></i>
                                </span>
                                Terima pengumuman resmi & agenda sekolah terbaru
                            </li>
                            <li class="flex items-start text-sm text-gray-600 font-medium">
                                <span class="text-ortu-600 bg-ortu-50 rounded-full p-0.5 mr-3 mt-0.5 w-5 h-5 flex items-center justify-center text-[10px]">
                                    <i class="fas fa-check"></i>
                                </span>
                                Akses berkas & informasi administrasi murid
                            </li>
                        </ul>
                    </div>
                    <div class="px-8 pb-8 pt-4">
                        <!-- <a href="{{ route('login') }}" class="w-full py-3 px-4 inline-flex items-center justify-center rounded-2xl text-sm font-bold bg-ortu-50 text-ortu-700 hover:bg-ortu-600 hover:text-white transition-all duration-300">
                            Masuk Portal Wali <i class="fas fa-arrow-right ml-2 text-xs"></i>
                        </a> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How it Works / Timeline Section -->
    <section id="how-to" class="py-20 sm:py-28 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 sm:mb-20">
                <span class="text-xs sm:text-sm font-extrabold text-brand-600 uppercase tracking-widest bg-brand-50 px-4 py-1.5 rounded-full">Langkah Mudah</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mt-4 leading-tight">
                    Cara Mulai Menggunakan Sistem
                </h2>
                <p class="text-base sm:text-lg text-gray-500 mt-4">
                    Ikuti 4 tahapan ringkas berikut untuk mengaktifkan dan mengoperasikan portal sekolah Anda.
                </p>
            </div>

            <!-- Steps Roadmap Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative">
                <!-- Decorative Connecting Line for Desktop -->
                <div class="hidden md:block absolute top-[44px] left-[12%] right-[12%] h-0.5 bg-gradient-to-r from-brand-300 via-indigo-200 to-brand-300 -z-0"></div>
                
                <!-- Step 1 -->
                <div class="relative z-10 text-center flex flex-col items-center group">
                    <div class="w-20 h-20 rounded-full bg-brand-50 border-4 border-white shadow-xl shadow-brand-500/10 flex items-center justify-center text-2xl font-extrabold text-brand-600 group-hover:scale-110 transition-transform duration-300">
                        1
                    </div>
                    <h3 class="text-lg font-extrabold text-gray-900 mt-6 mb-2">Registrasi Akun</h3>
                    <p class="text-gray-500 text-sm leading-relaxed max-w-[220px]">
                        Administrator mendaftarkan data profil guru, murid, dan wali murid ke dalam sistem basis data.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="relative z-10 text-center flex flex-col items-center group">
                    <div class="w-20 h-20 rounded-full bg-brand-50 border-4 border-white shadow-xl shadow-brand-500/10 flex items-center justify-center text-2xl font-extrabold text-brand-600 group-hover:scale-110 transition-transform duration-300">
                        2
                    </div>
                    <h3 class="text-lg font-extrabold text-gray-900 mt-6 mb-2">Masuk ke Portal</h3>
                    <p class="text-gray-500 text-sm leading-relaxed max-w-[220px]">
                        Setiap pengguna masuk menggunakan kredensial (NIP/NISN & password) yang telah dibagikan admin.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="relative z-10 text-center flex flex-col items-center group">
                    <div class="w-20 h-20 rounded-full bg-brand-50 border-4 border-white shadow-xl shadow-brand-500/10 flex items-center justify-center text-2xl font-extrabold text-brand-600 group-hover:scale-110 transition-transform duration-300">
                        3
                    </div>
                    <h3 class="text-lg font-extrabold text-gray-900 mt-6 mb-2">Kelola & Akses Data</h3>
                    <p class="text-gray-500 text-sm leading-relaxed max-w-[220px]">
                        Guru menginput nilai/absensi. Orang tua & murid dapat langsung melihat laporan di layar.
                    </p>
                </div>

                <!-- Step 4 -->
                <div class="relative z-10 text-center flex flex-col items-center group">
                    <div class="w-20 h-20 rounded-full bg-brand-600 border-4 border-white shadow-xl shadow-brand-600/30 flex items-center justify-center text-2xl font-extrabold text-white group-hover:scale-110 transition-transform duration-300">
                        4
                    </div>
                    <h3 class="text-lg font-extrabold text-gray-900 mt-6 mb-2">Cetak Laporan</h3>
                    <p class="text-gray-500 text-sm leading-relaxed max-w-[220px]">
                        Data yang terkumpul diolah otomatis menjadi berkas digital siap ekspor, contohnya data E-Rapor Semester.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Dynamic Call-To-Action (CTA) Section -->
    <section class="py-12 sm:py-20 px-4 bg-white relative">
        <div class="max-w-6xl mx-auto rounded-[32px] sm:rounded-[48px] bg-gradient-to-br from-brand-950 via-brand-900 to-indigo-950 text-white relative overflow-hidden shadow-2xl shadow-brand-950/20 p-8 sm:p-16 text-center">
            <!-- Radial Glow -->
            <div class="absolute -top-40 -left-40 w-96 h-96 bg-brand-500 rounded-full filter blur-[120px] opacity-25"></div>
            <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-pink-500 rounded-full filter blur-[120px] opacity-20"></div>
            
            <div class="relative z-10 max-w-2xl mx-auto space-y-6 sm:space-y-8">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-[1.15] tracking-tight">
                    Siap Memulai Transformasi Sekolah Anda?
                </h2>
                <p class="text-sm sm:text-base lg:text-lg text-brand-200/90 leading-relaxed max-w-xl mx-auto">
                    Masuk ke dalam dashboard terpadu dan rasakan kemudahan pengelolaan sekolah dengan efisiensi maksimal mulai hari ini.
                </p>
                <div class="pt-2 flex flex-col sm:flex-row justify-center items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 bg-white text-brand-900 rounded-2xl font-bold hover:bg-gray-100 hover:scale-[1.02] shadow-xl shadow-black/10 transition-all duration-300">
                                <i class="fas fa-home mr-2.5 text-sm"></i> Dashboard Anda
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 bg-white text-brand-900 rounded-2xl font-bold hover:bg-gray-100 hover:scale-[1.02] shadow-xl shadow-black/10 transition-all duration-300">
                                <i class="fas fa-sign-in-alt mr-2.5"></i> Masuk Sekarang
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-950 text-gray-400 py-16 border-t border-gray-900 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-10 md:gap-8 pb-12 border-b border-gray-900">
                <!-- Column 1: Brand Info -->
                <div class="md:col-span-5 space-y-6">
                    <a href="#" class="flex items-center space-x-3 group">
                        <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-brand-500 to-brand-700 flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-white text-base"></i>
                        </div>
                        <!-- <span class="text-base font-extrabold text-white tracking-wide">SD NEGERI KARYA</span> -->
                    </a>
                    <p class="text-sm text-gray-400 leading-relaxed max-w-sm">
                        Platform manajemen sekolah tingkat dasar terpadu, menghadirkan transparansi nilai akademis, presensi digital, serta keandalan administrasi sekolah.
                    </p>
                    <div class="flex space-x-3 pt-2">
                        <a href="#" class="w-8 h-8 rounded-lg bg-gray-900 hover:bg-brand-600 hover:text-white flex items-center justify-center transition-colors text-xs">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-lg bg-gray-900 hover:bg-brand-600 hover:text-white flex items-center justify-center transition-colors text-xs">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-lg bg-gray-900 hover:bg-brand-600 hover:text-white flex items-center justify-center transition-colors text-xs">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <!-- Column 2: Quick Links Features -->
                <div class="md:col-span-2.5 space-y-4">
                    <h4 class="text-sm font-bold text-white uppercase tracking-wider">Fitur Sistem</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="#features" class="hover:text-white transition-colors">Data Siswa</a></li>
                        <li><a href="#features" class="hover:text-white transition-colors">E-Rapor Digital</a></li>
                        <li><a href="#features" class="hover:text-white transition-colors">Absensi Siswa</a></li>
                        <li><a href="#features" class="hover:text-white transition-colors">Pengumuman</a></li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Copyright bar -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-gray-500">
                <!-- <p>&copy; 2026 SD Negeri Karya. Semua hak dilindungi undang-undang.</p> -->
                <div class="flex space-x-4 mt-4 sm:mt-0">
                    <a href="#" class="hover:text-white transition-colors">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-white transition-colors">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
