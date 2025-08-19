@extends('plugin/multivendor::buyer.v2.layouts.app')

@section('title', 'Marketplace - Ecojarah')
@section('page-title', 'Marketplace')

@section('content')
<div class="p-6">
    <!-- Header with Search and Filters -->
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl font-bold text-gray-900">Renewable Energy Projects</h1>
                <p class="text-gray-600">Discover and invest in sustainable energy projects</p>
            </div>
            <div class="flex space-x-3">
                <div class="relative">
                    <input type="text" placeholder="Search projects..." 
                           class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-teal focus:border-primary-teal">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
                <button class="px-4 py-2 bg-primary-teal text-white rounded-lg hover:bg-primary-teal-dark focus:outline-none focus:ring-2 focus:ring-primary-teal focus:ring-offset-2">
                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.414A1 1 0 013 6.707V4z"/>
                    </svg>
                    Filters
                </button>
            </div>
        </div>
    </div>

    <!-- Filter Tags -->
    <div class="mb-6 flex flex-wrap gap-2">
        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary-teal text-white">
            Solar Energy
            <button class="ml-2 text-white hover:text-gray-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </span>
        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
            Wind Energy
            <button class="ml-2 text-blue-600 hover:text-blue-800">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </span>
        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
            Verified Projects
            <button class="ml-2 text-green-600 hover:text-green-800">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </span>
    </div>

    <!-- Projects Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Project Card 1 -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1509391366360-2e959784a276?w=400&h=250&fit=crop" 
                     alt="Solar Farm Project" class="w-full h-48 object-cover rounded-t-lg">
                <div class="absolute top-3 right-3">
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        Verified
                    </span>
                </div>
            </div>
            <div class="p-6">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-lg font-semibold text-gray-900">Solar Farm Alpha</h3>
                    <span class="text-sm text-gray-500">#PRJ001</span>
                </div>
                <p class="text-gray-600 mb-4">Large-scale solar farm project in California producing clean energy for local communities.</p>
                
                <div class="space-y-3 mb-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Energy Type:</span>
                        <span class="font-medium text-gray-900">Solar</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Capacity:</span>
                        <span class="font-medium text-gray-900">50 MW</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Location:</span>
                        <span class="font-medium text-gray-900">California, USA</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">IREC Price:</span>
                        <span class="font-medium text-green-600">$45/MWh</span>
                    </div>
                </div>

                <div class="flex space-x-2">
                                            <a href="{{ route('plugin.multivendor.buyer.v2.project-detail', 1) }}" 
                       class="flex-1 bg-primary-teal text-white text-center py-2 px-4 rounded-lg hover:bg-primary-teal-dark transition-colors duration-200">
                        View Details
                    </a>
                    <button class="px-4 py-2 border border-primary-teal text-primary-teal rounded-lg hover:bg-primary-teal hover:text-white transition-colors duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Project Card 2 -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1466611653911-95081537e5b7?w=400&h=250&fit=crop" 
                     alt="Wind Farm Project" class="w-full h-48 object-cover rounded-t-lg">
                <div class="absolute top-3 right-3">
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        Verified
                    </span>
                </div>
            </div>
            <div class="p-6">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-lg font-semibold text-gray-900">Wind Farm Beta</h3>
                    <span class="text-sm text-gray-500">#PRJ002</span>
                </div>
                <p class="text-gray-600 mb-4">Offshore wind farm project harnessing strong coastal winds for sustainable energy generation.</p>
                
                <div class="space-y-3 mb-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Energy Type:</span>
                        <span class="font-medium text-gray-900">Wind</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Capacity:</span>
                        <span class="font-medium text-gray-900">100 MW</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Location:</span>
                        <span class="font-medium text-gray-900">North Sea</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">IREC Price:</span>
                        <span class="font-medium text-green-600">$52/MWh</span>
                    </div>
                </div>

                <div class="flex space-x-2">
                                            <a href="{{ route('plugin.multivendor.buyer.v2.project-detail', 2) }}" 
                       class="flex-1 bg-primary-teal text-white text-center py-2 px-4 rounded-lg hover:bg-primary-teal-dark transition-colors duration-200">
                        View Details
                    </a>
                    <button class="px-4 py-2 border border-primary-teal text-primary-teal rounded-lg hover:bg-primary-teal hover:text-white transition-colors duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Project Card 3 -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1544191696-102dbdaeeaa5?w=400&h=250&fit=crop" 
                     alt="Hydroelectric Project" class="w-full h-48 object-cover rounded-t-lg">
                <div class="absolute top-3 right-3">
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        Pending
                    </span>
                </div>
            </div>
            <div class="p-6">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-lg font-semibold text-gray-900">Hydroelectric Gamma</h3>
                    <span class="text-sm text-gray-500">#PRJ003</span>
                </div>
                <p class="text-gray-600 mb-4">Small-scale hydroelectric project utilizing river flow for clean energy production.</p>
                
                <div class="space-y-3 mb-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Energy Type:</span>
                        <span class="font-medium text-gray-900">Hydroelectric</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Capacity:</span>
                        <span class="font-medium text-gray-900">15 MW</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Location:</span>
                        <span class="font-medium text-gray-900">Oregon, USA</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">IREC Price:</span>
                        <span class="font-medium text-green-600">$38/MWh</span>
                    </div>
                </div>

                <div class="flex space-x-2">
                                            <a href="{{ route('plugin.multivendor.buyer.v2.project-detail', 3) }}" 
                       class="flex-1 bg-primary-teal text-white text-center py-2 px-4 rounded-lg hover:bg-primary-teal-dark transition-colors duration-200">
                        View Details
                    </a>
                    <button class="px-4 py-2 border border-primary-teal text-primary-teal rounded-lg hover:bg-primary-teal hover:text-white transition-colors duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-8 flex items-center justify-between">
        <div class="text-sm text-gray-700">
            Showing <span class="font-medium">1</span> to <span class="font-medium">3</span> of <span class="font-medium">12</span> projects
        </div>
        <div class="flex space-x-2">
            <button class="px-3 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                Previous
            </button>
            <button class="px-3 py-2 border border-gray-300 rounded-md text-sm font-medium text-white bg-primary-teal">
                1
            </button>
            <button class="px-3 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                2
            </button>
            <button class="px-3 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                3
            </button>
            <button class="px-3 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                Next
            </button>
        </div>
    </div>
</div>
@endsection
