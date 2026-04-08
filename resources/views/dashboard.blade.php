<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - PiggyNote</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #f8fafc; }
        .sidebar-item-active { background-color: #fce7f3; color: #db2777; border-left: 4px solid #db2777; }
        .balance-card { background: linear-gradient(135deg, #ec4899 0%, #db2777 100%); }
        [x-cloak] { display: none !important; }
        /* Smooth scrolling for mobile */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="antialiased pb-24 md:pb-0" x-data="{ sidebarOpen: false, modalOpen: false }">
    
    <!-- Desktop Sidebar -->
    <aside class="fixed inset-y-0 left-0 bg-white shadow-2xl w-64 transform transition-transform duration-300 z-50 hidden md:block border-r border-gray-100">
        <div class="p-6">
            <div class="flex items-center gap-3 mb-10">
                <div class="bg-pink-500 p-2 rounded-xl text-white">
                    <i data-lucide="piggy-bank" class="w-6 h-6"></i>
                </div>
                <span class="text-2xl font-bold text-gray-800 tracking-tight">Piggy<span class="text-pink-600">Note</span></span>
            </div>

            <nav class="space-y-2">
                <a href="{{ route('dashboard') }}" class="sidebar-item-active flex items-center gap-3 px-4 py-3 rounded-xl font-semibold transition-all">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    Dashboard
                </a>
                <a href="{{ route('analytics') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-500 font-medium hover:bg-gray-50 hover:text-pink-600 transition-all">
                    <i data-lucide="pie-chart" class="w-5 h-5"></i>
                    Analytics
                </a>
                
                <div class="pt-10 border-t border-gray-100 mt-10 text-left">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-500 font-medium hover:bg-red-50 transition-all text-left">
                            <i data-lucide="log-out" class="w-5 h-5"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </nav>
        </div>
    </aside>

    <!-- Mobile Top Bar -->
    <div class="md:hidden flex items-center justify-between p-4 bg-white border-b border-gray-100 sticky top-0 z-40">
        <div class="flex items-center gap-2">
            <div class="bg-pink-500 p-1.5 rounded-lg text-white">
                <i data-lucide="piggy-bank" class="w-5 h-5"></i>
            </div>
            <span class="text-xl font-bold text-gray-800">PiggyNote</span>
        </div>
        <button @click="sidebarOpen = true" class="p-2 text-gray-500 hover:bg-gray-50 rounded-lg">
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>
    </div>

    <!-- Mobile Drawer Sidebar -->
    <div x-show="sidebarOpen" class="fixed inset-0 z-[60] md:hidden" x-cloak>
        <div @click="sidebarOpen = false" class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"></div>
        <aside class="fixed inset-y-0 right-0 max-w-xs w-full bg-white shadow-xl flex flex-col transition-transform" x-transition:enter="transform transition ease-in-out duration-300" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0">
            <div class="p-6 border-b border-gray-50 flex items-center justify-between">
                <span class="text-xl font-bold text-gray-800">Menu</span>
                <button @click="sidebarOpen = false" class="p-2 text-gray-400 hover:bg-gray-50 rounded-lg"><i data-lucide="x" class="w-6 h-6"></i></button>
            </div>
            <div class="p-6 flex-1 text-left">
                <nav class="space-y-4">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-4 px-4 py-3 rounded-2xl bg-pink-50 text-pink-600 font-bold">
                        <i data-lucide="layout-dashboard" class="w-6 h-6"></i> Dashboard
                    </a>
                    <a href="{{ route('analytics') }}" class="flex items-center gap-4 px-4 py-3 rounded-2xl text-gray-500 font-bold">
                        <i data-lucide="pie-chart" class="w-6 h-6"></i> Analytics
                    </a>
                </nav>
            </div>
            <div class="p-6 border-t border-gray-50">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-3 px-4 py-4 rounded-2xl text-red-500 font-bold bg-red-50">
                        <i data-lucide="log-out" class="w-6 h-6"></i> Logout
                    </button>
                </form>
            </div>
        </aside>
    </div>

    <!-- Main Content -->
    <main class="md:ml-64 min-h-screen p-4 md:p-8">
        <!-- Dashboard Header -->
        <header class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 text-left">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Halo, {{ Auth::user()->name }}! 👋</h2>
                <p class="text-gray-500 text-sm mt-1">Data keuangan Anda tersinkronisasi secara real-time.</p>
            </div>
            <button @click="modalOpen = true" class="hidden md:flex bg-pink-600 text-white px-8 py-3.5 rounded-2xl font-bold items-center gap-2 shadow-xl shadow-pink-200 hover:bg-pink-700 transition-all hover:scale-105 active:scale-95">
                <i data-lucide="plus" class="w-5 h-5"></i> Tambah Transaksi
            </button>
        </header>

        <!-- Stats Grid (Responsive Stacking) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-8 text-left">
            <div class="balance-card p-6 md:p-8 rounded-[32px] text-white shadow-xl shadow-pink-100 flex items-center justify-between relative overflow-hidden group">
                <div class="absolute right-[-20px] top-[-20px] opacity-10 group-hover:scale-110 transition-transform duration-500 flex items-center justify-center">
                    <i data-lucide="wallet" class="w-24 h-24 md:w-32 md:h-32"></i>
                </div>
                <div class="relative z-10 w-full">
                    <div class="flex items-center gap-2 mb-2">
                         <div class="bg-white/20 p-2 rounded-lg"><i data-lucide="wallet" class="w-5 h-5"></i></div>
                         <p class="text-pink-100 font-semibold text-sm">Saldo Bersih</p>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold">Rp {{ number_format($stats['total_balance'], 0, ',', '.') }}</h3>
                </div>
            </div>

            <div class="bg-white p-6 md:p-8 rounded-[32px] border border-gray-100 shadow-sm flex items-center gap-5 transition-all hover:translate-y-[-4px]">
                <div class="w-14 h-14 md:w-16 md:h-16 bg-green-100 rounded-2xl flex items-center justify-center text-green-600 flex-shrink-0">
                    <i data-lucide="trending-up" class="w-8 h-8"></i>
                </div>
                <div>
                    <p class="text-gray-400 font-medium text-sm">Pemasukan</p>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-800 text-green-600">Rp {{ number_format($stats['total_income'], 0, ',', '.') }}</h3>
                </div>
            </div>

            <div class="bg-white p-6 md:p-8 rounded-[32px] border border-gray-100 shadow-sm flex items-center gap-5 transition-all hover:translate-y-[-4px] sm:col-span-2 lg:col-span-1">
                <div class="w-14 h-14 md:w-16 md:h-16 bg-red-100 rounded-2xl flex items-center justify-center text-red-600 flex-shrink-0">
                    <i data-lucide="trending-down" class="w-8 h-8"></i>
                </div>
                <div>
                    <p class="text-gray-400 font-medium text-sm">Pengeluaran</p>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-800 text-red-500">Rp {{ number_format($stats['total_expense'], 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        <!-- Transactions Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8 text-left">
            <!-- Table Container (With Responsive Scroll) -->
            <div class="lg:col-span-2 bg-white rounded-[32px] border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 md:p-8 flex items-center justify-between border-b border-gray-50 bg-gray-50/50">
                    <h3 class="text-lg md:text-xl font-bold text-gray-800">Riwayat Transaksi</h3>
                    <div class="px-3 py-1 bg-white rounded-full text-[10px] font-bold text-pink-600 border border-pink-100 uppercase tracking-tighter">Database Aktif</div>
                </div>
                <div class="overflow-x-auto no-scrollbar">
                    <table class="w-full text-left min-w-[500px]">
                        <thead>
                            <tr class="text-gray-400 text-[10px] uppercase font-bold tracking-widest bg-gray-50/30">
                                <th class="px-6 md:px-8 py-4">Keterangan</th>
                                <th class="py-4">Kategori</th>
                                <th class="py-4">Tanggal</th>
                                <th class="px-6 md:px-8 py-4 text-right">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($recentTransactions as $transaction)
                            <tr class="group hover:bg-gray-50 transition-colors">
                                <td class="px-6 md:px-8 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="p-2.5 rounded-xl border {{ $transaction->type_label == 'income' ? 'bg-green-50 border-green-100 text-green-600' : 'bg-red-50 border-red-100 text-red-600' }}">
                                            <i data-lucide="{{ $transaction->type_label == 'income' ? 'plus-circle' : 'minus-circle' }}" class="w-4 h-4"></i>
                                        </div>
                                        <span class="font-bold text-gray-800 text-sm">{{ $transaction->description }}</span>
                                    </div>
                                </td>
                                <td class="py-5">
                                    <span class="px-3 py-1 bg-gray-100 rounded-full text-[10px] font-bold text-gray-500 uppercase">{{ $transaction->type }}</span>
                                </td>
                                <td class="py-5 text-sm text-gray-400 font-medium whitespace-nowrap">{{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}</td>
                                <td class="px-6 md:px-8 py-5 text-right font-bold text-sm {{ $transaction->type_label == 'income' ? 'text-green-600' : 'text-red-500' }}">
                                    {{ $transaction->type_label == 'income' ? '+' : '-' }}Rp{{ number_format($transaction->amount, 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="py-20 text-center text-gray-400 font-medium">Belum ada transaksi.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Side Cards -->
            <div class="space-y-6">
                <div class="bg-gray-900 p-8 rounded-[40px] text-white shadow-2xl relative overflow-hidden group">
                    <i data-lucide="sparkles" class="absolute top-[-20px] right-[-20px] w-32 h-32 opacity-10 group-hover:rotate-12 transition-transform duration-700"></i>
                    <div class="relative z-10">
                        <h4 class="text-xl font-bold mb-2">Monitor Keuangan</h4>
                        <p class="text-gray-400 text-xs mb-8 leading-relaxed">Persentase pengeluaran terhadap total pendapatan Anda.</p>
                        
                        <div class="space-y-6">
                            <div>
                                <div class="flex justify-between text-xs mb-2">
                                    <span class="text-gray-500 font-bold uppercase tracking-widest">Dana Terpakai</span>
                                    <span class="font-bold text-pink-500">{{ $stats['total_income'] > 0 ? round(($stats['total_expense'] / $stats['total_income']) * 100) : 0 }}%</span>
                                </div>
                                <div class="w-full bg-gray-800 rounded-full h-2.5 overflow-hidden">
                                    <div class="bg-gradient-to-r from-pink-500 to-purple-500 h-2.5 rounded-full transition-all duration-1000" style="width: {{ $stats['total_income'] > 0 ? min(100, ($stats['total_expense'] / $stats['total_income']) * 100) : 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-8 bg-pink-50 rounded-[40px] border border-pink-100 relative group overflow-hidden">
                    <div class="absolute right-0 bottom-0 opacity-5 group-hover:scale-125 transition-transform"><i data-lucide="info" class="w-32 h-32"></i></div>
                    <h4 class="font-bold text-pink-800 mb-3 text-lg">Tips Hemat</h4>
                    <p class="text-sm text-pink-600 leading-relaxed font-medium">Jangan lupa cek fitur **Analytics** untuk melihat pola belanja bulanan Anda!</p>
                </div>
            </div>
        </div>
    </main>

    <!-- Mobile Bottom Floating Action (Very Premium UX) -->
    <div class="fixed bottom-0 left-0 right-0 p-4 md:hidden bg-white/80 backdrop-blur-md border-t border-gray-100 flex items-center justify-between z-40 px-8">
        <a href="{{ route('dashboard') }}" class="flex flex-col items-center gap-1 text-pink-600">
            <i data-lucide="layout-dashboard" class="w-6 h-6"></i>
            <span class="text-[10px] font-bold">Beranda</span>
        </a>
        <button @click="modalOpen = true" class="bg-pink-600 p-4 rounded-full text-white shadow-xl shadow-pink-200 transform -translate-y-6 border-4 border-white">
            <i data-lucide="plus" class="w-8 h-8"></i>
        </button>
        <a href="{{ route('analytics') }}" class="flex flex-col items-center gap-1 text-gray-400">
            <i data-lucide="pie-chart" class="w-6 h-6"></i>
            <span class="text-[10px] font-bold">Statistik</span>
        </a>
    </div>

    <!-- Universal Transaction Modal (Full Responsive) -->
    <div x-show="modalOpen" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm" x-cloak>
        <div @click.away="modalOpen = false" 
             class="bg-white w-full max-w-lg rounded-[40px] overflow-hidden shadow-3xl transform transition-all"
             x-transition:enter="ease-out duration-300" x-transition:enter-start="scale-95 opacity-0" x-transition:enter-end="scale-100 opacity-100">
            
            <div class="p-6 md:p-10 text-left">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-2xl font-bold text-gray-800">Tambah Data</h3>
                    <button @click="modalOpen = false" class="p-2 hover:bg-gray-100 rounded-full transition-colors"><i data-lucide="x" class="w-6 h-6 text-gray-400"></i></button>
                </div>

                <form action="{{ route('transactions.store') }}" method="POST" class="space-y-5" x-data="{ type: 'outcome' }">
                    @csrf
                    <div class="flex bg-gray-100 p-1.5 rounded-2xl mb-8">
                        <label class="flex-1 text-center py-3 rounded-xl cursor-pointer transition-all font-bold text-sm" :class="type === 'income' ? 'bg-white shadow-sm text-pink-600' : 'text-gray-500'">
                            <input type="radio" name="type_label" value="income" x-model="type" class="hidden"> Pemasukan
                        </label>
                        <label class="flex-1 text-center py-3 rounded-xl cursor-pointer transition-all font-bold text-sm" :class="type === 'outcome' ? 'bg-white shadow-sm text-pink-600' : 'text-gray-500'">
                            <input type="radio" name="type_label" value="outcome" x-model="type" class="hidden"> Pengeluaran
                        </label>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Jumlah (Rp)</label>
                            <input type="number" name="amount" required placeholder="0" class="w-full bg-gray-50 border-2 border-transparent focus:border-pink-500 outline-none rounded-2xl py-4 px-6 font-bold text-lg">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Kategori</label>
                            <select name="category" required class="w-full bg-gray-50 border-2 border-transparent focus:border-pink-500 outline-none rounded-2xl py-4 px-6 font-bold text-sm">
                                <template x-if="type === 'income'"><optgroup label="Pemasukan"><option>Salary</option><option>Bonus</option><option>Gifts</option><option>Others</option></optgroup></template>
                                <template x-if="type === 'outcome'"><optgroup label="Pengeluaran"><option>Food & Beverages</option><option>Transportation</option><option>Household</option><option>Donation</option><option>Shopping</option><option>Entertainment</option><option>Others</option></optgroup></template>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Keterangan</label>
                        <input type="text" name="description" required placeholder="Tujuan transaksi..." class="w-full bg-gray-50 border-2 border-transparent focus:border-pink-500 outline-none rounded-2xl py-4 px-6 font-medium">
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Tanggal</label>
                        <input type="date" name="date" value="{{ date('Y-m-d') }}" required class="w-full bg-gray-50 border-2 border-transparent focus:border-pink-500 outline-none rounded-2xl py-4 px-6 font-medium">
                    </div>

                    <button type="submit" class="w-full bg-pink-600 text-white py-5 rounded-[24px] font-bold text-lg shadow-2xl shadow-pink-200 hover:bg-pink-700 transition-all mt-4 transform hover:scale-[1.02] active:scale-95">Simpan Sekarang</button>
                </form>
            </div>
        </div>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>
