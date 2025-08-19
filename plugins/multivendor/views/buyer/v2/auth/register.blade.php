<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Buyer Registration - Ecojarah</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-teal': '#14b8a6',
                        'primary-teal-dark': '#0f766e',
                    }
                }
            }
        }
    </script>

    <style>
        .register-gradient {
            background: linear-gradient(135deg, #167070 0%, #013f59 100%);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex">
        <!-- Left Side - Registration Form -->
        <div class="flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8">
                <!-- Logo -->
                <div class="flex justify-center mb-6">
                    <img src="{{ asset('logo/eco-jara-logo.jpeg') }}" alt="Ecojarah" class="w-16 h-16" />
                </div>
                <div>
                    <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                        Create your buyer account
                    </h2>
                    <p class="mt-2 text-center text-sm text-gray-600">
                        Join Ecojarah and start your renewable energy journey
                    </p>
                </div>

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 rounded-md p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">
                                    There were errors with your submission
                                </h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <form class="mt-8 space-y-6" action="{{ route('plugin.multivendor.buyer.v2.register.attempt') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                                <input id="first_name" name="first_name" type="text" required 
                                       class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-primary-teal focus:border-primary-teal focus:z-10 sm:text-sm" 
                                       placeholder="First Name"
                                       value="{{ old('first_name') }}">
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                                <input id="last_name" name="last_name" type="text" required 
                                       class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-primary-teal focus:border-primary-teal focus:z-10 sm:text-sm" 
                                       placeholder="Last Name"
                                       value="{{ old('last_name') }}">
                            </div>
                        </div>

                        <div>
                            <label for="company_name" class="block text-sm font-medium text-gray-700">Company Name</label>
                            <input id="company_name" name="company_name" type="text" 
                                   class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-primary-teal focus:border-primary-teal focus:z-10 sm:text-sm" 
                                   placeholder="Company Name"
                                   value="{{ old('company_name') }}">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                            <input id="email" name="email" type="email" autocomplete="email" required 
                                   class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-primary-teal focus:border-primary-teal focus:z-10 sm:text-sm" 
                                   placeholder="Email address"
                                   value="{{ old('email') }}">
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                            <input id="phone" name="phone" type="tel" 
                                   class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-primary-teal focus:border-primary-teal focus:z-10 sm:text-sm" 
                                   placeholder="Phone Number"
                                   value="{{ old('phone') }}">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Create Password</label>
                                <input id="password" name="password" type="password" autocomplete="new-password" required 
                                       class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-primary-teal focus:border-primary-teal focus:z-10 sm:text-sm" 
                                       placeholder="Create Password">
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required 
                                       class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-primary-teal focus:border-primary-teal focus:z-10 sm:text-sm" 
                                       placeholder="Confirm Password">
                            </div>
                        </div>

                        <div>
                            <label for="vat_number" class="block text-sm font-medium text-gray-700">VAT Registration Number (Optional)</label>
                            <input id="vat_number" name="vat_number" type="text" 
                                   class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-primary-teal focus:border-primary-teal focus:z-10 sm:text-sm" 
                                   placeholder="VAT Registration Number (Optional)"
                                   value="{{ old('vat_number') }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">KYC Document Upload</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center bg-gray-50">
                                <div class="flex flex-col items-center space-y-3">
                                    <svg class="w-10 h-10 text-primary-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <p class="text-gray-700 text-sm">Drag and drop your documents here</p>
                                    <p class="text-gray-500 text-xs">Upload your business license and other required documents for verification.</p>
                                    <label class="inline-flex items-center justify-center px-4 py-2 bg-primary-teal text-white rounded-lg cursor-pointer hover:bg-primary-teal-dark">
                                        Browse Files
                                        <input type="file" name="kyc_files[]" class="hidden" multiple accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <input id="terms" name="agree" type="checkbox" required
                               class="mt-1 h-4 w-4 text-primary-teal focus:ring-primary-teal border-gray-300 rounded">
                        <label for="terms" class="text-sm text-gray-700">
                            I agree to the 
                            <a href="#" class="font-medium text-primary-teal hover:text-primary-teal-dark">Terms of Service</a>
                            and 
                            <a href="#" class="font-medium text-primary-teal hover:text-primary-teal-dark">Privacy Policy</a>
                        </label>
                    </div>

                    <div>
                        <button type="submit" 
                                class="w-full bg-primary-teal text-white py-3 px-4 rounded-lg font-semibold hover:bg-primary-teal-dark transition-colors duration-200">
                            Create Account
                        </button>
                    </div>

                    <div class="text-center">
                        <p class="text-sm text-gray-600">
                            Already have an account? 
                            <a href="{{ route('plugin.multivendor.buyer.v2.login') }}" class="font-medium text-primary-teal hover:text-primary-teal-dark">
                                Sign in here
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Side - Image/Info -->
        <div class="hidden lg:block relative w-0 flex-1">
            <div class="register-gradient absolute inset-0 h-full w-full">
                <div class="flex items-center justify-center h-full">
                    <div class="text-center text-white px-8">
                        <h1 class="text-4xl font-bold mb-4">Ecojarah</h1>
                        <p class="text-xl mb-6">Join the Renewable Energy Revolution</p>
                        <div class="space-y-4">
                            <div class="flex items-center justify-center">
                                <svg class="w-6 h-6 mr-3 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>Access to IREC marketplace</span>
                            </div>
                            <div class="flex items-center justify-center">
                                <svg class="w-6 h-6 mr-3 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>Track your energy portfolio</span>
                            </div>
                            <div class="flex items-center justify-center">
                                <svg class="w-6 h-6 mr-3 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>Real-time monitoring & reports</span>
                            </div>
                            <div class="flex items-center justify-center">
                                <svg class="w-6 h-6 mr-3 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>Expert support & guidance</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
