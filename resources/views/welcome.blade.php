<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PiggyNote - Smart Finance Tracking</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #fdf2f8; }
        .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.3); }
        .text-gradient {
            background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .bg-gradient-premium { background: linear-gradient(135deg, #fce7f3 0%, #f3e8ff 100%); }
        .blob {
            position: absolute;
            width: 300px; height: 300px;
            background: linear-gradient(135deg, rgba(236, 72, 153, 0.2) 0%, rgba(139, 92, 246, 0.2) 100%);
            filter: blur(80px); border-radius: 50%; z-index: -1;
        }
        @media (min-width: 768px) { .blob { width: 500px; height: 500px; } }
        .floating { animation: floating 6s ease-in-out infinite; }
        @keyframes floating { 0% { transform: translateY(0px); } 50% { transform: translateY(-20px); } 100% { transform: translateY(0px); } }
    </style>
</head>
<body class="antialiased overflow-x-hidden">
    <div class="blob top-[-5%] left-[-5%]"></div>
    <div class="blob bottom-[-5%] right-[-5%]" style="background: linear-gradient(135deg, rgba(139, 92, 246, 0.2) 0%, rgba(236, 72, 153, 0.2) 100%);"></div>

    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 px-4 py-4 md:px-6">
        <div class="max-w-7xl mx-auto flex items-center justify-between glass px-4 md:px-6 py-3 rounded-2xl shadow-sm">
            <div class="flex items-center gap-2">
                <div class="bg-pink-500 p-1.5 rounded-xl shadow-lg shadow-pink-200">
                    <i data-lucide="piggy-bank" class="text-white w-5 h-5"></i>
                </div>
                <span class="text-lg md:text-xl font-bold text-gray-800">Piggy<span class="text-pink-600">Note</span></span>
            </div>
            
            <div class="hidden lg:flex items-center gap-8 text-gray-600 font-medium">
                <a href="#" class="hover:text-pink-600 transition-colors">Features</a>
                <a href="#" class="hover:text-pink-600 transition-colors">Analytics</a>
            </div>

            <div class="flex items-center gap-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-pink-600 text-white rounded-xl font-bold text-sm shadow-lg shadow-pink-200">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 font-bold text-sm px-2 hover:text-pink-600">Login</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-pink-600 text-white rounded-xl font-bold text-sm shadow-lg shadow-pink-200">Join</a>
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="pt-32 md:pt-48 pb-20 px-6">
        <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-6 md:space-y-8 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-pink-100 text-pink-700 border border-pink-200 shadow-sm mx-auto lg:mx-0">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-pink-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-pink-500"></span>
                    </span>
                    <span class="text-[10px] md:text-xs font-bold uppercase tracking-wider">Cerdas Dalam Mengelola Keuangan</span>
                </div>
                
                <h1 class="text-4xl md:text-7xl font-bold text-gray-900 leading-[1.1]">
                    Kelola Uang <br class="hidden md:block"/>
                    <span class="text-gradient">Lebih Cerdas.</span>
                </h1>
                
                <p class="text-lg md:text-xl text-gray-600 leading-relaxed max-w-lg mx-auto lg:mx-0">
                    Lacak setiap rupiah, visualisasikan pengeluaran, dan capai target tabungan Anda lebih cepat.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 pt-4 justify-center lg:justify-start px-8 sm:px-0">
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-8 py-4 bg-gray-900 text-white rounded-2xl font-bold text-lg shadow-xl hover:bg-black transition-all flex items-center justify-center gap-2 group">
                            Ke Dashboard
                            <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-gray-900 text-white rounded-2xl font-bold text-lg shadow-xl hover:bg-black transition-all flex items-center justify-center gap-2 group">
                            Mulai Sekarang
                            <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                        <a href="{{ route('login') }}" class="px-8 py-4 bg-white text-gray-800 border border-gray-200 rounded-2xl font-bold text-lg shadow-md hover:bg-gray-50 transition-all flex items-center justify-center gap-2">
                            Masuk
                            <i data-lucide="log-in" class="w-5 h-5 text-pink-500"></i>
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Preview Card (Responsive Floating) -->
            <div class="relative hidden sm:block mt-20 lg:mt-0">
                <div class="relative z-10 floating">
                    <div class="glass p-6 md:p-8 rounded-[40px] shadow-2xl border border-white/50 bg-white/40 max-w-lg mx-auto">
                        <div class="flex items-center justify-between mb-8">
                            <div class="text-left">
                                <h3 class="text-sm md:text-lg font-bold text-gray-800 uppercase tracking-widest opacity-50">Saldo Bulanan</h3>
                                <p class="text-2xl md:text-4xl font-bold text-pink-600">Rp 12.450.000</p>
                            </div>
                            <div class="p-3 md:p-4 bg-pink-500/10 rounded-2xl text-pink-600">
                                <i data-lucide="trending-up" class="w-6 h-6 md:w-8 md:h-8"></i>
                            </div>
                        </div>
                        <div class="h-32 md:h-48 w-full bg-gradient-premium rounded-3xl flex items-end justify-between p-4 gap-2 mb-6 overflow-hidden">
                             <div class="w-full bg-pink-400 h-1/2 rounded-t-lg opacity-40"></div>
                             <div class="w-full bg-pink-500 h-3/4 rounded-t-lg opacity-60"></div>
                             <div class="w-full bg-pink-600 h-full rounded-t-lg"></div>
                             <div class="w-full bg-pink-400 h-2/3 rounded-t-lg opacity-60"></div>
                        </div>
                    </div>
                </div>
                <div class="absolute top-[-20px] right-[-20px] w-48 h-48 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
            </div>
        </div>
    </header>

    <!-- Features Section (Responsive Grid) -->
    <section class="py-20 bg-white text-center">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                <h2 class="text-pink-600 font-bold uppercase tracking-widest text-xs">Fitur Utama</h2>
                <h3 class="text-3xl md:text-5xl font-bold text-gray-900 leading-tight">Kendali penuh atas finansial Anda</h3>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                <div class="p-8 rounded-[40px] border border-gray-100 hover:bg-pink-50/30 transition-all text-left">
                    <div class="w-12 h-12 bg-pink-100 rounded-2xl flex items-center justify-center mb-6 text-pink-600"><i data-lucide="zap" class="w-6 h-6"></i></div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Instan</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">Catat transaksi hanya dalam hitungan detik dengan interface yang intuitif.</p>
                </div>
                <div class="p-8 rounded-[40px] border border-gray-100 hover:bg-purple-50/30 transition-all text-left">
                    <div class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center mb-6 text-purple-600"><i data-lucide="pie-chart" class="w-6 h-6"></i></div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Visual</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">Grafik distribusi pengeluaran yang memudahkan Anda melakukan evaluasi.</p>
                </div>
                <div class="p-8 rounded-[40px] border border-gray-100 hover:bg-blue-50/30 transition-all text-left md:col-span-2 lg:col-span-1">
                    <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 text-blue-600"><i data-lucide="shield-check" class="w-6 h-6"></i></div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Aman</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">Data Anda disimpan secara lokal dan terenkripsi untuk keamanan maksimal.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-12 border-t border-gray-100 bg-gray-50 text-center">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-2">
                <div class="bg-pink-500 p-1 rounded-lg"><i data-lucide="piggy-bank" class="text-white w-4 h-4"></i></div>
                <span class="font-bold text-gray-800">PiggyNote</span>
            </div>
            <p class="text-gray-400 text-xs">&copy; {{ date('Y') }} PiggyNote. All rights reserved.</p>
        </div>
    </footer>

    <script>lucide.createIcons();</script>
</body>
</html>
