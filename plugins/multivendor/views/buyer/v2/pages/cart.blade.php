@extends('plugin/multivendor::buyer.v2.layouts.app')

@section('title', 'Shopping Cart - Ecojarah')
@section('page-title', 'Shopping Cart')

@section('content')
<div class="p-6">
    <!-- Header Section -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Shopping Cart</h1>
        <p class="text-gray-600">Review your selected IREC certificates before proceeding to checkout</p>
    </div>

    @if($cartItems->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Cart Items ({{ $cartSummary['total_items'] }})</h2>
                        
                        <div id="cart-items-list" class="space-y-4">
                            @foreach($cartItems as $item)
                                <div class="cart-item flex items-center justify-between p-4 bg-gray-50 rounded-lg" data-uid="{{ $item->uid }}">
                                    <!-- Project Info -->
                                    <div class="flex items-center space-x-4 flex-1">
                                        <!-- Project Image -->
                                        <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                            @if($item->project && $item->project->project_image)
                                                <img src="{{ asset('/') . $item->project->project_image }}" 
                                                     alt="{{ $item->project_snapshot['project_name'] ?? 'Project' }}" 
                                                     class="w-16 h-16 object-cover rounded-lg">
                                            @else
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    @if(($item->project_snapshot['energy_type'] ?? '') === 'solar')
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                                                    @elseif(($item->project_snapshot['energy_type'] ?? '') === 'wind')
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m12.728 0l-.707.707M6.343 6.343l-.707-.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                                                    @else
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                                    @endif
                                                </svg>
                                            @endif
                                        </div>
                                        
                                        <!-- Project Details -->
                                        <div class="flex-1">
                                            <h3 class="font-semibold text-gray-900">{{ $item->project_snapshot['project_name'] ?? 'Unknown Project' }}</h3>
                                            <p class="text-sm text-gray-500">ID: #{{ $item->project_snapshot['project_id'] ?? 'N/A' }}</p>
                                            <div class="flex items-center space-x-4 mt-1 text-sm text-gray-600">
                                                <span>{{ ucfirst($item->project_snapshot['energy_type'] ?? 'Unknown') }}</span>
                                                <span>•</span>
                                                <span>{{ $item->project_snapshot['country'] ?? 'Unknown' }}</span>
                                                <span>•</span>
                                                <span>{{ $item->project_snapshot['vintage_year'] ?? 'Unknown' }} Vintage</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Quantity and Price -->
                                    <div class="flex items-center space-x-4">
                                        <!-- Quantity Controls -->
                                        <div class="flex items-center space-x-2">
                                            <label class="text-sm font-medium text-gray-700">Qty:</label>
                                            <input type="number" 
                                                   min="0.01" 
                                                   step="0.01" 
                                                   value="{{ $item->quantity_mwh }}" 
                                                   class="quantity-input w-20 px-2 py-1 text-sm border border-gray-300 rounded focus:ring-1 focus:ring-[#167070] focus:border-[#167070]"
                                                   data-uid="{{ $item->uid }}">
                                            <span class="text-sm text-gray-500">MWh</span>
                                        </div>
                                        
                                        <!-- Price -->
                                        <div class="text-right">
                                            <p class="text-sm text-gray-500">{{ $item->formatted_total }}</p>
                                            <p class="text-xs text-gray-400">EGP {{ number_format($item->price_per_mwh, 2) }}/MWh</p>
                                        </div>
                                        
                                        <!-- Remove Button -->
                                        <button class="remove-item-btn text-red-500 hover:text-red-700 p-1" data-uid="{{ $item->uid }}">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Continue Shopping -->
                        <div class="mt-6 pt-4 border-t border-gray-200">
                            <a href="{{ route('plugin.multivendor.buyer.v2.marketplace') }}" 
                               class="inline-flex items-center text-[#167070] hover:text-[#0f5050] font-medium">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 sticky top-6">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h2>
                        
                        <div id="order-summary" class="space-y-3">
                            <!-- Items Summary -->
                            <div class="flex justify-between">
                                <span class="text-gray-600">Items ({{ $cartSummary['total_items'] }})</span>
                                <span class="font-medium">{{ $cartSummary['formatted_total'] }}</span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-gray-600">Total Quantity</span>
                                <span class="font-medium">{{ number_format($cartSummary['total_quantity'], 2) }} MWh</span>
                            </div>
                            
                            <div class="border-t border-gray-200 pt-3">
                                <div class="flex justify-between">
                                    <span class="text-lg font-semibold text-gray-900">Total</span>
                                    <span class="text-lg font-bold text-gray-900">{{ $cartSummary['formatted_total'] }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Checkout Button -->
                        <button id="checkoutBtn" class="w-full mt-6 bg-[#167070] text-white py-3 px-4 rounded-lg hover:bg-[#0f5050] transition-colors duration-200 font-medium">
                            Proceed to Checkout
                        </button>
                        
                        <!-- Additional Info -->
                        <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-blue-500 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div class="text-sm text-blue-700">
                                    <p class="font-medium">Secure Transaction</p>
                                    <p>Your purchase is protected and all certificates are verified.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Empty Cart -->
        <div class="text-center py-12">
            <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2 8m2-8l2-2m0 0V9a2 2 0 114 0v2.93m-6 0l2 2"/>
            </svg>
            <h3 class="mt-2 text-lg font-medium text-gray-900">Your cart is empty</h3>
            <p class="mt-1 text-gray-500">Start shopping for IREC certificates to add items to your cart.</p>
            <div class="mt-6">
                <a href="{{ route('plugin.multivendor.buyer.v2.marketplace') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#167070] hover:bg-[#0f5050]">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Browse Marketplace
                </a>
            </div>
        </div>
    @endif
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

<!-- Payment Modal -->
<div id="paymentModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <!-- Modal Header -->
            <div class="flex items-center justify-between pb-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Payment Information</h3>
                <button id="closePaymentModal" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <!-- Modal Body -->
            <div class="mt-6">
                <form id="paymentForm" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Bank Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label for="bank_name" class="block text-sm font-medium text-gray-700 mb-2">Bank Name *</label>
                            <input type="text" 
                                   id="bank_name" 
                                   name="bank_name" 
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-1 focus:ring-[#167070] focus:border-[#167070]"
                                   placeholder="Enter bank name">
                        </div>
                        
                        <div>
                            <label for="iban" class="block text-sm font-medium text-gray-700 mb-2">IBAN *</label>
                            <input type="text" 
                                   id="iban" 
                                   name="iban" 
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-1 focus:ring-[#167070] focus:border-[#167070]"
                                   placeholder="Enter IBAN">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label for="account_number" class="block text-sm font-medium text-gray-700 mb-2">Account Number *</label>
                            <input type="text" 
                                   id="account_number" 
                                   name="account_number" 
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-1 focus:ring-[#167070] focus:border-[#167070]"
                                   placeholder="Enter account number">
                        </div>
                        
                        <div>
                            <label for="account_holder_name" class="block text-sm font-medium text-gray-700 mb-2">Account Holder Name *</label>
                            <input type="text" 
                                   id="account_holder_name" 
                                   name="account_holder_name" 
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-1 focus:ring-[#167070] focus:border-[#167070]"
                                   placeholder="Enter account holder name">
                        </div>
                    </div>
                    
                    <!-- Receipt Upload -->
                    <div class="mb-6">
                        <label for="receipt" class="block text-sm font-medium text-gray-700 mb-2">Payment Receipt (Optional)</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-gray-400 transition-colors">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="receipt" class="relative cursor-pointer bg-white rounded-md font-medium text-[#167070] hover:text-[#0f5050] focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-[#167070]">
                                        <span>Upload a file</span>
                                        <input id="receipt" name="receipt" type="file" class="sr-only" accept=".jpg,.jpeg,.png,.pdf">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, PDF up to 5MB</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Order Summary in Modal -->
                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <h4 class="text-sm font-medium text-gray-900 mb-3">Order Summary</h4>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Items ({{ $cartSummary['total_items'] }})</span>
                                <span class="font-medium">{{ $cartSummary['formatted_total'] }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Total Quantity</span>
                                <span class="font-medium">{{ number_format($cartSummary['total_quantity'], 2) }} MWh</span>
                            </div>
                            <div class="border-t border-gray-200 pt-2">
                                <div class="flex justify-between">
                                    <span class="font-semibold text-gray-900">Total</span>
                                    <span class="font-bold text-gray-900">{{ $cartSummary['formatted_total'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-3">
                        <button type="button" 
                                id="cancelPayment" 
                                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#167070]">
                            Cancel
                        </button>
                        <button type="submit" 
                                id="submitPayment" 
                                class="px-6 py-2 bg-[#167070] text-white rounded-md text-sm font-medium hover:bg-[#0f5050] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#167070] disabled:opacity-50 disabled:cursor-not-allowed">
                            <span id="submitText">Submit Payment</span>
                            <span id="submitLoading" class="hidden">
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
    // Payment Modal Functions
    const paymentModal = document.getElementById('paymentModal');
    const checkoutBtn = document.getElementById('checkoutBtn');
    const closePaymentModal = document.getElementById('closePaymentModal');
    const cancelPayment = document.getElementById('cancelPayment');
    const paymentForm = document.getElementById('paymentForm');
    const submitPayment = document.getElementById('submitPayment');
    const submitText = document.getElementById('submitText');
    const submitLoading = document.getElementById('submitLoading');

    // Open payment modal
    checkoutBtn.addEventListener('click', function() {
        paymentModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    });

    // Close payment modal
    function closeModal() {
        paymentModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        paymentForm.reset();
    }

    closePaymentModal.addEventListener('click', closeModal);
    cancelPayment.addEventListener('click', closeModal);

    // Close modal when clicking outside
    paymentModal.addEventListener('click', function(e) {
        if (e.target === paymentModal) {
            closeModal();
        }
    });

    // Handle form submission
    paymentForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Show loading state
        submitPayment.disabled = true;
        submitText.classList.add('hidden');
        submitLoading.classList.remove('hidden');

        // Create FormData
        const formData = new FormData(paymentForm);

        // Submit payment
        fetch('{{ route("plugin.multivendor.buyer.v2.checkout.process") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast('Payment submitted successfully! Your transaction is pending review.', 'success');
                closeModal();
                // Redirect to transactions page or show success message
                setTimeout(() => {
                    window.location.href = '{{ route("plugin.multivendor.buyer.v2.transactions") }}';
                }, 2000);
            } else {
                showToast(data.message || 'Failed to submit payment', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('An error occurred while submitting payment', 'error');
        })
        .finally(() => {
            // Reset button state
            submitPayment.disabled = false;
            submitText.classList.remove('hidden');
            submitLoading.classList.add('hidden');
        });
    });

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

    // Update quantity functionality
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('quantity-input')) {
            const input = e.target;
            const uid = input.dataset.uid;
            const quantity = parseFloat(input.value);
            
            if (!quantity || quantity <= 0) {
                showToast('Please enter a valid quantity', 'error');
                return;
            }
            
            updateCartItem(uid, quantity);
        }
    });
    
    // Remove item functionality
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-item-btn')) {
            const button = e.target.closest('.remove-item-btn');
            const uid = button.dataset.uid;
            
            if (confirm('Are you sure you want to remove this item from your cart?')) {
                removeCartItem(uid);
            }
        }
    });
    
    // Update cart item
    function updateCartItem(uid, quantity) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
        
        fetch('{{ route("plugin.multivendor.buyer.v2.cart.update") }}', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({
                uid: uid,
                quantity_mwh: quantity
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast('Cart updated successfully!');
                location.reload(); // Reload to show updated totals
            } else {
                showToast(data.message || 'Failed to update cart', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Error updating cart', 'error');
        });
    }
    
    // Remove cart item
    function removeCartItem(uid) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
        
        fetch('{{ route("plugin.multivendor.buyer.v2.cart.remove") }}', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({
                uid: uid
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast('Item removed from cart!');
                location.reload(); // Reload to show updated cart
            } else {
                showToast(data.message || 'Failed to remove item', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Error removing item', 'error');
        });
    }
});
</script>
@endpush
