<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics - PiggyNote</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #f8fafc; }
        .sidebar-item-active { background-color: #fce7f3; color: #db2777; border-left: 4px solid #db2777; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="antialiased pb-24 md:pb-0" x-data="{ sidebarOpen: false }">
    <!-- Desktop Sidebar (Same as dashboard) -->
    <aside class="fixed inset-y-0 left-0 bg-white shadow-2xl w-64 transform transition-transform duration-300 z-50 hidden md:block border-r border-gray-100">
        <div class="p-6">
            <div class="flex items-center gap-3 mb-10">
                <div class="bg-pink-500 p-2 rounded-xl text-white"><i data-lucide="piggy-bank" class="w-6 h-6"></i></div>
                <span class="text-2xl font-bold text-gray-800 tracking-tight">Piggy<span class="text-pink-600">Note</span></span>
            </div>
            <nav class="space-y-2">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-500 font-medium hover:bg-gray-50 hover:text-pink-600 transition-all"><i data-lucide="layout-dashboard" class="w-5 h-5"></i> Dashboard</a>
                <a href="{{ route('analytics') }}" class="sidebar-item-active flex items-center gap-3 px-4 py-3 rounded-xl font-semibold transition-all"><i data-lucide="pie-chart" class="w-5 h-5"></i> Analytics</a>
                <div class="pt-10 border-t border-gray-100 mt-10">
                    <form action="{{ route('logout') }}" method="POST">@csrf <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-500 font-medium hover:bg-red-50 transition-all text-left"><i data-lucide="log-out" class="w-5 h-5"></i> Logout</button></form>
                </div>
            </nav>
        </div>
    </aside>

    <!-- Mobile Top Bar -->
    <div class="md:hidden flex items-center justify-between p-4 bg-white border-b border-gray-100 sticky top-0 z-40">
        <div class="flex items-center gap-2">
            <div class="bg-pink-500 p-1.5 rounded-lg text-white"><i data-lucide="piggy-bank" class="w-5 h-5"></i></div>
            <span class="text-xl font-bold text-gray-800">PiggyNote</span>
        </div>
        <button @click="sidebarOpen = true" class="p-2 text-gray-500"><i data-lucide="menu" class="w-6 h-6"></i></button>
    </div>

    <!-- Main Content -->
    <main class="md:ml-64 min-h-screen p-4 md:p-8">
        <header class="mb-8 text-left">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Analytics 📊</h2>
            <p class="text-gray-500 text-sm mt-1">Laporan detail perkembangan finansial Anda.</p>
        </header>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-8 text-left">
            <div class="bg-white p-6 md:p-8 rounded-[40px] border border-gray-100 shadow-sm">
                <h3 class="text-lg font-bold text-gray-800 mb-6">Distribusi Pengeluaran</h3>
                <div id="category-pie-chart"></div>
            </div>
            <div class="bg-white p-6 md:p-8 rounded-[40px] border border-gray-100 shadow-sm">
                <h3 class="text-lg font-bold text-gray-800 mb-6">Arus Kas Bulanan</h3>
                <div id="monthly-bar-chart"></div>
            </div>
        </div>

        <div class="bg-white p-6 md:p-8 rounded-[40px] border border-gray-100 shadow-sm text-left">
            <h3 class="text-lg font-bold text-gray-800 mb-6">Rincian per Kategori</h3>
            <div class="overflow-x-auto no-scrollbar">
                <table class="w-full min-w-[400px]">
                    <thead>
                        <tr class="text-gray-400 text-[10px] uppercase font-bold tracking-widest border-b border-gray-50">
                            <th class="pb-4">Kategori</th>
                            <th class="pb-4 text-right">Total (Rp)</th>
                            <th class="pb-4 text-right">Porsi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @php $totalExp = $categoryData->sum('total'); @endphp
                        @forelse($categoryData as $data)
                        <tr>
                            <td class="py-5 font-bold text-gray-700">{{ $data->type }}</td>
                            <td class="py-5 text-right font-bold text-red-500">Rp{{ number_format($data->total, 0, ',', '.') }}</td>
                            <td class="py-5 text-right">
                                <span class="text-xs font-bold text-pink-600 bg-pink-50 px-2 py-1 rounded-lg">{{ $totalExp > 0 ? round(($data->total / $totalExp) * 100) : 0 }}%</span>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="py-10 text-center text-gray-400">Belum ada data.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Mobile Bottom Nav -->
    <div class="fixed bottom-0 left-0 right-0 p-4 md:hidden bg-white/80 backdrop-blur-md border-t border-gray-100 flex items-center justify-around z-40">
        <a href="{{ route('dashboard') }}" class="flex flex-col items-center gap-1 text-gray-400">
            <i data-lucide="layout-dashboard" class="w-6 h-6"></i>
            <span class="text-[10px] font-bold">Beranda</span>
        </a>
        <a href="{{ route('analytics') }}" class="flex flex-col items-center gap-1 text-pink-600">
            <i data-lucide="pie-chart" class="w-6 h-6"></i>
            <span class="text-[10px] font-bold">Statistik</span>
        </a>
    </div>

    <!-- Mobile Drawer (Simplified) -->
    <div x-show="sidebarOpen" class="fixed inset-0 z-[60] md:hidden" x-cloak>
        <div @click="sidebarOpen = false" class="fixed inset-0 bg-black/50 backdrop-blur-sm"></div>
        <aside class="fixed inset-y-0 right-0 max-w-xs w-64 bg-white p-6 flex flex-col shadow-2xl">
            <button @click="sidebarOpen = false" class="self-end p-2 mb-8"><i data-lucide="x" class="w-6 h-6"></i></button>
            <nav class="space-y-4 text-left">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 py-3 text-gray-500 font-bold">Dashboard</a>
                <a href="{{ route('analytics') }}" class="flex items-center gap-3 py-3 text-pink-600 font-bold">Analytics</a>
                <hr class="border-gray-50 my-4">
                <form action="{{ route('logout') }}" method="POST">@csrf <button type="submit" class="text-red-500 font-bold flex items-center gap-3">Logout</button></form>
            </nav>
        </aside>
    </div>

    <script>
        lucide.createIcons();
        const categoryLabels = @json($categoryData->pluck('type'));
        const categoryTotals = @json($categoryData->pluck('total'));
        const months = @json($monthlyIncome->pluck('month'));
        const incomeTotals = @json($monthlyIncome->pluck('total'));
        const expenseTotals = @json($monthlyExpense->pluck('total'));

        new ApexCharts(document.querySelector("#category-pie-chart"), {
            series: categoryTotals.length > 0 ? categoryTotals : [1],
            labels: categoryLabels.length > 0 ? categoryLabels : ['No Data'],
            chart: { type: 'donut', height: 350, fontFamily: 'Outfit, sans-serif' },
            colors: ['#ec4899', '#8b5cf6', '#3b82f6', '#10b981', '#f59e0b'],
            legend: { position: 'bottom' },
            stroke: { show: false },
            plotOptions: { pie: { donut: { size: '75%' } } }
        }).render();

        new ApexCharts(document.querySelector("#monthly-bar-chart"), {
            series: [{ name: 'Masuk', data: incomeTotals }, { name: 'Keluar', data: expenseTotals }],
            chart: { type: 'bar', height: 350, fontFamily: 'Outfit, sans-serif', toolbar: { show: false } },
            colors: ['#10b981', '#f43f5e'],
            plotOptions: { bar: { borderRadius: 6, columnWidth: '60%' } },
            xaxis: { categories: months.map(m => 'Bln ' + m) },
            yaxis: { show: false },
            grid: { borderColor: '#f1f5f9', strokeDashArray: 4 }
        }).render();
    </script>
</body>
</html>
