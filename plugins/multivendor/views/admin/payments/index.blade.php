@extends('core::base.layouts.master')

@section('title')
    {{ translate('IREC Payment Management') }}
@endsection

@section('custom_css')
    <style>
        .payment-status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        .status-pending { background-color: #fef3c7; color: #92400e; }
        .status-approved { background-color: #d1fae5; color: #065f46; }
        .status-rejected { background-color: #fee2e2; color: #991b1b; }
    </style>
@endsection

@section('main_content')
<div class="p-6">
    <!-- Header Section -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">IREC Payment Management</h1>
        <p class="text-gray-600">Review and manage IREC certificate payments</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Payments</p>
                    <p class="text-2xl font-semibold text-gray-900" id="totalPayments">-</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Pending Review</p>
                    <p class="text-2xl font-semibold text-gray-900" id="pendingPayments">-</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Approved</p>
                    <p class="text-2xl font-semibold text-gray-900" id="approvedPayments">-</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Rejected</p>
                    <p class="text-2xl font-semibold text-gray-900" id="rejectedPayments">-</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8 px-6" aria-label="Tabs">
                <button class="tab-button active py-4 px-1 border-b-2 border-[#167070] font-medium text-sm text-[#167070]" data-status="all">
                    All Payments
                </button>
                <button class="tab-button py-4 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300" data-status="pending">
                    Pending Review
                </button>
                <button class="tab-button py-4 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300" data-status="approved">
                    Approved
                </button>
                <button class="tab-button py-4 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300" data-status="rejected">
                    Rejected
                </button>
            </nav>
        </div>
    </div>

    <!-- Payments Table -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Payment Records</h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buyer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Project</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bank Info</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submitted</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody id="paymentsTableBody" class="bg-white divide-y divide-gray-200">
                    <!-- Payment rows will be loaded here -->
                </tbody>
            </table>
        </div>
        
        <!-- Loading State -->
        <div id="loadingState" class="text-center py-8">
            <svg class="animate-spin h-8 w-8 text-gray-400 mx-auto" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <p class="mt-2 text-sm text-gray-500">Loading payments...</p>
        </div>
        
        <!-- Empty State -->
        <div id="emptyState" class="hidden text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No payments found</h3>
            <p class="mt-1 text-sm text-gray-500">No payments match the current filter.</p>
        </div>
    </div>
</div>

<!-- Payment Details Modal -->
<div id="paymentDetailsModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <!-- Modal Header -->
            <div class="flex items-center justify-between pb-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Payment Details</h3>
                <button id="closePaymentDetailsModal" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <!-- Modal Body -->
            <div id="paymentDetailsContent" class="mt-6">
                <!-- Payment details will be loaded here -->
            </div>
        </div>
    </div>
</div>

<!-- Action Modal -->
<div id="actionModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/3 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <!-- Modal Header -->
            <div class="flex items-center justify-between pb-4 border-b border-gray-200">
                <h3 id="actionModalTitle" class="text-lg font-semibold text-gray-900">Action Required</h3>
                <button id="closeActionModal" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <!-- Modal Body -->
            <div class="mt-6">
                <form id="actionForm">
                    @csrf
                    <input type="hidden" id="actionPaymentId" name="payment_id">
                    <input type="hidden" id="actionType" name="action_type">
                    
                    <div class="mb-4">
                        <label for="actionNotes" class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                        <textarea id="actionNotes" 
                                  name="notes" 
                                  rows="4" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-1 focus:ring-[#167070] focus:border-[#167070]"
                                  placeholder="Add notes about this action..."></textarea>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button type="button" 
                                id="cancelAction" 
                                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#167070]">
                            Cancel
                        </button>
                        <button type="submit" 
                                id="submitAction" 
                                class="px-6 py-2 bg-[#167070] text-white rounded-md text-sm font-medium hover:bg-[#0f5050] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#167070]">
                            <span id="actionSubmitText">Submit</span>
                            <span id="actionSubmitLoading" class="hidden">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Processing...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    let currentStatus = 'all';
    
    // Load initial data
    loadPaymentStats();
    loadPayments();
    
    // Tab functionality
    document.querySelectorAll('.tab-button').forEach(button => {
        button.addEventListener('click', function() {
            // Update active tab
            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('active', 'border-[#167070]', 'text-[#167070]');
                btn.classList.add('border-transparent', 'text-gray-500');
            });
            
            this.classList.add('active', 'border-[#167070]', 'text-[#167070]');
            this.classList.remove('border-transparent', 'text-gray-500');
            
            // Update current status and reload payments
            currentStatus = this.dataset.status;
            loadPayments();
        });
    });
    
    // Modal functionality
    const paymentDetailsModal = document.getElementById('paymentDetailsModal');
    const actionModal = document.getElementById('actionModal');
    
    document.getElementById('closePaymentDetailsModal').addEventListener('click', () => {
        paymentDetailsModal.classList.add('hidden');
    });
    
    document.getElementById('closeActionModal').addEventListener('click', () => {
        actionModal.classList.add('hidden');
    });
    
    document.getElementById('cancelAction').addEventListener('click', () => {
        actionModal.classList.add('hidden');
    });
    
    // Close modals when clicking outside
    [paymentDetailsModal, actionModal].forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });
    });
    
    // Action form submission
    document.getElementById('actionForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const paymentId = document.getElementById('actionPaymentId').value;
        const actionType = document.getElementById('actionType').value;
        const notes = document.getElementById('actionNotes').value;
        
        // Show loading state
        const submitBtn = document.getElementById('submitAction');
        const submitText = document.getElementById('actionSubmitText');
        const submitLoading = document.getElementById('actionSubmitLoading');
        
        submitBtn.disabled = true;
        submitText.classList.add('hidden');
        submitLoading.classList.remove('hidden');
        
        // Submit action
        const url = actionType === 'approve' ? 
            `{{ route("plugin.multivendor.admin.irec.payments.approve", ":id") }}`.replace(':id', paymentId) : 
            `{{ route("plugin.multivendor.admin.irec.payments.reject", ":id") }}`.replace(':id', paymentId);
            
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ notes: notes })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast(data.message, 'success');
                actionModal.classList.add('hidden');
                loadPayments();
                loadPaymentStats();
            } else {
                showToast(data.message || 'Action failed', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('An error occurred', 'error');
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitText.classList.remove('hidden');
            submitLoading.classList.add('hidden');
        });
    });
    
    function loadPaymentStats() {
        fetch('{{ route("plugin.multivendor.admin.irec.payments.stats") }}')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('totalPayments').textContent = data.stats.total_payments;
                    document.getElementById('pendingPayments').textContent = data.stats.pending_payments;
                    document.getElementById('approvedPayments').textContent = data.stats.approved_payments;
                    document.getElementById('rejectedPayments').textContent = data.stats.rejected_payments;
                }
            })
            .catch(error => {
                console.error('Error loading stats:', error);
            });
    }
    
    function loadPayments() {
        const tableBody = document.getElementById('paymentsTableBody');
        const loadingState = document.getElementById('loadingState');
        const emptyState = document.getElementById('emptyState');
        
        // Show loading state
        tableBody.innerHTML = '';
        loadingState.classList.remove('hidden');
        emptyState.classList.add('hidden');
        
        const url = currentStatus === 'all' ? 
            '{{ route("plugin.multivendor.admin.irec.payments.list") }}' : 
            `{{ route("plugin.multivendor.admin.irec.payments.list") }}?status=${currentStatus}`;
            
        fetch(url)
            .then(response => response.json())
            .then(data => {
                loadingState.classList.add('hidden');
                
                if (data.success && data.payments.length > 0) {
                    tableBody.innerHTML = data.payments.map(payment => `
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                #${payment.id}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                ${payment.buyer ? payment.buyer.name : 'Unknown'}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                ${payment.transaction && payment.transaction.project ? payment.transaction.project.project_name : 'Unknown Project'}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                EGP ${parseFloat(payment.transaction ? payment.transaction.total_amount : 0).toFixed(2)}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                ${payment.bank_name}<br>
                                <span class="text-xs text-gray-400">${payment.iban}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full ${getStatusBadgeClass(payment.payment_status)}">
                                    ${getStatusLabel(payment.payment_status)}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                ${new Date(payment.submitted_at).toLocaleDateString()}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button onclick="viewPaymentDetails(${payment.id})" class="text-[#167070] hover:text-[#0f5050] mr-3">View</button>
                                ${payment.payment_status === 'pending' ? `
                                    <button onclick="showActionModal(${payment.id}, 'approve')" class="text-green-600 hover:text-green-900 mr-3">Approve</button>
                                    <button onclick="showActionModal(${payment.id}, 'reject')" class="text-red-600 hover:text-red-900">Reject</button>
                                ` : ''}
                            </td>
                        </tr>
                    `).join('');
                } else {
                    emptyState.classList.remove('hidden');
                }
            })
            .catch(error => {
                console.error('Error loading payments:', error);
                loadingState.classList.add('hidden');
                emptyState.classList.remove('hidden');
            });
    }
    
    function getStatusLabel(status) {
        const labels = {
            'pending': 'Pending Review',
            'approved': 'Approved',
            'rejected': 'Rejected'
        };
        return labels[status] || 'Unknown';
    }
    
    function getStatusBadgeClass(status) {
        const classes = {
            'pending': 'bg-yellow-100 text-yellow-800',
            'approved': 'bg-green-100 text-green-800',
            'rejected': 'bg-red-100 text-red-800'
        };
        return classes[status] || 'bg-gray-100 text-gray-800';
    }
    
    // Global functions for buttons
    window.viewPaymentDetails = function(paymentId) {
        fetch(`{{ route("plugin.multivendor.admin.irec.payments.details", ":id") }}`.replace(':id', paymentId))
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const payment = data.payment;
                    document.getElementById('paymentDetailsContent').innerHTML = `
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Payment ID</label>
                                    <p class="mt-1 text-sm text-gray-900">#${payment.id}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Status</label>
                                    <span class="mt-1 inline-flex px-2 py-1 text-xs font-semibold rounded-full ${getStatusBadgeClass(payment.payment_status)}">
                                        ${getStatusLabel(payment.payment_status)}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Buyer</label>
                                    <p class="mt-1 text-sm text-gray-900">${payment.buyer ? payment.buyer.name : 'Unknown'}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Project</label>
                                    <p class="mt-1 text-sm text-gray-900">${payment.transaction && payment.transaction.project ? payment.transaction.project.project_name : 'Unknown Project'}</p>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Amount</label>
                                    <p class="mt-1 text-sm text-gray-900">EGP ${parseFloat(payment.transaction ? payment.transaction.total_amount : 0).toFixed(2)}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Quantity</label>
                                    <p class="mt-1 text-sm text-gray-900">${payment.transaction ? payment.transaction.quantity_mwh : 0} MWh</p>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Bank Information</label>
                                <div class="mt-1 p-3 bg-gray-50 rounded-md">
                                    <p class="text-sm text-gray-900"><strong>Bank:</strong> ${payment.bank_name}</p>
                                    <p class="text-sm text-gray-900"><strong>IBAN:</strong> ${payment.iban}</p>
                                    <p class="text-sm text-gray-900"><strong>Account Number:</strong> ${payment.account_number}</p>
                                    <p class="text-sm text-gray-900"><strong>Account Holder:</strong> ${payment.account_holder_name}</p>
                                </div>
                            </div>
                            
                            ${payment.receipt_path ? `
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Receipt</label>
                                <a href="/storage/${payment.receipt_path}" target="_blank" class="mt-1 inline-flex items-center text-sm text-[#167070] hover:text-[#0f5050]">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    View Receipt
                                </a>
                            </div>
                            ` : ''}
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Submitted At</label>
                                    <p class="mt-1 text-sm text-gray-900">${new Date(payment.submitted_at).toLocaleString()}</p>
                                </div>
                                ${payment.reviewed_at ? `
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Reviewed At</label>
                                    <p class="mt-1 text-sm text-gray-900">${new Date(payment.reviewed_at).toLocaleString()}</p>
                                </div>
                                ` : ''}
                            </div>
                            
                            ${payment.notes ? `
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Notes</label>
                                <p class="mt-1 text-sm text-gray-900">${payment.notes}</p>
                            </div>
                            ` : ''}
                        </div>
                    `;
                    paymentDetailsModal.classList.remove('hidden');
                }
            })
            .catch(error => {
                console.error('Error loading payment details:', error);
                showToast('Failed to load payment details', 'error');
            });
    };
    
    window.showActionModal = function(paymentId, actionType) {
        document.getElementById('actionPaymentId').value = paymentId;
        document.getElementById('actionType').value = actionType;
        document.getElementById('actionNotes').value = '';
        
        const title = actionType === 'approve' ? 'Approve Payment' : 'Reject Payment';
        const submitText = actionType === 'approve' ? 'Approve' : 'Reject';
        
        document.getElementById('actionModalTitle').textContent = title;
        document.getElementById('actionSubmitText').textContent = submitText;
        
        if (actionType === 'reject') {
            document.getElementById('actionNotes').required = true;
            document.getElementById('actionNotes').placeholder = 'Please provide a reason for rejection...';
        } else {
            document.getElementById('actionNotes').required = false;
            document.getElementById('actionNotes').placeholder = 'Add notes about this approval (optional)...';
        }
        
        actionModal.classList.remove('hidden');
    };
    
    function showToast(message, type = 'success') {
        // Simple toast implementation
        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 z-50 p-4 rounded-md shadow-lg ${
            type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
        }`;
        toast.textContent = message;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.remove();
        }, 3000);
    }
});
</script>
@endpush
