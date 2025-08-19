@extends('plugin/multivendor::buyer.v2.layouts.app')

@section('title', 'Account Review - Ecojarah')
@section('page-title', 'Account Review')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Account Review</h1>
        <p class="text-gray-600">Review and verify your account information</p>
    </div>

    <!-- Progress Indicator -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-primary-teal rounded-full flex items-center justify-center text-white text-sm font-medium">1</div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">Profile Information</p>
                    <p class="text-xs text-gray-500">Basic account details</p>
                </div>
            </div>
            <div class="flex-1 mx-4 h-0.5 bg-gray-200"></div>
            <div class="flex items-center">
                <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 text-sm font-medium">2</div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-500">Verification</p>
                    <p class="text-xs text-gray-400">Document verification</p>
                </div>
            </div>
            <div class="flex-1 mx-4 h-0.5 bg-gray-200"></div>
            <div class="flex items-center">
                <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 text-sm font-medium">3</div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-500">Approval</p>
                    <p class="text-xs text-gray-400">Account approval</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Information Section -->
    <div class="bg-white rounded-lg shadow-sm mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Profile Information</h3>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Complete
                </span>
            </div>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                    <p class="text-gray-900">Mira</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                    <p class="text-gray-900">Bassem</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <p class="text-gray-900">mira.bassem@example.com</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                    <p class="text-gray-900">+1 (555) 123-4567</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Company</label>
                    <p class="text-gray-900">EcoTech Solutions</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                    <p class="text-gray-900">San Francisco, CA, USA</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Verification Documents Section -->
    <div class="bg-white rounded-lg shadow-sm mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Verification Documents</h3>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                    Pending
                </span>
            </div>
        </div>
        
        <div class="p-6">
            <div class="space-y-6">
                <!-- ID Document -->
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V4a2 2 0 114 0v2m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-medium text-gray-900">Government ID</h4>
                                <p class="text-sm text-gray-500">Driver's license or passport</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <span class="text-sm text-gray-500">Not uploaded</span>
                            <button class="px-3 py-1 text-sm border border-primary-teal text-primary-teal rounded hover:bg-primary-teal hover:text-white transition-colors duration-200">
                                Upload
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Proof of Address -->
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-medium text-gray-900">Proof of Address</h4>
                                <p class="text-sm text-gray-500">Utility bill or bank statement</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <span class="text-sm text-gray-500">Not uploaded</span>
                            <button class="px-3 py-1 text-sm border border-primary-teal text-primary-teal rounded hover:bg-primary-teal hover:text-white transition-colors duration-200">
                                Upload
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Business Registration -->
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-medium text-gray-900">Business Registration</h4>
                                <p class="text-sm text-gray-500">Business license or registration</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <span class="text-sm text-gray-500">Not uploaded</span>
                            <button class="px-3 py-1 text-sm border border-primary-teal text-primary-teal rounded hover:bg-primary-teal hover:text-white transition-colors duration-200">
                                Upload
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                <div class="flex">
                    <svg class="w-5 h-5 text-blue-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <h4 class="text-sm font-medium text-blue-800">Document Requirements</h4>
                        <p class="text-sm text-blue-700 mt-1">
                            Please ensure all documents are clear, legible, and show your full name and current address. 
                            Documents must be dated within the last 3 months.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Account Status Section -->
    <div class="bg-white rounded-lg shadow-sm mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Account Status</h3>
        </div>
        
        <div class="p-6">
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-700">Profile Completion</span>
                    <span class="text-sm text-gray-900">100%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-green-600 h-2 rounded-full" style="width: 100%"></div>
                </div>

                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-700">Document Verification</span>
                    <span class="text-sm text-gray-900">0%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-yellow-500 h-2 rounded-full" style="width: 0%"></div>
                </div>

                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-700">Account Approval</span>
                    <span class="text-sm text-gray-900">Pending</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-gray-400 h-2 rounded-full" style="width: 0%"></div>
                </div>
            </div>

            <div class="mt-6 p-4 bg-yellow-50 rounded-lg">
                <div class="flex">
                    <svg class="w-5 h-5 text-yellow-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                    <div>
                        <h4 class="text-sm font-medium text-yellow-800">Action Required</h4>
                        <p class="text-sm text-yellow-700 mt-1">
                            Please upload the required verification documents to complete your account setup and gain access to all features.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-end space-x-3">
        <button class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
            Save Draft
        </button>
        <button class="px-6 py-2 bg-primary-teal text-white rounded-lg hover:bg-primary-teal-dark focus:outline-none focus:ring-2 focus:ring-primary-teal focus:ring-offset-2">
            Submit for Review
        </button>
    </div>
</div>
@endsection
