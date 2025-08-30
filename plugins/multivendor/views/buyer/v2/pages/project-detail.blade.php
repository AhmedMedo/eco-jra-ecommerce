@extends('plugin/multivendor::buyer.v2.layouts.app')

@section('title', $project->project_name . ' - Ecojarah')
@section('page-title', 'Project Details')

@section('content')
<div class="p-6">
    <!-- Project Header -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
        <!-- Project Image -->
        <div class="relative">
            @if($project->project_image)
                <img src="{{ asset('/') . $project->project_image }}"
                     alt="{{ $project->project_name }}"
                     class="w-full h-48 object-cover rounded-t-lg">
            @else
                <div class="w-full h-64 bg-gray-200 rounded-t-lg flex items-center justify-center">
                    <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            @endif
            <div class="absolute top-4 right-4 flex space-x-2">
                <button class="p-2 bg-white rounded-lg shadow-sm hover:bg-gray-50">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                    </svg>
                </button>
                <button class="p-2 bg-white rounded-lg shadow-sm hover:bg-gray-50">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"/>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Project Info -->
        <div class="p-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-3">{{ $project->project_name }}</h1>
            <p class="text-sm text-gray-500 mb-4">Project ID: #{{ $project->project_id }}</p>
            
            <!-- Project Details Row -->
            <div class="flex items-center space-x-6 text-sm text-gray-600">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    {{ $project->country }}
                </div>
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        @if($project->energy_type === 'solar')
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        @elseif($project->energy_type === 'wind')
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m12.728 0l-.707.707M6.343 6.343l-.707-.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        @elseif($project->energy_type === 'hydro')
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        @else
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        @endif
                    </svg>
                    {{ ucfirst($project->energy_type) }}
                </div>
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ $project->vintage_year }} Vintage
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content with Tabs and Bulk Purchase -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column: Tabs Content -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <!-- Tabs Navigation -->
                <div class="border-b border-gray-200">
                    <nav class="flex space-x-8 px-6" aria-label="Tabs">
                        <button id="overview-tab" 
                                class="tab-button py-4 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300"
                                onclick="switchTab('overview')">
                            Overview
                        </button>
                        <button id="project-data-tab" 
                                class="tab-button py-4 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300"
                                onclick="switchTab('project-data')">
                            Project Data
                        </button>
                    </nav>
                </div>

                <!-- Tab Content -->
                <div class="p-6">
                    <!-- Overview Tab Content -->
                    <div id="overview-content" class="tab-content">
                        <!-- Map Section -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">Project Location</h3>
                            <div class="bg-gray-100 rounded-lg h-48 flex items-center justify-center">
                                <div class="text-center">
                                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <p class="text-gray-500">Map of {{ $project->country }} - Project Location</p>
                                    @if($project->city)
                                        <p class="text-sm text-gray-400">{{ $project->city }}, {{ $project->region }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">Description</h3>
                            <p class="text-gray-700 leading-relaxed">
                                {{ $project->description }}
                            </p>
                        </div>

                        <!-- Project Link -->
                        @if($project->project_link)
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3">Project Link</h3>
                                <a href="{{ $project->project_link }}" 
                                   class="text-blue-600 hover:text-blue-800 underline" target="_blank">
                                    {{ $project->project_link }}
                                </a>
                            </div>
                        @endif

                        <!-- Key Metrics -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h4 class="text-sm font-medium text-gray-500 mb-1">Capacity</h4>
                                <p class="text-xl font-bold text-gray-900">{{ number_format($project->project_capacity) }}</p>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h4 class="text-sm font-medium text-gray-500 mb-1">Technology</h4>
                                <p class="text-xl font-bold text-gray-900">{{ $project->technology }}</p>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h4 class="text-sm font-medium text-gray-500 mb-1">Available Quantity</h4>
                                <p class="text-xl font-bold text-gray-900">{{ number_format($project->available_quantity_mwh) }} MWh</p>
                            </div>
                        </div>
                    </div>

                    <!-- Project Data Tab Content -->
                    <div id="project-data-content" class="tab-content hidden">
                        <!-- Certificate Details -->
                        <div class="space-y-4">
                            @if($project->evident_id)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Evident ID</label>
                                    <p class="text-lg font-semibold text-gray-900">{{ $project->evident_id }}</p>
                                </div>
                            @endif
                            @if($project->issuance_date)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Issuance Date</label>
                                    <p class="text-lg font-semibold text-gray-900">{{ $project->issuance_date->format('Y-m-d') }}</p>
                                </div>
                            @endif
                            @if($project->expiry_date)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Expiry</label>
                                    <p class="text-lg font-semibold text-gray-900">{{ $project->expiry_date->format('Y-m-d') }}</p>
                                </div>
                            @endif
                        </div>

                        <!-- Certifications -->
                        @if($project->certifications && $project->certifications->count() > 0)
                            <div class="mt-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3">Certifications</h3>
                                <div class="space-y-3">
                                    @foreach($project->certifications as $certification)
                                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                            <div class="flex items-center">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-3">
                                                    {{ $certification->certification_type }}
                                                </span>
                                                @if($certification->certification_number)
                                                    <span class="text-sm text-gray-600">{{ $certification->certification_number }}</span>
                                                @endif
                                            </div>
                                            <div class="text-right text-sm text-gray-500">
                                                @if($certification->verified_by)
                                                    <div>Verified by {{ $certification->verified_by }}</div>
                                                @endif
                                                @if($certification->issuance_date)
                                                    <div>Issued: {{ $certification->issuance_date->format('M Y') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Trust & Security -->
                        <div class="mt-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">Trust & Security</h3>
                            <div class="space-y-3">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span class="text-gray-700">Verified by evident.app</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    <span class="text-gray-700">5 other buyers viewing this project</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Bulk Purchase Section -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 sticky top-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Bulk Purchase</h3>
                
                <!-- Quantity Selection -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Quantity (MWh)</label>
                    <div class="flex items-center space-x-2 mb-2">
                        <button class="px-3 py-1 bg-gray-100 text-gray-700 rounded-lg text-sm">100 MWh</button>
                        <span class="text-sm text-gray-500">Max: {{ number_format($project->available_quantity_mwh) }} MWh</span>
                    </div>
                    <input type="range" min="0" max="{{ $project->available_quantity_mwh }}" value="100" class="w-full" id="quantity-slider">
                </div>

                <!-- Price Information -->
                <div class="space-y-3 mb-4">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Price per IREC:</span>
                        <span class="text-sm font-medium text-gray-900">EGP {{ number_format($project->price_per_mwh, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Quantity:</span>
                        <span class="text-sm font-medium text-gray-900" id="selected-quantity">100 MWh</span>
                    </div>
                    <div class="flex justify-between border-t pt-2">
                        <span class="text-sm font-medium text-gray-900">Total Price:</span>
                        <span class="text-lg font-bold text-gray-900" id="total-price">EGP {{ number_format($project->price_per_mwh * 100, 2) }}</span>
                    </div>
                </div>

                <!-- Info Box -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-4">
                    <div class="flex">
                        <svg class="w-5 h-5 text-blue-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm text-blue-800">
                            By purchasing this certificate, you are directly supporting renewable energy production and contributing to a more sustainable future.
                        </p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-3">
                    <button class="w-full px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        Save to Watchlist
                    </button>
                    <button class="w-full px-4 py-2 buyer-primary text-white rounded-lg buyer-primary-hover focus:outline-none focus:ring-2 focus:ring-[#167070] flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m6 5V9a2 2 0 00-2-2H9a2 2 0 00-2 2v5"/>
                        </svg>
                        Buy Now
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Initialize with Overview tab active
    switchTab('overview');
    
    // Quantity slider functionality
    const quantitySlider = document.getElementById('quantity-slider');
    const selectedQuantity = document.getElementById('selected-quantity');
    const totalPrice = document.getElementById('total-price');
    const pricePerMwh = {{ $project->price_per_mwh }};
    
    quantitySlider.addEventListener('input', function() {
        const quantity = this.value;
        selectedQuantity.textContent = quantity + ' MWh';
        const total = (quantity * pricePerMwh).toFixed(2);
        totalPrice.textContent = 'EGP ' + total;
    });
});

function switchTab(tabName) {
    // Hide all tab contents
    const tabContents = document.querySelectorAll('.tab-content');
    tabContents.forEach(content => content.classList.add('hidden'));
    
    // Remove active state from all tabs
    const tabButtons = document.querySelectorAll('.tab-button');
    tabButtons.forEach(button => {
        button.classList.remove('border-[#167070]', 'text-[#167070]');
        button.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Show selected tab content
    document.getElementById(tabName + '-content').classList.remove('hidden');
    
    // Activate selected tab button
    const activeTab = document.getElementById(tabName + '-tab');
    activeTab.classList.remove('border-transparent', 'text-gray-500');
    activeTab.classList.add('border-[#167070]', 'text-[#167070]');
}
</script>
@endpush
