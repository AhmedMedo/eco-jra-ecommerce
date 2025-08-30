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
                        <button class="w-full mt-6 bg-[#167070] text-white py-3 px-4 rounded-lg hover:bg-[#0f5050] transition-colors duration-200 font-medium">
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
