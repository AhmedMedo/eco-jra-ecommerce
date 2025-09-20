@extends('plugin/multivendor::buyer.v2.layouts.app')

@section('title', 'Settings - Ecojarah')
@section('page-title', 'Settings')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Account Settings</h1>
        <p class="text-gray-600">Manage your account preferences and settings</p>
    </div>

    <!-- Settings Navigation -->
    <div class="mb-8">
        <nav class="flex space-x-8">
            <button class="px-3 py-2 text-sm font-medium text-primary-teal border-b-2 border-primary-teal">
                Profile
            </button>
            <button class="px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">
                Notifications
            </button>
            <button class="px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">
                Security
            </button>
            <button class="px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">
                Preferences
            </button>
        </nav>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 rounded-md p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 bg-red-50 border border-red-200 rounded-md p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Profile Settings -->
    <div class="bg-white rounded-lg shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Profile Information</h3>
            <p class="text-sm text-gray-600">Update your account profile information</p>
        </div>
        
        <div class="p-6">
            <form class="space-y-6" action="{{ route('plugin.multivendor.buyer.v2.profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <!-- Name Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700">First Name *</label>
                        <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" required
                               class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary-teal focus:border-primary-teal">
                        @error('first_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name *</label>
                        <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" required
                               class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary-teal focus:border-primary-teal">
                        @error('last_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Email (Read-only) -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" id="email" value="{{ $user->email }}" readonly
                           class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 text-gray-500">
                    <p class="mt-1 text-xs text-gray-500">Email cannot be changed. Contact support if needed.</p>
                </div>

                <!-- Company -->
                <div>
                    <label for="company_name" class="block text-sm font-medium text-gray-700">Company Name</label>
                    <input type="text" id="company_name" name="company_name" value="{{ old('company_name', $user->company_name) }}"
                           class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary-teal focus:border-primary-teal">
                    @error('company_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                           class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary-teal focus:border-primary-teal">
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- VAT Number -->
                <div>
                    <label for="vat_number" class="block text-sm font-medium text-gray-700">VAT Registration Number</label>
                    <input type="text" id="vat_number" name="vat_number" value="{{ old('vat_number', $user->vat_number) }}"
                           class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary-teal focus:border-primary-teal">
                    @error('vat_number')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Save Button -->
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-primary-teal text-white rounded-lg hover:bg-primary-teal-dark focus:outline-none focus:ring-2 focus:ring-primary-teal focus:ring-offset-2">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- KYC Documents Section -->
    <div class="mt-8 bg-white rounded-lg shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">KYC Documents</h3>
            <p class="text-sm text-gray-600">Upload and manage your verification documents</p>
        </div>
        
        <div class="p-6">
            <!-- Upload New Documents Form -->
            <div class="mb-6">
                <h4 class="text-md font-medium text-gray-900 mb-4">Upload New Documents</h4>
                <form action="{{ route('plugin.multivendor.buyer.v2.kyc.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Select Documents to Upload</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center bg-gray-50">
                            <div class="flex flex-col items-center space-y-3">
                                <svg class="w-10 h-10 text-primary-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <p class="text-gray-700 text-sm">Drag and drop your documents here</p>
                                <p class="text-gray-500 text-xs">Upload business license, ID card, passport, or other required documents.</p>
                                <label class="inline-flex items-center justify-center px-4 py-2 bg-primary-teal text-white rounded-lg cursor-pointer hover:bg-primary-teal-dark">
                                    Browse Files
                                    <input type="file" name="kyc_files[]" class="hidden" multiple accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                </label>
                            </div>
                        </div>
                        @error('kyc_files')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-primary-teal text-white rounded-lg hover:bg-primary-teal-dark focus:outline-none focus:ring-2 focus:ring-primary-teal focus:ring-offset-2">
                            Upload Documents
                        </button>
                    </div>
                </form>
            </div>

            <!-- Existing Documents -->
            @if($kycDocuments->count() > 0)
            <div>
                <h4 class="text-md font-medium text-gray-900 mb-4">Current Documents</h4>
                <div class="space-y-4">
                    @foreach($kycDocuments as $document)
                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                @if($document->file && in_array($document->file->extension, ['jpg', 'jpeg', 'png', 'gif']))
                                    <img src="{{ asset($document->file->path) }}" alt="Document" class="h-12 w-12 object-cover rounded">
                                @else
                                    <div class="h-12 w-12 bg-gray-100 rounded flex items-center justify-center">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $document->file->name ?? 'Document' }}</p>
                                <p class="text-sm text-gray-500">{{ ucfirst($document->document_type) }} • {{ $document->file->size ?? 'Unknown size' }}</p>
                                @if($document->status === 'approved')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Approved
                                </span>
                                @elseif($document->status === 'rejected')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Rejected
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            @if($document->file)
                            <a href="{{ asset($document->file->path) }}" target="_blank" 
                               class="px-3 py-1 text-sm text-primary-teal hover:text-primary-teal-dark">
                                View
                            </a>
                            @endif
                            <button type="button" onclick="replaceDocument({{ $document->id }})" 
                                    class="px-3 py-1 text-sm text-blue-600 hover:text-blue-800">
                                Replace
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @else
            <div class="text-center py-8">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No documents uploaded</h3>
                <p class="mt-1 text-sm text-gray-500">Upload your KYC documents to complete verification.</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Replace Document Modal -->
    <div id="replaceModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Replace Document</h3>
                <form id="replaceForm" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Select New Document</label>
                        <input type="file" name="kyc_file" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" required
                               class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary-teal focus:border-primary-teal">
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeReplaceModal()" 
                                class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-primary-teal text-white rounded-lg hover:bg-primary-teal-dark">
                            Replace
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function replaceDocument(documentId) {
            const form = document.getElementById('replaceForm');
            form.action = `/buyer/kyc/${documentId}/replace`;
            document.getElementById('replaceModal').classList.remove('hidden');
        }

        function closeReplaceModal() {
            document.getElementById('replaceModal').classList.add('hidden');
        }
    </script>

    {{-- 
    <!-- Notification Preferences -->
    <div class="mt-8 bg-white rounded-lg shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Notification Preferences</h3>
            <p class="text-sm text-gray-600">Choose how you want to be notified</p>
        </div>
        
        <div class="p-6">
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-medium text-gray-900">Email Notifications</h4>
                        <p class="text-sm text-gray-500">Receive notifications via email</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-teal rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-teal"></div>
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-medium text-gray-900">SMS Notifications</h4>
                        <p class="text-sm text-gray-500">Receive notifications via SMS</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-teal rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-teal"></div>
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-medium text-gray-900">Push Notifications</h4>
                        <p class="text-sm text-gray-500">Receive push notifications in browser</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-teal rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-teal"></div>
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-medium text-gray-900">Weekly Reports</h4>
                        <p class="text-sm text-gray-500">Receive weekly energy reports</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-teal rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-teal"></div>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <!-- Account Actions -->
    <div class="mt-8 bg-white rounded-lg shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Account Actions</h3>
            <p class="text-sm text-gray-600">Manage your account settings</p>
        </div>
        
        <div class="p-6">
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-medium text-gray-900">Change Password</h4>
                        <p class="text-sm text-gray-500">Update your account password</p>
                    </div>
                    <button class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                        Change
                    </button>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-medium text-gray-900">Two-Factor Authentication</h4>
                        <p class="text-sm text-gray-500">Add an extra layer of security</p>
                    </div>
                    <button class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                        Enable
                    </button>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-medium text-gray-900">Export Data</h4>
                        <p class="text-sm text-gray-500">Download your account data</p>
                    </div>
                    <button class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                        Export
                    </button>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-medium text-red-600">Delete Account</h4>
                        <p class="text-sm text-gray-500">Permanently delete your account</p>
                    </div>
                    <button class="px-4 py-2 border border-red-300 text-red-600 rounded-lg hover:bg-red-50">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    --}}
</div>
@endsection
