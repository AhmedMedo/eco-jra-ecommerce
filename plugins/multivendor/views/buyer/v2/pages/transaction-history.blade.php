@extends('plugin/multivendor::buyer.v2.layouts.app')

@section('title', 'Transaction History - Ecojarah')
@section('page-title', 'Transaction History')

@section('content')
<div class="p-6">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Transaction History</h1>
                <p class="text-gray-600">View and manage your IREC certificate purchase history</p>
            </div>
            
            <!-- Quick Actions -->
            <div class="flex space-x-3">
                <button id="exportBtn" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 text-sm flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Export
                </button>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-500">Total Transactions</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $transactionStats['total_transactions'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-500">Total Spent</p>
                        <p class="text-2xl font-bold text-gray-900">EGP {{ number_format($transactionStats['total_spent'], 2) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-purple-100 rounded-lg">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-500">Total Quantity</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($transactionStats['total_quantity_purchased'], 2) }} MWh</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-yellow-100 rounded-lg">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-500">Success Rate</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $transactionStats['completion_rate'] }}%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Filters</h3>
                <button id="toggleFilters" class="text-gray-600 hover:text-gray-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
            </div>
            
            <div id="filtersContent" class="space-y-4">
                <form id="filterForm" method="GET" action="{{ route('plugin.multivendor.buyer.v2.transactions') }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
                        <!-- Status Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-[#167070] focus:border-[#167070] text-sm">
                                <option value="">All Statuses</option>
                                @foreach($availableStatuses as $value => $label)
                                    <option value="{{ $value }}" {{ ($filters['status'] ?? '') === $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Date From -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date From</label>
                            <input type="date" name="date_from" value="{{ $filters['date_from'] ?? '' }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-[#167070] focus:border-[#167070] text-sm">
                        </div>

                        <!-- Date To -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date To</label>
                            <input type="date" name="date_to" value="{{ $filters['date_to'] ?? '' }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-[#167070] focus:border-[#167070] text-sm">
                        </div>

                        <!-- Project Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Project Name</label>
                            <input type="text" name="project_name" value="{{ $filters['project_name'] ?? '' }}" 
                                   placeholder="Search projects..." 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-[#167070] focus:border-[#167070] text-sm">
                        </div>

                        <!-- Amount Min -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Min Amount (EGP)</label>
                            <input type="number" name="amount_min" value="{{ $filters['amount_min'] ?? '' }}" 
                                   min="0" step="0.01" placeholder="0.00" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-[#167070] focus:border-[#167070] text-sm">
                        </div>

                        <!-- Amount Max -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Max Amount (EGP)</label>
                            <input type="number" name="amount_max" value="{{ $filters['amount_max'] ?? '' }}" 
                                   min="0" step="0.01" placeholder="0.00" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-[#167070] focus:border-[#167070] text-sm">
                        </div>
                    </div>

                    <!-- Filter Actions -->
                    <div class="flex justify-end space-x-3 mt-4">
                        <a href="{{ route('plugin.multivendor.buyer.v2.transactions') }}" 
                           class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-gray-300 text-sm">
                            Reset
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 buyer-primary text-white rounded-lg buyer-primary-hover focus:outline-none focus:ring-2 focus:ring-[#167070] text-sm">
                            Apply Filters
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">
                    Transactions ({{ $transactions->total() }})
                </h3>
                
                <!-- Per Page Selector -->
                <div class="flex items-center space-x-2">
                    <label class="text-sm text-gray-600">Show:</label>
                    <select onchange="changePerPage(this.value)" class="px-2 py-1 border border-gray-300 rounded text-sm">
                        <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('per_page', 10) == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </div>
            </div>
        </div>

        @if($transactions->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaction</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Project</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($transactions as $transaction)
                            <tr class="hover:bg-gray-50">
                                <!-- Transaction ID -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">#{{ $transaction->id }}</div>
                                    <div class="text-xs text-gray-500">{{ $transaction->created_at->format('M d, Y') }}</div>
                                </td>

                                <!-- Project Info -->
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $transaction->project->project_name ?? 'N/A' }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ ucfirst($transaction->project->energy_type ?? 'Unknown') }} • 
                                        {{ $transaction->project->country ?? 'Unknown' }}
                                    </div>
                                </td>

                                <!-- Quantity -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ number_format($transaction->quantity_mwh, 2) }} MWh</div>
                                    <div class="text-xs text-gray-500">EGP {{ number_format($transaction->price_per_mwh, 2) }}/MWh</div>
                                </td>

                                <!-- Amount -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">EGP {{ number_format($transaction->total_amount, 2) }}</div>
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusClasses = [
                                            'completed' => 'bg-green-100 text-green-800',
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'cancelled' => 'bg-red-100 text-red-800',
                                        ];
                                        $statusClass = $statusClasses[$transaction->transaction_status] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $statusClass }}">
                                        {{ ucfirst($transaction->transaction_status) }}
                                    </span>
                                </td>

                                <!-- Date -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $transaction->transaction_date ? $transaction->transaction_date->format('M d, Y H:i') : 'N/A' }}
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('plugin.multivendor.buyer.v2.transactions.details', $transaction->id) }}" 
                                       class="text-[#167070] hover:text-[#0f5050] font-medium">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $transactions->appends(request()->query())->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">No transactions found</h3>
                <p class="mt-1 text-gray-500">You haven't made any transactions yet or no transactions match your filters.</p>
                <div class="mt-6">
                    <a href="{{ route('plugin.multivendor.buyer.v2.marketplace') }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#167070] hover:bg-[#0f5050]">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Start Shopping
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Toast Notification -->
<div id="toastNotification" class="hidden fixed top-4 right-4 z-50">
    <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-4 max-w-sm">
        <div class="flex items-center">
            <div id="toastIcon" class="flex-shrink-0 mr-3">
                <!-- Success Icon -->
                <svg id="successIcon" class="w-5 h-5 text-green-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <!-- Error Icon -->
                <svg id="errorIcon" class="w-5 h-5 text-red-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </div>
            <div class="flex-1">
                <p id="toastMessage" class="text-sm font-medium text-gray-900"></p>
            </div>
            <button id="closeToast" class="ml-3 text-gray-400 hover:text-gray-600">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Toast Notification Functions
    function showToast(message, type = 'success') {
        const toast = document.getElementById('toastNotification');
        const toastMessage = document.getElementById('toastMessage');
        const successIcon = document.getElementById('successIcon');
        const errorIcon = document.getElementById('errorIcon');
        
        toastMessage.textContent = message;
        
        if (type === 'success') {
            successIcon.classList.remove('hidden');
            errorIcon.classList.add('hidden');
        } else {
            successIcon.classList.add('hidden');
            errorIcon.classList.remove('hidden');
        }
        
        toast.classList.remove('hidden');
        
        setTimeout(() => {
            hideToast();
        }, 3000);
    }
    
    function hideToast() {
        const toast = document.getElementById('toastNotification');
        toast.classList.add('hidden');
    }
    
    document.getElementById('closeToast').addEventListener('click', hideToast);

    // Toggle Filters
    const toggleFilters = document.getElementById('toggleFilters');
    const filtersContent = document.getElementById('filtersContent');
    
    toggleFilters.addEventListener('click', function() {
        filtersContent.classList.toggle('hidden');
        const icon = toggleFilters.querySelector('svg');
        icon.classList.toggle('rotate-180');
    });

    // Export functionality
    const exportBtn = document.getElementById('exportBtn');
    exportBtn.addEventListener('click', function() {
        // Get current filters
        const form = document.getElementById('filterForm');
        const formData = new FormData(form);
        const params = new URLSearchParams(formData);
        
        // Build export URL with current filters
        const exportUrl = '{{ route("plugin.multivendor.buyer.v2.transactions.export") }}?' + params.toString();
        
        // Download file
        window.location.href = exportUrl;
        showToast('Export started! Your file will download shortly.');
    });

    // Change per page
    window.changePerPage = function(perPage) {
        const url = new URL(window.location);
        url.searchParams.set('per_page', perPage);
        url.searchParams.set('page', 1); // Reset to first page
        window.location.href = url.toString();
    };
});
</script>
@endpush
