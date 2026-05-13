<x-app-layout>
    @section('header_title', 'DASHBOARD')

<!-- Professional Resident Analytics Cards -->
<div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4 mb-8">
    
    <!-- Total Population Card -->
    <div class="group relative overflow-hidden bg-white dark:bg-slate-800 p-6 rounded-[2.5rem] border border-slate-100 dark:border-slate-700/50 shadow-sm hover:shadow-xl hover:shadow-indigo-500/10 transition-all duration-500">
        <!-- Subtle Background Glow -->
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-indigo-500/5 rounded-full blur-2xl group-hover:bg-indigo-500/10 transition-colors"></div>
        
        <div class="relative flex items-center justify-between">
            <div class="space-y-1">
                <p class="text-[10px] font-bold text-indigo-600/80 dark:text-indigo-400 uppercase tracking-[0.15em]">Total Population</p>
                <h3 class="text-4xl font-black text-slate-900 dark:text-white tracking-tight">{{ $totalResidents }}</h3>
            </div>
            <div class="p-3 bg-gradient-to-br from-indigo-50 to-indigo-100 dark:from-indigo-900/40 dark:to-indigo-800/20 rounded-2xl shadow-inner">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
        </div>
        <div class="mt-4 flex items-center gap-1.5">
            <div class="px-2 py-0.5 bg-indigo-50 dark:bg-indigo-500/10 rounded-md">
                <span class="text-[9px] font-black text-indigo-600 dark:text-indigo-400 uppercase">Live Database</span>
            </div>
        </div>
    </div>

    <!-- Total Households Card -->
    <div class="group relative overflow-hidden bg-white dark:bg-slate-800 p-6 rounded-[2.5rem] border border-slate-100 dark:border-slate-700/50 shadow-sm hover:shadow-xl hover:shadow-rose-500/10 transition-all duration-500">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-rose-500/5 rounded-full blur-2xl group-hover:bg-rose-500/10 transition-colors"></div>
        
        <div class="relative flex items-center justify-between">
            <div class="space-y-1">
                <p class="text-[10px] font-bold text-rose-600/80 dark:text-rose-400 uppercase tracking-[0.15em]">Total Households</p>
                <h3 class="text-4xl font-black text-slate-900 dark:text-white tracking-tight">{{ $householdCount }}</h3>
            </div>
            <div class="p-3 bg-gradient-to-br from-rose-50 to-rose-100 dark:from-rose-900/40 dark:to-rose-800/20 rounded-2xl shadow-inner">
                <svg class="w-6 h-6 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            </div>
        </div>
        <div class="mt-4 flex items-center gap-1.5">
            <div class="px-2 py-0.5 bg-rose-50 dark:bg-rose-500/10 rounded-md">
                <span class="text-[9px] font-black text-rose-600 dark:text-rose-400 uppercase">Family Units</span>
            </div>
        </div>
    </div>

    <!-- Senior Citizens Card -->
    <div class="group relative overflow-hidden bg-white dark:bg-slate-800 p-6 rounded-[2.5rem] border border-slate-100 dark:border-slate-700/50 shadow-sm hover:shadow-xl hover:shadow-emerald-500/10 transition-all duration-500">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-500/5 rounded-full blur-2xl group-hover:bg-emerald-500/10 transition-colors"></div>
        
        <div class="relative flex items-center justify-between">
            <div class="space-y-1">
                <p class="text-[10px] font-bold text-emerald-600/80 dark:text-emerald-400 uppercase tracking-[0.15em]">Senior Citizens</p>
                <h3 class="text-4xl font-black text-emerald-600 dark:text-emerald-400 tracking-tight">{{ $seniorCount }}</h3>
            </div>
            <div class="p-3 bg-gradient-to-br from-emerald-50 to-emerald-100 dark:from-emerald-900/40 dark:to-emerald-800/20 rounded-2xl shadow-inner">
                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
        </div>
        <div class="mt-4 flex items-center justify-between">
            <div class="flex items-center gap-1">
                <span class="text-[10px] font-bold text-slate-400 uppercase">Priority Group</span>
            </div>
            <span class="text-[10px] font-black text-white bg-emerald-500 px-2 py-0.5 rounded-full shadow-sm shadow-emerald-500/20">
                {{ number_format(($seniorCount / max($totalResidents, 1)) * 100, 1) }}%
            </span>
        </div>
    </div>

    <!-- Blotter Cases Card -->
    <div class="group relative overflow-hidden bg-white dark:bg-slate-800 p-6 rounded-[2.5rem] border border-slate-100 dark:border-slate-700/50 shadow-sm hover:shadow-xl hover:shadow-amber-500/10 transition-all duration-500">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-amber-500/5 rounded-full blur-2xl group-hover:bg-amber-500/10 transition-colors"></div>
        
        <div class="relative flex items-center justify-between">
            <div class="space-y-1">
                <p class="text-[10px] font-bold text-amber-600/80 dark:text-amber-400 uppercase tracking-[0.15em]">Blotter Cases</p>
                <h3 class="text-4xl font-black text-slate-900 dark:text-white tracking-tight">{{ $blotterCount }}</h3>
            </div>
            <div class="p-3 bg-gradient-to-br from-amber-50 to-amber-100 dark:from-amber-900/40 dark:to-amber-800/20 rounded-2xl shadow-inner">
                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
        </div>
        <div class="mt-4 flex items-center gap-2">
            <div class="flex -space-x-1">
                <div class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></div>
            </div>
            <span class="text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-tight">Active Records</span>
        </div>
    </div>
</div>
    <!-- MAIN ANALYTICS ROW: 3 CHARTS ALIGNED -->
    <div class="grid gap-6 lg:grid-cols-3 mb-8">
        
        <!-- 1. RESIDENT DEMOGRAPHICS CARD -->
        <!-- ADJUST WIDTH/HEIGHT: Baguhin ang h-[450px] para sa height. Ang width ay automatic base sa lg:grid-cols-3 -->
        <div class="bg-white dark:bg-slate-800 p-6 rounded-[2.5rem] border border-slate-100 dark:border-slate-700 shadow-sm flex flex-col h-[450px]">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-sm font-bold text-slate-800 dark:text-slate-100 uppercase tracking-widest">Resident Demographics</h3>
                
            </div>

            <div class="flex-1 flex flex-col items-center justify-center space-y-4">
                <!-- CHART BOX SIZE: Baguhin ang w-[200px] h-[200px] para sa laki ng bilog -->
                <div class="relative w-[180px] h-[180px]">
                    <canvas id="residentPieChart"></canvas>
                </div>

                <div class="w-full space-y-2 px-2">
                    <div class="flex justify-between items-center border-b border-slate-50 dark:border-slate-700 pb-1">
                        <span class="text-[10px] font-bold text-slate-500 uppercase flex items-center gap-1">
                            <span class="w-2 h-2 rounded-full bg-[#3f51b5]"></span> Male
                        </span>
                        <span class="text-sm font-black text-slate-800 dark:text-white">{{ number_format(($maleCount / max($totalResidents, 1)) * 100) }}% ({{ $maleCount }})</span>
                    </div>
                    <div class="flex justify-between items-center border-b border-slate-50 dark:border-slate-700 pb-1">
                        <span class="text-[10px] font-bold text-slate-500 uppercase flex items-center gap-1">
                            <span class="w-2 h-2 rounded-full bg-pink-500"></span> Female
                        </span>
                        <span class="text-sm font-black text-slate-800 dark:text-white">{{ number_format(($femaleCount / max($totalResidents, 1)) * 100) }}% ({{ $femaleCount }})</span>
                    </div>
                    <div class="flex justify-between items-center pt-1">
                        <span class="text-[10px] font-bold text-slate-400 uppercase">Total Population</span>
                        <span class="text-sm font-black text-indigo-600">{{ $totalResidents }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. REVENUE INSIGHTS CARD -->
        <!-- ADJUST WIDTH/HEIGHT: Baguhin ang h-[450px] para sa height -->
        <div class="bg-white dark:bg-slate-800 p-6 rounded-[2.5rem] border border-slate-100 dark:border-slate-700 shadow-sm flex flex-col h-[450px]">
            <div class="mb-6">
                <h3 class="text-sm font-bold text-slate-800 dark:text-slate-100 uppercase tracking-widest">TRANSACTIONS</h3>
                <p class="text-[10px] text-slate-400 font-medium">Top Transaction Categories</p>
            </div>
            
            <!-- CHART BOX SIZE: Ang canvas ay mag-aadjust sa laki ng div container na ito -->
            <div class="relative flex-1 min-h-0">
                <canvas id="aestheticChart"></canvas>
            </div>
        </div>

        <!-- 3. SERVICE ALLOCATION CARD -->
        <!-- ADJUST WIDTH/HEIGHT: Baguhin ang h-[450px] para sa height -->
        <div class="bg-white dark:bg-slate-800 p-6 rounded-[2.5rem] border border-slate-100 dark:border-slate-700 shadow-sm flex flex-col h-[450px]">
            <div class="mb-6">
                <h3 class="text-sm font-bold text-slate-800 dark:text-slate-100 uppercase tracking-widest">Service Allocation</h3>
                <p class="text-[10px] text-slate-400 font-medium">Document Issuance vs Activity</p>
            </div>
            
            <div class="relative flex-1 min-h-0 flex items-center justify-center">
                <!-- CHART BOX SIZE: Baguhin ang cutout: '82%' sa JS para sa kapal ng donut line -->
                <canvas id="donutChart"></canvas>
                <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                    <span class="text-xl font-black text-slate-800 dark:text-white">{{ $issuedCertificates + $activeCases }}</span>
                    <span class="text-[8px] font-bold text-slate-400 uppercase tracking-tighter">Total Items</span>
                </div>
            </div>
            <div class="mt-4 grid grid-cols-2 gap-2">
                <div class="p-2 bg-slate-50 dark:bg-slate-900 rounded-xl text-center">
                    <p class="text-[8px] font-bold text-slate-400 uppercase">Documents</p>
                    <p class="text-xs font-black text-indigo-500">{{ $issuedCertificates }}</p>
                </div>
                <div class="p-2 bg-slate-50 dark:bg-slate-900 rounded-xl text-center">
                    <p class="text-[8px] font-bold text-slate-400 uppercase">Active Cases</p>
                    <p class="text-xs font-black text-sky-500">{{ $activeCases }}</p>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Chart.register(ChartDataLabels);
            Chart.defaults.font.family = "'Plus Jakarta Sans', 'Inter', sans-serif";
            Chart.defaults.color = '#94a3b8';

            // 1. RESIDENT PIE CHART
            const ctxPie = document.getElementById('residentPieChart').getContext('2d');
            new Chart(ctxPie, {
                type: 'pie',
                data: {
                    labels: ['Male', 'Female'],
                    datasets: [{
                        data: [{{ $maleCount }}, {{ $femaleCount }}],
                        backgroundColor: ['#3f51b5', '#26a69a'],
                        borderWidth: 0,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        datalabels: {
                            color: '#fff',
                            font: { weight: 'bold', size: 10 },
                            formatter: (value, ctx) => {
                                let sum = ctx.dataset.data.reduce((a, b) => a + b, 0);
                                return (value * 100 / sum).toFixed(0) + "%";
                            }
                        }
                    }
                }
            });

            // 2. REVENUE AREA CHART
            const ctx1 = document.getElementById('aestheticChart').getContext('2d');
            const gradient = ctx1.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(99, 102, 241, 0.15)');
            gradient.addColorStop(1, 'rgba(99, 102, 241, 0)');

            new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: {!! json_encode($transactionLabels) !!},
                    datasets: [{
                        data: {!! json_encode($transactionData) !!},
                        fill: true,
                        backgroundColor: gradient,
                        borderColor: '#6366f1',
                        borderWidth: 2,
                        tension: 0.4,
                        pointRadius: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false }, datalabels: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: 'rgba(148, 163, 184, 0.05)' }, ticks: { font: { size: 9 } } },
                        x: { grid: { display: false }, ticks: { font: { size: 9 } } }
                    }
                }
            });

            // 3. SERVICE DONUT CHART
            const ctx2 = document.getElementById('donutChart');
            new Chart(ctx2, {
                type: 'doughnut',
                data: {
                    labels: ['Active Residents', 'Documents Issued'],
                    datasets: [{
                        data: [{{ $activeCases }}, {{ $issuedCertificates }}],
                        backgroundColor: ['#0ea5e9', '#6366f1'],
                        borderWidth: 0,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '80%',
                    plugins: { 
                        legend: { display: false },
                        datalabels: { display: false }
                    }
                }
            });
        });
    </script>
</x-app-layout>