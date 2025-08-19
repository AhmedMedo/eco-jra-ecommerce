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

    <!-- Profile Settings -->
    <div class="bg-white rounded-lg shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Profile Information</h3>
            <p class="text-sm text-gray-600">Update your account profile information</p>
        </div>
        
        <div class="p-6">
            <form class="space-y-6">
                <!-- Profile Picture -->
                <div class="flex items-center space-x-6">
                    <div class="flex-shrink-0">
                        <img class="h-20 w-20 rounded-full" src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?w=100&h=100&fit=crop&crop=face" alt="Profile">
                    </div>
                    <div>
                        <button type="button" class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Change Photo
                        </button>
                        <p class="mt-1 text-xs text-gray-500">JPG, PNG or GIF up to 2MB</p>
                    </div>
                </div>

                <!-- Name Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" id="first_name" name="first_name" value="Mira" 
                               class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary-teal focus:border-primary-teal">
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" id="last_name" name="last_name" value="Bassem" 
                               class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary-teal focus:border-primary-teal">
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" id="email" name="email" value="mira.bassem@example.com" 
                           class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary-teal focus:border-primary-teal">
                </div>

                <!-- Company -->
                <div>
                    <label for="company" class="block text-sm font-medium text-gray-700">Company Name</label>
                    <input type="text" id="company" name="company" value="EcoTech Solutions" 
                           class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary-teal focus:border-primary-teal">
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="tel" id="phone" name="phone" value="+1 (555) 123-4567" 
                           class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary-teal focus:border-primary-teal">
                </div>

                <!-- Location -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                        <select id="country" name="country" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary-teal focus:border-primary-teal">
                            <option>United States</option>
                            <option>Canada</option>
                            <option>United Kingdom</option>
                            <option>Germany</option>
                            <option>France</option>
                        </select>
                    </div>
                    <div>
                        <label for="state" class="block text-sm font-medium text-gray-700">State/Province</label>
                        <input type="text" id="state" name="state" value="California" 
                               class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary-teal focus:border-primary-teal">
                    </div>
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                        <input type="text" id="city" name="city" value="San Francisco" 
                               class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary-teal focus:border-primary-teal">
                    </div>
                </div>

                <!-- Bio -->
                <div>
                    <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
                    <textarea id="bio" name="bio" rows="3" 
                              class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary-teal focus:border-primary-teal"
                              placeholder="Tell us about yourself...">UI/UX Designer passionate about renewable energy and sustainable design solutions.</textarea>
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
</div>
@endsection
