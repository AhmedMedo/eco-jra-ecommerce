@extends('plugin/multivendor::buyer.v2.layouts.app')

@section('title', 'Transaction Details - Ecojarah')
@section('page-title', 'Transaction Details')

@section('content')
<div class="p-6">
    <!-- Header with Back Button -->
    <div class="flex items-center mb-6">
        <a href="{{ route('plugin.multivendor.buyer.v2.transactions') }}" 
           class="mr-4 p-2 text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-lg transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Transaction #{{ $transaction->id }}</h1>
            <p class="text-gray-600">View detailed information about this transaction</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Transaction Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Transaction Overview -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Transaction Overview</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Transaction ID</label>
                            <p class="text-lg font-semibold text-gray-900">#{{ $transaction->id }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Status</label>
                            @php
                                $statusClasses = [
                                    'completed' => 'bg-green-100 text-green-800',
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'cancelled' => 'bg-red-100 text-red-800',
                                ];
                                $statusClass = $statusClasses[$transaction->transaction_status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $statusClass }}">
                                {{ ucfirst($transaction->transaction_status) }}
                            </span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Transaction Date</label>
                            <p class="text-lg font-semibold text-gray-900">
                                {{ $transaction->transaction_date ? $transaction->transaction_date->format('M d, Y H:i:s') : 'N/A' }}
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Created Date</label>
                            <p class="text-lg font-semibold text-gray-900">{{ $transaction->created_at->format('M d, Y H:i:s') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Project Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Project Information</h2>
                </div>
                <div class="p-6">
                    @if($transaction->project)
                        <div class="flex items-start space-x-4">
                            <!-- Project Image -->
                            <div class="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center flex-shrink-0">
                                @if($transaction->project->project_image)
                                    <img src="{{ asset('/') . $transaction->project->project_image }}" 
                                         alt="{{ $transaction->project->project_name }}" 
                                         class="w-24 h-24 object-cover rounded-lg">
                                @else
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        @if($transaction->project->energy_type === 'solar')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        @elseif($transaction->project->energy_type === 'wind')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m12.728 0l-.707.707M6.343 6.343l-.707-.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                        @endif
                                    </svg>
                                @endif
                            </div>
                            
                            <!-- Project Details -->
                            <div class="flex-1">
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $transaction->project->project_name }}</h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span class="font-medium text-gray-500">Project ID:</span>
                                        <span class="text-gray-900">#{{ $transaction->project->project_id }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-500">Energy Type:</span>
                                        <span class="text-gray-900 capitalize">{{ $transaction->project->energy_type }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-500">Country:</span>
                                        <span class="text-gray-900">{{ $transaction->project->country }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-500">Vintage Year:</span>
                                        <span class="text-gray-900">{{ $transaction->project->vintage_year }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-500">Technology:</span>
                                        <span class="text-gray-900">{{ $transaction->project->technology }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-500">Project Capacity:</span>
                                        <span class="text-gray-900">{{ $transaction->project->project_capacity }} {{ $transaction->project->capacity_unit }}</span>
                                    </div>
                                </div>

                                @if($transaction->project->address)
                                    <div class="mt-3">
                                        <span class="font-medium text-gray-500">Address:</span>
                                        <span class="text-gray-900">{{ $transaction->project->address }}</span>
                                    </div>
                                @endif

                                <!-- View Project Link -->
                                <div class="mt-4">
                                    <a href="{{ route('plugin.multivendor.buyer.v2.project-details', $transaction->project->id) }}" 
                                       class="inline-flex items-center text-[#167070] hover:text-[#0f5050] font-medium text-sm">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                        View Project Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                            <p class="mt-2 text-gray-500">Project information is no longer available</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Certificate Information -->
            @if($transaction->project)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Certificate Details</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            @if($transaction->project->evident_id)
                                <div>
                                    <span class="font-medium text-gray-500">Evident ID:</span>
                                    <span class="text-gray-900">{{ $transaction->project->evident_id }}</span>
                                </div>
                            @endif
                            @if($transaction->project->issuance_date)
                                <div>
                                    <span class="font-medium text-gray-500">Issuance Date:</span>
                                    <span class="text-gray-900">{{ \Carbon\Carbon::parse($transaction->project->issuance_date)->format('M d, Y') }}</span>
                                </div>
                            @endif
                            @if($transaction->project->expiry_date)
                                <div>
                                    <span class="font-medium text-gray-500">Expiry Date:</span>
                                    <span class="text-gray-900">{{ \Carbon\Carbon::parse($transaction->project->expiry_date)->format('M d, Y') }}</span>
                                </div>
                            @endif
                            <div>
                                <span class="font-medium text-gray-500">Status:</span>
                                <span class="text-gray-900 capitalize">{{ $transaction->project->status }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Payment Information Sidebar -->
        <div class="lg:col-span-1">
            <!-- Payment Summary -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 sticky top-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Payment Summary</h2>
                </div>
                <div class="p-6 space-y-4">
                    <!-- Quantity -->
                    <div class="flex justify-between">
                        <span class="text-gray-600">Quantity</span>
                        <span class="font-semibold text-gray-900">{{ number_format($transaction->quantity_mwh, 2) }} MWh</span>
                    </div>
                    
                    <!-- Price per MWh -->
                    <div class="flex justify-between">
                        <span class="text-gray-600">Price per MWh</span>
                        <span class="font-semibold text-gray-900">EGP {{ number_format($transaction->price_per_mwh, 2) }}</span>
                    </div>
                    
                    <!-- Subtotal -->
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="font-semibold text-gray-900">EGP {{ number_format($transaction->total_amount, 2) }}</span>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-4">
                        <!-- Total -->
                        <div class="flex justify-between">
                            <span class="text-lg font-semibold text-gray-900">Total Amount</span>
                            <span class="text-lg font-bold text-gray-900">EGP {{ number_format($transaction->total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                @if($transaction->transaction_status === 'completed')
                    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 space-y-3">
                        <!-- Redemption Info -->
                        <div class="bg-blue-50 rounded-lg p-3 mb-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Total Quantity:</span>
                                <span class="font-medium">{{ number_format($transaction->quantity_mwh, 2) }} MWh</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Redeemed:</span>
                                <span class="font-medium">{{ $transaction->formatted_total_redeemed }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Remaining:</span>
                                <span class="font-medium text-green-600">{{ $transaction->formatted_remaining_quantity }}</span>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="space-y-2">
                            <button class="w-full bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition-colors duration-200 font-medium text-sm">
                                Download Certificate
                            </button>
                            
                            @if($transaction->canBeRedeemed())
                                <button id="redeemBtn" 
                                        class="w-full bg-[#167070] text-white py-2 px-4 rounded-lg hover:bg-[#0f5050] transition-colors duration-200 font-medium text-sm"
                                        data-transaction-id="{{ $transaction->id }}">
                                    Redeem IREC
                                </button>
                            @elseif($transaction->total_redeemed > 0)
                                <button id="viewHistoryBtn" 
                                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium text-sm"
                                        data-transaction-id="{{ $transaction->id }}">
                                    View Redemption History
                                </button>
                            @endif
                        </div>
                    </div>
                @elseif($transaction->transaction_status === 'pending')
                    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                        <button class="w-full bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition-colors duration-200 font-medium text-sm">
                            Cancel Transaction
                        </button>
                    </div>
                @endif

                <!-- Additional Info -->
                <div class="px-6 py-4 border-t border-gray-200">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-blue-500 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div class="text-sm text-gray-600">
                            @if($transaction->transaction_status === 'completed')
                                <p class="font-medium text-green-700">Transaction Completed</p>
                                <p>Your IREC certificate has been successfully purchased and is ready for download.</p>
                            @elseif($transaction->transaction_status === 'pending')
                                <p class="font-medium text-yellow-700">Transaction Pending</p>
                                <p>Your transaction is being processed. You will be notified once it's completed.</p>
                            @else
                                <p class="font-medium text-red-700">Transaction Cancelled</p>
                                <p>This transaction was cancelled and no payment was processed.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Redemption Modal -->
<div id="redemptionModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <!-- Modal Header -->
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Redeem IREC Certificate</h3>
                <button id="closeRedemptionModal" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Modal Content -->
            <div id="redemptionModalContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<!-- Redemption History Modal -->
<div id="redemptionHistoryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 mx-auto p-5 border w-4/5 max-w-4xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <!-- Modal Header -->
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Redemption History</h3>
                <button id="closeRedemptionHistoryModal" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Modal Content -->
            <div id="redemptionHistoryContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const redeemBtn = document.getElementById('redeemBtn');
    const redemptionModal = document.getElementById('redemptionModal');
    const redemptionHistoryModal = document.getElementById('redemptionHistoryModal');
    const closeRedemptionModal = document.getElementById('closeRedemptionModal');
    const closeRedemptionHistoryModal = document.getElementById('closeRedemptionHistoryModal');
    const redemptionModalContent = document.getElementById('redemptionModalContent');
    const redemptionHistoryContent = document.getElementById('redemptionHistoryContent');

    // Open redemption modal
    if (redeemBtn) {
        redeemBtn.addEventListener('click', function() {
            const transactionId = this.getAttribute('data-transaction-id');
            loadRedemptionForm(transactionId);
        });
    }

    // Open redemption history modal
    const viewHistoryBtn = document.getElementById('viewHistoryBtn');
    if (viewHistoryBtn) {
        viewHistoryBtn.addEventListener('click', function() {
            const transactionId = this.getAttribute('data-transaction-id');
            loadRedemptionHistory(transactionId);
            redemptionHistoryModal.classList.remove('hidden');
        });
    }

    // Close redemption modal
    closeRedemptionModal.addEventListener('click', function() {
        redemptionModal.classList.add('hidden');
    });

    // Close redemption history modal
    closeRedemptionHistoryModal.addEventListener('click', function() {
        redemptionHistoryModal.classList.add('hidden');
    });

    // Close modals when clicking outside
    redemptionModal.addEventListener('click', function(e) {
        if (e.target === redemptionModal) {
            redemptionModal.classList.add('hidden');
        }
    });

    redemptionHistoryModal.addEventListener('click', function(e) {
        if (e.target === redemptionHistoryModal) {
            redemptionHistoryModal.classList.add('hidden');
        }
    });

    // Load redemption form
    function loadRedemptionForm(transactionId) {
        fetch(`/buyer/transactions/${transactionId}/redemption/form`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                redemptionModalContent.innerHTML = `
                    <form id="redemptionForm">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Project</label>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="font-medium">${data.transaction.project_name}</p>
                                <p class="text-sm text-gray-600">${data.transaction.project_id}</p>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Available Quantity</label>
                            <div class="bg-green-50 p-3 rounded-lg">
                                <p class="font-medium text-green-700">${data.transaction.formatted_remaining_quantity}</p>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="quantity_mwh" class="block text-sm font-medium text-gray-700 mb-2">Quantity to Redeem (MWh)</label>
                            <input type="number" 
                                   id="quantity_mwh" 
                                   name="quantity_mwh" 
                                   step="0.01" 
                                   min="0.01" 
                                   max="${data.transaction.remaining_quantity}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#167070] focus:border-[#167070]"
                                   required>
                            <p class="text-xs text-gray-500 mt-1">Minimum: 0.01 MWh</p>
                        </div>

                        <div class="mb-4">
                            <label for="redemption_purpose" class="block text-sm font-medium text-gray-700 mb-2">Purpose (Optional)</label>
                            <input type="text" 
                                   id="redemption_purpose" 
                                   name="redemption_purpose" 
                                   placeholder="e.g., Carbon offset for company operations"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#167070] focus:border-[#167070]">
                        </div>

                        <div class="mb-6">
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Additional Notes (Optional)</label>
                            <textarea id="notes" 
                                      name="notes" 
                                      rows="3" 
                                      placeholder="Any additional information about this redemption..."
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#167070] focus:border-[#167070]"></textarea>
                        </div>

                        <div class="flex space-x-3">
                            <button type="button" 
                                    id="cancelRedemption" 
                                    class="flex-1 bg-gray-300 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-400 transition-colors duration-200 font-medium">
                                Cancel
                            </button>
                            <button type="submit" 
                                    class="flex-1 bg-[#167070] text-white py-2 px-4 rounded-lg hover:bg-[#0f5050] transition-colors duration-200 font-medium">
                                Submit Redemption
                            </button>
                        </div>
                    </form>

                    ${data.redemptions.length > 0 ? `
                        <div class="mt-6 pt-4 border-t border-gray-200">
                            <button type="button" 
                                    id="viewRedemptionHistory" 
                                    class="w-full bg-blue-100 text-blue-700 py-2 px-4 rounded-lg hover:bg-blue-200 transition-colors duration-200 font-medium text-sm">
                                View Redemption History (${data.redemptions.length})
                            </button>
                        </div>
                    ` : ''}
                `;

                // Add form submission handler
                document.getElementById('redemptionForm').addEventListener('submit', function(e) {
                    e.preventDefault();
                    submitRedemption(transactionId);
                });

                // Add cancel handler
                document.getElementById('cancelRedemption').addEventListener('click', function() {
                    redemptionModal.classList.add('hidden');
                });

                // Add history view handler
                const viewHistoryBtn = document.getElementById('viewRedemptionHistory');
                if (viewHistoryBtn) {
                    viewHistoryBtn.addEventListener('click', function() {
                        loadRedemptionHistory(transactionId);
                    });
                }

                redemptionModal.classList.remove('hidden');
            } else {
                showToast(data.message || 'Failed to load redemption form', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Error loading redemption form', 'error');
        });
    }

    // Submit redemption
    function submitRedemption(transactionId) {
        const form = document.getElementById('redemptionForm');
        const formData = new FormData(form);

        fetch(`/buyer/transactions/${transactionId}/redemption/process`, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast(data.message, 'success');
                redemptionModal.classList.add('hidden');
                // Reload the page to show updated redemption info
                location.reload();
            } else {
                showToast(data.message || 'Failed to submit redemption', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Error submitting redemption', 'error');
        });
    }

    // Load redemption history
    function loadRedemptionHistory(transactionId) {
        fetch(`/buyer/transactions/${transactionId}/redemptions`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log('Redemption history data:', data); // Debug log
            if (data.success && data.redemptions && data.redemptions.length > 0) {
                redemptionHistoryContent.innerHTML = `
                    <div class="space-y-4">
                        ${data.redemptions.map(redemption => `
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h4 class="font-medium text-gray-900">${redemption.redemption_reference}</h4>
                                        <p class="text-sm text-gray-600">${redemption.created_at}</p>
                                    </div>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full ${getStatusBadgeClass(redemption.redemption_status)}">
                                        ${redemption.redemption_status.charAt(0).toUpperCase() + redemption.redemption_status.slice(1)}
                                    </span>
                                </div>
                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span class="text-gray-600">Quantity:</span>
                                        <span class="font-medium">${redemption.formatted_quantity}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Remaining:</span>
                                        <span class="font-medium">${redemption.formatted_remaining_quantity || 'N/A'}</span>
                                    </div>
                                </div>
                                ${redemption.redemption_purpose ? `
                                    <div class="mt-2">
                                        <span class="text-gray-600 text-sm">Purpose:</span>
                                        <span class="text-sm">${redemption.redemption_purpose}</span>
                                    </div>
                                ` : ''}
                                ${redemption.notes ? `
                                    <div class="mt-2">
                                        <span class="text-gray-600 text-sm">Notes:</span>
                                        <span class="text-sm">${redemption.notes}</span>
                                    </div>
                                ` : ''}
                                ${redemption.review_notes ? `
                                    <div class="mt-2 p-2 bg-gray-50 rounded">
                                        <span class="text-gray-600 text-sm">Review Notes:</span>
                                        <span class="text-sm">${redemption.review_notes}</span>
                                    </div>
                                ` : ''}
                            </div>
                        `).join('')}
                    </div>
                `;

                redemptionHistoryModal.classList.remove('hidden');
            } else {
                showToast('No redemption history found', 'info');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Error loading redemption history', 'error');
        });
    }

    // Helper function for status badge classes
    function getStatusBadgeClass(status) {
        switch(status) {
            case 'pending': return 'bg-yellow-100 text-yellow-800';
            case 'approved': return 'bg-green-100 text-green-800';
            case 'rejected': return 'bg-red-100 text-red-800';
            default: return 'bg-gray-100 text-gray-800';
        }
    }

    // Toast notification function
    function showToast(message, type = 'info') {
        // Create toast element
        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${
            type === 'success' ? 'bg-green-500 text-white' :
            type === 'error' ? 'bg-red-500 text-white' :
            type === 'warning' ? 'bg-yellow-500 text-white' :
            'bg-blue-500 text-white'
        }`;
        toast.textContent = message;

        document.body.appendChild(toast);

        // Remove toast after 3 seconds
        setTimeout(() => {
            document.body.removeChild(toast);
        }, 3000);
    }
});
</script>
@endsection
