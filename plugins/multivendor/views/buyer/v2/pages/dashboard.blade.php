@extends('plugin/multivendor::buyer.v2.layouts.app')

@section('title', 'Buyer Dashboard - Ecojarah')
@section('page-title', 'Dashboard')

@section('content')
<div class="p-6">
    <!-- KPI Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-primary-teal">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total IRECs</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">3,500</p>
                    <p class="text-xs text-gray-500 mt-1">MWh</p>
                </div>
                <div class="bg-primary-teal bg-opacity-10 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-primary-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
            </div>
            <div class="flex items-center mt-3">
                <span class="text-green-600 text-sm font-medium">+12.5%</span>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Energy Consumption</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">4,200</p>
                    <p class="text-xs text-gray-500 mt-1">MWh</p>
                </div>
                <div class="bg-blue-500 bg-opacity-10 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
            </div>
            <div class="flex items-center mt-3">
                <span class="text-blue-600 text-sm font-medium">83.3%</span>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Renewable Energy</p>
                    <div class="relative w-16 h-16 mt-2">
                        <svg class="w-16 h-16 transform -rotate-90" viewBox="0 0 36 36">
                            <path
                                d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                fill="none"
                                stroke="#e5e7eb"
                                stroke-width="2"
                            />
                            <path
                                d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                fill="none"
                                stroke="#22c55e"
                                stroke-width="2"
                                stroke-dasharray="26.64, 100"
                            />
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-sm font-bold text-gray-900">83%</span>
                        </div>
                    </div>
                </div>
                <div class="bg-green-500 bg-opacity-10 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- IREC by Vintage Chart -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Total IREC by Vintage (Year)</h3>
            <div class="h-64">
                <canvas id="irecChart"></canvas>
            </div>
        </div>

        <!-- Monthly Activity -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Statistics</h3>
            </div>
            <div class="grid grid-cols-1 gap-6">
                <!-- Monthly Activity Pie Chart -->
                <div>
                    <h4 class="text-md font-medium text-gray-700 mb-3">Monthly activity</h4>
                    <div class="flex items-center justify-center">
                        <div class="relative w-48 h-48">
                            <canvas id="monthlyChart"></canvas>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-center">
                                    <p class="text-xl font-bold text-gray-900">47,482.27</p>
                                    <p class="text-sm text-gray-500">MWh</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Bid Chart -->
                <div>
                    <h4 class="text-md font-medium text-gray-700 mb-3">Total Bid</h4>
                    <div class="h-32">
                        <canvas id="bidChart"></canvas>
                    </div>
                    <div class="mt-2 flex items-center justify-center space-x-4 text-xs">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-green-500 rounded-full mr-1"></div>
                            <span class="text-gray-600">Approved</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-yellow-500 rounded-full mr-1"></div>
                            <span class="text-gray-600">Pending</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-red-500 rounded-full mr-1"></div>
                            <span class="text-gray-600">Cancelled</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Certificates Table -->
    <div class="bg-white rounded-lg shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Active Certificates</h3>
                <p class="text-sm text-gray-500">Manage your renewable energy certificates</p>
                <div class="flex items-center space-x-3">
                    <button class="btn-secondary flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                        Filter
                    </button>
                    <button class="btn-primary flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                        </svg>
                        Export
                    </button>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="table-header">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Certificate ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Project Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Country</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Volume</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Redemption</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vintage (Year)</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price (total cost)</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Avg. Price per IREC</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-primary-teal">IREC-20230001</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Benban Solar Park</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Egypt</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <span class="w-4 h-4 mr-2 text-green-500">●</span>
                                <span class="text-sm text-gray-900">Bio</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1500 MWh</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">80%</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">EGP 42500</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">EGP 45.2</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button class="bg-primary-teal text-white px-3 py-1 rounded text-sm hover:bg-primary-teal-dark transition-colors duration-200">Buy</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Activity</h3>
        <div class="space-y-4">
            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-4">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-900">New IREC Certificate Generated</p>
                    <p class="text-sm text-gray-500">500 MWh added to your portfolio</p>
                </div>
                <span class="text-sm text-gray-400">2 hours ago</span>
            </div>

            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-900">Energy Consumption Updated</p>
                    <p class="text-sm text-gray-500">Monthly consumption data refreshed</p>
                </div>
                <span class="text-sm text-gray-400">1 day ago</span>
            </div>

            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-4">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-900">Portfolio Value Increased</p>
                    <p class="text-sm text-gray-500">Your portfolio value increased by 8.5%</p>
                </div>
                <span class="text-sm text-gray-400">3 days ago</span>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Vintage (Year) IREC line chart
    const vintageCtx = document.getElementById('irecChart');
    if (vintageCtx) {
        new Chart(vintageCtx, {
            type: 'line',
            data: {
                labels: ['JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'],
                datasets: [{
                    data: [20,35,25,45,55,40,35,50,45,40,55,60],
                    borderColor: '#14b8a6',
                    backgroundColor: 'rgba(20, 184, 166, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#14b8a6',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false } },
                    y: {
                        beginAtZero: true,
                        max: 70,
                        ticks: { stepSize: 10, callback: (v) => v + 'k' }
                    }
                }
            }
        });
    }

    // Monthly activity doughnut chart
    const monthlyCtx = document.getElementById('monthlyChart');
    if (monthlyCtx) {
        new Chart(monthlyCtx, {
            type: 'doughnut',
            data: {
                labels: ['Wind','Solar','Hydro','Bio'],
                datasets: [{
                    data: [11,24,26,39],
                    backgroundColor: ['#14b8a6','#f97316','#3b82f6','#22c55e'],
                    borderWidth: 0
                }]
            },
            options: { cutout: '70%', plugins: { legend: { display: false } }, maintainAspectRatio: false }
        });
    }

    // Bid multi-line chart
    const bidCtx = document.getElementById('bidChart');
    if (bidCtx) {
        new Chart(bidCtx, {
            type: 'line',
            data: {
                labels: ['JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'],
                datasets: [
                    { data: [60,55,65,70,75,80,85,80,75,70,75,80], borderColor: '#22c55e', backgroundColor: 'transparent', borderWidth: 2, tension: 0.4, pointRadius: 0 },
                    { data: [40,45,35,50,45,40,35,45,50,55,50,45], borderColor: '#eab308', backgroundColor: 'transparent', borderWidth: 2, tension: 0.4, pointRadius: 0 },
                    { data: [20,25,30,25,20,15,20,25,20,15,20,25], borderColor: '#ef4444', backgroundColor: 'transparent', borderWidth: 2, tension: 0.4, pointRadius: 0 }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false }, ticks: { font: { size: 10 } } },
                    y: { beginAtZero: true, max: 100, ticks: { stepSize: 20, callback: (v) => v + '%', font: { size: 10 } }, grid: { color: '#f3f4f6' } }
                }
            }
        });
    }
});
</script>
@endpush
