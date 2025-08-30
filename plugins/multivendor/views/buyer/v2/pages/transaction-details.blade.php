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
                    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                        <button class="w-full bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition-colors duration-200 font-medium text-sm">
                            Download Certificate
                        </button>
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
@endsection
