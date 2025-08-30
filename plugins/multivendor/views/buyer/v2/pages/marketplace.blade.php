@extends('plugin/multivendor::buyer.v2.layouts.app')

@section('title', 'Marketplace - Ecojarah')
@section('page-title', 'Marketplace')

@section('content')
<div class="p-6">
    <!-- Header Section -->
    <div class="mb-6">
        <!-- Main Title -->
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Marketplace</h1>
        
        <!-- IREC Marketplace Section -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-900">IREC Marketplace</h2>
            
            <div class="flex items-center space-x-4">
                <!-- View Toggle Icons -->
                <div class="flex items-center bg-gray-100 rounded-lg p-1">
                    <button class="p-2 rounded-md bg-white shadow-sm text-primary-teal">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                    </button>
                    <button class="p-2 rounded-md text-gray-500 hover:text-gray-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
                
                <!-- Action Buttons -->
                <button id="filterBtn" class="px-3 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Filter
                </button>
                <button class="px-3 py-2 text-white rounded-lg buyer-primary buyer-primary-hover focus:outline-none focus:ring-2 focus:ring-[#167070] flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                    </svg>
                    <a href="{{ route('plugin.multivendor.buyer.v2.marketplace.export', request()->query()) }}" class="text-white">Export</a>
                </button>
                <button id="calculatorBtn" class="px-3 py-2 text-white rounded-lg buyer-primary buyer-primary-hover focus:outline-none focus:ring-2 focus:ring-[#167070] flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M9 11h.01M9 8h.01M9 5h.01M9 2h.01"/>
                    </svg>
                    Calculator
                </button>
            </div>
        </div>
    </div>

    <!-- Filter Panel -->
    <div id="filterPanel" class="hidden bg-white rounded-lg shadow-lg border border-gray-300 p-6 mb-6 w-full max-w-7xl mx-auto">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Filters</h3>
            <button id="closeFilterBtn" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <!-- Filter Options Grid -->
        <form id="filterForm" method="GET" action="{{ route('plugin.multivendor.buyer.v2.marketplace') }}" class="grid grid-cols-4 gap-4 mb-4">
            <!-- Hidden CSRF Token -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            <!-- Search Input -->
            <div class="relative col-span-4 mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                <input type="text" 
                       name="search" 
                       placeholder="Search projects by name, technology, country..." 
                       value="{{ $filters['search'] ?? '' }}"
                       class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-1 focus:ring-[#167070] focus:border-[#167070] bg-white">
            </div>
            
            <!-- Energy Type Pills -->
            <div class="col-span-4 mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Energy Type</label>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ request()->fullUrlWithQuery(['energy_type' => 'all']) }}" 
                       class="px-3 py-1.5 text-white rounded-full text-xs font-medium {{ ($filters['energy_type'] ?? 'all') === 'all' ? 'buyer-primary' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        All
                    </a>
                    @foreach($energyTypes as $energyType)
                        <a href="{{ request()->fullUrlWithQuery(['energy_type' => $energyType]) }}" 
                           class="px-3 py-1.5 rounded-full text-xs font-medium {{ ($filters['energy_type'] ?? 'all') === $energyType ? 'text-white buyer-primary' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                            {{ ucfirst($energyType) }}
                        </a>
                    @endforeach
                </div>
            </div>
            
            <!-- Price Range -->
            <div class="relative">
                <label class="absolute -top-2 left-3 bg-white px-1 text-xs text-gray-600 z-10">Price Range (EGP)</label>
                <div class="flex gap-2">
                    <div class="relative flex-1">
                        <input type="number" 
                               name="min_price" 
                               placeholder="Min" 
                               value="{{ $filters['min_price'] ?? '' }}"
                               class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-1 focus:ring-[#167070] focus:border-[#167070] bg-white">
                    </div>
                    <div class="relative flex-1">
                        <input type="number" 
                               name="max_price" 
                               placeholder="Max" 
                               value="{{ $filters['max_price'] ?? '' }}"
                               class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-1 focus:ring-[#167070] focus:border-[#167070] bg-white">
                    </div>
                </div>
            </div>
            
            <!-- Vintage Year -->
            <div class="relative">
                <label class="absolute -top-2 left-3 bg-white px-1 text-xs text-gray-600 z-10">Vintage Year</label>
                <select name="vintage_year" class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-1 focus:ring-[#167070] focus:border-[#167070] bg-white appearance-none">
                    <option value="all" {{ ($filters['vintage_year'] ?? 'all') === 'all' ? 'selected' : '' }}>All</option>
                    @foreach($vintageYears as $year)
                        <option value="{{ $year }}" {{ ($filters['vintage_year'] ?? 'all') == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
            </div>
            
            <!-- Country -->
            <div class="relative">
                <label class="absolute -top-2 left-3 bg-white px-1 text-xs text-gray-600 z-10">Country</label>
                <select name="country" class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-1 focus:ring-[#167070] focus:border-[#167070] bg-white appearance-none">
                    <option value="all" {{ ($filters['country'] ?? 'all') === 'all' ? 'selected' : '' }}>All</option>
                    @foreach($countries as $country)
                        <option value="{{ $country }}" {{ ($filters['country'] ?? 'all') === $country ? 'selected' : '' }}>{{ $country }}</option>
                    @endforeach
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
            </div>
            
            <!-- Certification -->
            <div class="relative">
                <label class="absolute -top-2 left-3 bg-white px-1 text-xs text-gray-600 z-10">Certification</label>
                <select name="certification" class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-1 focus:ring-[#167070] focus:border-[#167070] bg-white appearance-none">
                    <option value="all" {{ ($filters['certification'] ?? 'all') === 'all' ? 'selected' : '' }}>All</option>
                    @foreach($certificationTypes as $certType)
                        <option value="{{ $certType }}" {{ ($filters['certification'] ?? 'all') === $certType ? 'selected' : '' }}>{{ $certType }}</option>
                    @endforeach
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
            </div>
        </form>
        
        <!-- Filter Action Buttons -->
        <div class="flex justify-end space-x-3">
            <a href="{{ route('plugin.multivendor.buyer.v2.marketplace') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-gray-300 text-sm">
                Reset
            </a>
            <button type="submit" form="filterForm" class="px-4 py-2 buyer-primary text-white rounded-lg buyer-primary-hover focus:outline-none focus:ring-2 focus:ring-[#167070] text-sm">
                Apply Filters
            </button>
            <button id="saveFilterBtn" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 text-sm">
                Save Filter
            </button>
            <div class="relative inline-block text-left">
                <button id="savedFiltersBtn" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300 flex items-center text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                    </svg>
                    Saved Filters
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div id="savedFiltersDropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Saved Filters</h3>
                        <div id="savedFiltersList" class="space-y-2">
                            <!-- Saved filters will be loaded here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- IREC Projects Grid -->
    @if($projects->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($projects as $project)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
                    <!-- Header Image with Active Status -->
                    <div class="relative">
                        @if($project->project_image)
                            <img src="{{ asset('/') . $project->project_image }}" 
                                 alt="{{ $project->project_name }}" 
                                 class="w-full h-48 object-cover rounded-t-lg">
                        @else
                            <div class="w-full h-48 bg-gray-200 rounded-t-lg flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 002 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-3 right-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $project->status === 'active' ? 'bg-green-500 text-white' : 'bg-gray-500 text-white' }}">
                                {{ ucfirst($project->status) }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Project Information Section -->
                    <div class="p-4">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $project->project_name }}</h3>
                            <a href="{{ route('plugin.multivendor.buyer.v2.project-details', $project->project_id) }}" class="text-sm text-blue-600 hover:text-blue-800">See More</a>
                        </div>
                        <p class="text-sm text-gray-500 mb-3">Project ID: #{{ $project->project_id }}</p>
                        
                        <!-- Key Details Row -->
                        <div class="flex items-center justify-between mb-4 text-sm text-gray-600">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $project->country }}
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $project->vintage_year }} Vintage
                            </div>
                        </div>
                        
                        <!-- Volume and Price Section -->
                        <div class="space-y-2 mb-4">
                            <div class="text-sm">
                                <span class="text-gray-500">Total Volume:</span>
                                <span class="font-medium text-gray-900 ml-2">{{ number_format($project->total_irecs) }} IRECs</span>
                            </div>
                            <div class="text-sm">
                                <span class="text-gray-500">Available:</span>
                                <span class="text-medium text-gray-900 ml-2">{{ number_format($project->available_quantity_mwh) }} MWh</span>
                            </div>
                            <div class="text-sm text-right">
                                <span class="text-gray-500">Price</span>
                                <span class="font-medium text-gray-900 ml-2">{{ $project->formatted_price }}</span>
                            </div>
                        </div>
                        
                        <!-- Quantity and Action Section -->
                        <div class="space-y-3">
                            <!-- Quantity Input -->
                            <div class="flex items-center space-x-2">
                                <label class="text-sm font-medium text-gray-700">Quantity (MWh):</label>
                                <input type="number" 
                                       min="0.01" 
                                       max="{{ $project->available_quantity_mwh }}" 
                                       step="0.01" 
                                       value="1.00" 
                                       class="quantity-input flex-1 px-2 py-1 text-sm border border-gray-300 rounded focus:ring-1 focus:ring-[#167070] focus:border-[#167070]">
                            </div>
                            
                            <!-- Action Button -->
                            <div class="flex justify-end">
                                <button class="add-to-cart-btn bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors duration-200 flex items-center" 
                                        data-project-id="{{ $project->id }}"
                                        data-project-name="{{ $project->project_name }}">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2 8m2-8l2-2m0 0V9a2 2 0 114 0v2.93m-6 0l2 2"/>
                                    </svg>
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $projects->appends(request()->query())->links() }}
        </div>
    @else
        <!-- No Projects Found -->
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m12.728 0l-.707.707M6.343 6.343l-.707-.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No projects found</h3>
            <p class="mt-1 text-sm text-gray-500">Try adjusting your filters or search terms.</p>
            <div class="mt-6">
                <a href="{{ route('plugin.multivendor.buyer.v2.marketplace') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#167070] hover:bg-[#167070]/90">
                    Clear Filters
                </a>
            </div>
        </div>
    @endif
</div>

<!-- Calculator Modal -->
<div id="calculatorModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6 relative">
        <!-- Modal Header -->
        <div class="text-center mb-6">
            <h3 class="text-xl font-semibold text-gray-900">Calculate Your IREC Requirements</h3>
        </div>
        
        <!-- Input Section -->
        <div class="space-y-4 mb-6">
            <!-- Annual Energy Consumption -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Annual Energy Consumption</label>
                <div class="flex gap-2">
                    <input type="number" placeholder="Enter amount" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-teal focus:border-primary-teal">
                    <select class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-teal focus:border-primary-teal bg-white">
                        <option>kWh</option>
                        <option>MWh</option>
                        <option>GWh</option>
                    </select>
                </div>
            </div>
            
            <!-- Region -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Region</label>
                <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-teal focus:border-primary-teal bg-white">
                    <option>Select Region</option>
                    <option>North America</option>
                    <option>Europe</option>
                    <option>Asia Pacific</option>
                    <option>Middle East</option>
                    <option>Africa</option>
                </select>
            </div>
        </div>
        
        <!-- Results Section -->
        <div class="bg-gray-50 rounded-lg p-4 mb-6">
            <h4 class="text-sm font-medium text-gray-700 mb-3">Estimated IREC Requirements</h4>
            
            <!-- Progress Bar -->
            <div class="w-full bg-gray-200 rounded-full h-2 mb-3">
                <div class="bg-primary-teal h-2 rounded-full" style="width: 65%"></div>
            </div>
            
            <p class="text-xs text-gray-500 mb-3">Based on your input</p>
            
            <!-- Results Display -->
            <div class="flex justify-between items-end">
                <div>
                    <p class="text-2xl font-bold text-gray-900">650 MWh</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-600">Offset CO2</p>
                    <p class="text-xl font-bold text-gray-900">325 tons</p>
                </div>
            </div>
        </div>
        
        <!-- Action Button -->
        <div class="flex justify-end">
            <button class="px-4 py-2 buyer-primary text-white rounded-lg buyer-primary-hover focus:outline-none focus:ring-2 focus:ring-[#167070] flex items-center gap-2">
                Browse IRECs
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
        
        <!-- Close Button -->
        <button id="closeCalculatorModal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
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
    const filterBtn = document.getElementById('filterBtn');
    const filterPanel = document.getElementById('filterPanel');
    const closeFilterBtn = document.getElementById('closeFilterBtn');

    // Toast Notification Functions
    function showToast(message, type = 'success') {
        const toast = document.getElementById('toastNotification');
        const toastMessage = document.getElementById('toastMessage');
        const successIcon = document.getElementById('successIcon');
        const errorIcon = document.getElementById('errorIcon');
        
        toastMessage.textContent = message;
        
        // Show appropriate icon
        if (type === 'success') {
            successIcon.classList.remove('hidden');
            errorIcon.classList.add('hidden');
        } else {
            successIcon.classList.add('hidden');
            errorIcon.classList.remove('hidden');
        }
        
        // Show toast
        toast.classList.remove('hidden');
        
        // Auto hide after 3 seconds
        setTimeout(() => {
            hideToast();
        }, 3000);
    }
    
    function hideToast() {
        const toast = document.getElementById('toastNotification');
        toast.classList.add('hidden');
    }
    
    // Close toast when clicking close button
    document.getElementById('closeToast').addEventListener('click', hideToast);

    // Show filter panel
    filterBtn.addEventListener('click', function () {
        filterPanel.classList.remove('hidden');
    });

    // Hide filter panel
    closeFilterBtn.addEventListener('click', function () {
        filterPanel.classList.add('hidden');
    });

    // Calculator Modal Functionality
    const calculatorBtn = document.getElementById('calculatorBtn');
    const calculatorModal = document.getElementById('calculatorModal');
    const closeCalculatorModal = document.getElementById('closeCalculatorModal');

    // Show calculator modal
    calculatorBtn.addEventListener('click', function () {
        calculatorModal.classList.remove('hidden');
    });

    // Hide calculator modal
    closeCalculatorModal.addEventListener('click', function () {
        calculatorModal.classList.add('hidden');
    });

    // Close calculator modal when clicking outside
    document.addEventListener('click', function (event) {
        if (!calculatorModal.contains(event.target) && !calculatorBtn.contains(event.target)) {
            calculatorModal.classList.add('hidden');
        }
    });

    // Save Filter Functionality
    const saveFilterBtn = document.getElementById('saveFilterBtn');
    const savedFiltersBtn = document.getElementById('savedFiltersBtn');
    const savedFiltersDropdown = document.getElementById('savedFiltersDropdown');
    const savedFiltersList = document.getElementById('savedFiltersList');

    // Show/hide saved filters dropdown
    savedFiltersBtn.addEventListener('click', function() {
        savedFiltersDropdown.classList.toggle('hidden');
        loadSavedFilters();
    });

    // Close saved filters dropdown when clicking outside
    document.addEventListener('click', function (event) {
        if (!savedFiltersBtn.contains(event.target) && !savedFiltersDropdown.contains(event.target)) {
            savedFiltersDropdown.classList.add('hidden');
        }
    });

    // Save filter button
    saveFilterBtn.addEventListener('click', function() {
        const filterName = prompt('Enter a name for this filter:');
        if (filterName && filterName.trim()) {
            saveFilter(filterName.trim());
        }
    });

    // Function to save filter
    function saveFilter(filterName) {
        const formData = new FormData(document.getElementById('filterForm'));
        formData.append('filter_name', filterName);

        // Get CSRF token with fallback
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                         document.querySelector('input[name="_token"]')?.value ||
                         '{{ csrf_token() }}';

        fetch('{{ route("plugin.multivendor.buyer.v2.marketplace.save-filter") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast('Filter saved successfully!');
                loadSavedFilters();
            } else {
                showToast('Error saving filter: ' + data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Error saving filter', 'error');
        });
    }

    // Function to load saved filters
    function loadSavedFilters() {
        fetch('{{ route("plugin.multivendor.buyer.v2.marketplace.saved-filters") }}')
        .then(response => response.json())
        .then(data => {
            savedFiltersList.innerHTML = '';
            
            if (!data.filters || data.filters.length === 0) {
                savedFiltersList.innerHTML = '<p class="text-gray-500 text-sm">No saved filters</p>';
                return;
            }

            data.filters.forEach(filter => {
                const filterElement = document.createElement('div');
                filterElement.className = 'flex items-center justify-between p-3 bg-gray-50 rounded-lg';
                
                const filterInfo = document.createElement('div');
                filterInfo.className = 'flex-1';
                
                const filterName = document.createElement('div');
                filterName.className = 'font-medium text-gray-900';
                filterName.textContent = filter.filter_name;
                
                const filterDetails = document.createElement('div');
                filterDetails.className = 'text-sm text-gray-600 mt-1';
                const formattedFilters = filter.formatted_filters || [];
                filterDetails.textContent = formattedFilters.length > 0 ? formattedFilters.join(', ') : 'No specific filters';
                
                filterInfo.appendChild(filterName);
                filterInfo.appendChild(filterDetails);
                
                const actions = document.createElement('div');
                actions.className = 'flex space-x-2';
                
                const loadBtn = document.createElement('button');
                loadBtn.className = 'px-2 py-1 text-xs bg-blue-600 text-white rounded hover:bg-blue-700';
                loadBtn.textContent = 'Load';
                loadBtn.onclick = () => loadFilter(filter.id);
                
                const deleteBtn = document.createElement('button');
                deleteBtn.className = 'px-2 py-1 text-xs bg-red-600 text-white rounded hover:bg-red-700';
                deleteBtn.textContent = 'Delete';
                deleteBtn.onclick = () => deleteFilter(filter.id);
                
                actions.appendChild(loadBtn);
                actions.appendChild(deleteBtn);
                
                filterElement.appendChild(filterInfo);
                filterElement.appendChild(actions);
                savedFiltersList.appendChild(filterElement);
            });
        })
        .catch(error => {
            console.error('Error loading saved filters:', error);
            savedFiltersList.innerHTML = '<p class="text-red-500 text-sm">Error loading saved filters</p>';
        });
    }

    // Function to load a saved filter
    function loadFilter(filterId) {
        fetch(`{{ route('plugin.multivendor.buyer.v2.marketplace.saved-filters') }}`)
        .then(response => response.json())
        .then(data => {
            const filter = data.filters.find(f => f.id == filterId);
            if (filter) {
                // Populate form fields with saved filter data
                const form = document.getElementById('filterForm');
                
                // Search field
                const searchInput = form.querySelector('input[name="search"]');
                if (searchInput) {
                    searchInput.value = filter.filter_data.search || '';
                }
                
                // Min price
                const minPriceInput = form.querySelector('input[name="min_price"]');
                if (minPriceInput) {
                    minPriceInput.value = filter.filter_data.min_price || '';
                }
                
                // Max price
                const maxPriceInput = form.querySelector('input[name="max_price"]');
                if (maxPriceInput) {
                    maxPriceInput.value = filter.filter_data.max_price || '';
                }
                
                // Vintage year
                const vintageSelect = form.querySelector('select[name="vintage_year"]');
                if (vintageSelect) {
                    vintageSelect.value = filter.filter_data.vintage_year || 'all';
                }
                
                // Country
                const countrySelect = form.querySelector('select[name="country"]');
                if (countrySelect) {
                    countrySelect.value = filter.filter_data.country || 'all';
                }
                
                // Certification
                const certSelect = form.querySelector('select[name="certification"]');
                if (certSelect) {
                    certSelect.value = filter.filter_data.certification || 'all';
                }
                
                // Close the dropdown
                savedFiltersDropdown.classList.add('hidden');
                
                // Show success message
                showToast('Filter loaded successfully! You can now review and apply the filters.');
            } else {
                showToast('Filter not found', 'error');
            }
        })
        .catch(error => {
            console.error('Error loading filter:', error);
            showToast('Error loading filter', 'error');
        });
    }

    // Function to delete a saved filter
    function deleteFilter(filterId) {
        if (confirm('Are you sure you want to delete this filter?')) {
            // Get CSRF token with fallback
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                             document.querySelector('input[name="_token"]')?.value ||
                             '{{ csrf_token() }}';

            fetch(`{{ route('plugin.multivendor.buyer.v2.marketplace.delete-filter', '') }}/${filterId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Filter deleted successfully!');
                    loadSavedFilters();
                } else {
                    showToast('Error deleting filter: ' + data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error deleting filter', 'error');
            });
        }
    }

    // ==================== CART FUNCTIONALITY ====================
    
    // Add to cart functionality
    document.addEventListener('click', function(e) {
        if (e.target.closest('.add-to-cart-btn')) {
            const button = e.target.closest('.add-to-cart-btn');
            const projectId = button.dataset.projectId;
            const projectName = button.dataset.projectName;
            const quantityInput = button.closest('.space-y-3').querySelector('.quantity-input');
            const quantity = parseFloat(quantityInput.value);
            
            if (!quantity || quantity <= 0) {
                showToast('Please enter a valid quantity', 'error');
                return;
            }
            
            // Disable button during request
            button.disabled = true;
            button.innerHTML = '<svg class="w-4 h-4 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>Adding...';
            
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                             document.querySelector('input[name="_token"]')?.value ||
                             '{{ csrf_token() }}';
            
            fetch('{{ route("plugin.multivendor.buyer.v2.cart.add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({
                    project_id: projectId,
                    quantity_mwh: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast(`${projectName} added to cart successfully!`);
                    // Update cart counter if it exists
                    updateCartCounter(data.cart_summary);
                    // Reset quantity to 1
                    quantityInput.value = '1.00';
                } else {
                    showToast(data.message || 'Failed to add to cart', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error adding to cart', 'error');
            })
            .finally(() => {
                // Re-enable button
                button.disabled = false;
                button.innerHTML = '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2 8m2-8l2-2m0 0V9a2 2 0 114 0v2.93m-6 0l2 2"/></svg>Add to Cart';
            });
        }
    });
    
    // Function to update cart counter
    function updateCartCounter(cartSummary) {
        const cartCounter = document.getElementById('cart-counter');
        if (cartCounter && cartSummary) {
            cartCounter.textContent = cartSummary.total_items;
            cartCounter.classList.remove('hidden');
        }
    }
});
</script>
@endpush
