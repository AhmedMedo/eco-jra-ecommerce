@extends('plugin/multivendor::buyer.v2.layouts.app')

@section('title', 'Project Detail - Ecojarah')
@section('page-title', 'Project Detail')

@section('content')
<div class="p-6">
    <!-- Back Navigation -->
    <div class="mb-6">
        <a href="{{ route('plugin.multivendor.buyer.v2.marketplace') }}" class="inline-flex items-center text-primary-teal hover:text-primary-teal-dark">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Marketplace
        </a>
    </div>

    <!-- Project Header -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
        <div class="relative h-64">
            <img src="https://images.unsplash.com/photo-1509391366360-2e959784a276?w=1200&h=400&fit=crop" 
                 alt="Solar Farm Project" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
            <div class="absolute bottom-6 left-6 text-white">
                <h1 class="text-3xl font-bold mb-2">Solar Farm Alpha</h1>
                <p class="text-lg">Large-scale solar farm project in California</p>
            </div>
            <div class="absolute top-6 right-6">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Verified Project
                </span>
            </div>
        </div>
    </div>

    <!-- Project Information Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Project Overview -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Project Overview</h2>
                <p class="text-gray-600 mb-4">
                    Solar Farm Alpha is a state-of-the-art photovoltaic power plant located in the sunny regions of California. 
                    This project represents a significant step forward in renewable energy infrastructure, designed to provide 
                    clean, sustainable power to local communities while contributing to the state's ambitious renewable energy goals.
                </p>
                <p class="text-gray-600">
                    The facility utilizes cutting-edge solar panel technology and advanced monitoring systems to ensure optimal 
                    performance and maximum energy output throughout the year.
                </p>
            </div>

            <!-- Technical Specifications -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Technical Specifications</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-3">Power Generation</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Installed Capacity:</span>
                                <span class="font-medium text-gray-900">50 MW</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Annual Output:</span>
                                <span class="font-medium text-gray-900">85,000 MWh</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Peak Hours:</span>
                                <span class="font-medium text-gray-900">1,700 hours/year</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-3">Infrastructure</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Solar Panels:</span>
                                <span class="font-medium text-gray-900">125,000 units</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Inverters:</span>
                                <span class="font-medium text-gray-900">Centralized system</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Land Area:</span>
                                <span class="font-medium text-gray-900">200 acres</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Environmental Impact -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Environmental Impact</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">CO2 Avoided</h3>
                        <p class="text-2xl font-bold text-green-600">42,500 tons/year</p>
                        <p class="text-sm text-gray-500">Equivalent to planting 2,100 trees</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Energy Efficiency</h3>
                        <p class="text-2xl font-bold text-blue-600">95.2%</p>
                        <p class="text-sm text-gray-500">Advanced tracking systems</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Water Savings</h3>
                        <p class="text-2xl font-bold text-purple-600">2.1M gallons</p>
                        <p class="text-sm text-gray-500">Compared to thermal plants</p>
                    </div>
                </div>
            </div>

            <!-- Project Timeline -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Project Timeline</h2>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-4"></div>
                        <div class="flex-1">
                            <h3 class="text-sm font-medium text-gray-900">Project Completed</h3>
                            <p class="text-sm text-gray-500">December 2023 - All systems operational</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-4"></div>
                        <div class="flex-1">
                            <h3 class="text-sm font-medium text-gray-900">Testing & Commissioning</h3>
                            <p class="text-sm text-gray-500">October 2023 - System validation completed</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-4"></div>
                        <div class="flex-1">
                            <h3 class="text-sm font-medium text-gray-900">Construction Phase</h3>
                            <p class="text-sm text-gray-500">March 2023 - September 2023</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-4"></div>
                        <div class="flex-1">
                            <h3 class="text-sm font-medium text-gray-900">Planning & Permits</h3>
                            <p class="text-sm text-gray-500">January 2023 - February 2023</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Project Stats -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Project Statistics</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Project ID:</span>
                        <span class="font-medium text-gray-900">#PRJ001</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Status:</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Operational
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Location:</span>
                        <span class="font-medium text-gray-900">California, USA</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Developer:</span>
                        <span class="font-medium text-gray-900">SolarTech Inc.</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Commission Date:</span>
                        <span class="font-medium text-gray-900">Dec 15, 2023</span>
                    </div>
                </div>
            </div>

            <!-- IREC Information -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">IREC Details</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">IREC Price:</span>
                        <span class="font-medium text-green-600">$45/MWh</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Available IRECs:</span>
                        <span class="font-medium text-gray-900">85,000 MWh</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Vintage:</span>
                        <span class="font-medium text-gray-900">2024</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Certification:</span>
                        <span class="font-medium text-gray-900">I-REC Standard</span>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h3>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Project Manager</p>
                            <p class="text-sm text-gray-600">Sarah Johnson</p>
                            <p class="text-sm text-gray-600">sarah.johnson@solartech.com</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Phone</p>
                            <p class="text-sm text-gray-600">+1 (555) 123-4567</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="space-y-3">
                    <button class="w-full bg-primary-teal text-white py-2 px-4 rounded-lg hover:bg-primary-teal-dark focus:outline-none focus:ring-2 focus:ring-primary-teal focus:ring-offset-2">
                        Purchase IRECs
                    </button>
                    <button class="w-full border border-primary-teal text-primary-teal py-2 px-4 rounded-lg hover:bg-primary-teal hover:text-white transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        Add to Favorites
                    </button>
                    <button class="w-full border border-gray-300 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-50">
                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"/>
                        </svg>
                        Share Project
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
