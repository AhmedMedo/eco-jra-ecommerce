<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Account Under Review - Ecojarah</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Language Toggle -->
    <div class="absolute top-6 right-6 z-10">
        <button class="px-4 py-2 text-sm border border-gray-300 rounded text-gray-600 hover:bg-gray-50 bg-white shadow-sm">
            EN/AR
        </button>
    </div>

    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center py-8 px-4">
        <div class="w-full max-w-4xl">
            <!-- Main Content Card -->
            <div class="bg-white rounded-lg shadow-lg border-2 border-dashed border-blue-300 p-12 text-center">
                <!-- Logo -->
                <div class="flex justify-center mb-8">
                    <img src="{{ asset('logo/eco-jara-logo.jpeg') }}" alt="Ecojarah" class="w-20 h-20 rounded-full" />
                </div>

                <!-- Main Content -->
                <div class="text-center">
                    <!-- Title -->
                    <h1 class="text-4xl font-bold text-gray-900 mb-6">Your Account is Under Review</h1>
                    
                    <!-- Illustration Placeholder -->
                    <div class="w-40 h-40 mx-auto mb-8 bg-gradient-to-br from-green-100 to-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-20 h-20 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>

                    <!-- Thank you message -->
                    <p class="text-xl text-gray-700 mb-6 font-semibold">Thank you for registering with Ecojarah!</p>
                    
                    <!-- Description -->
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed max-w-2xl mx-auto">
                        Our team is verifying your details to ensure compliance with <strong>Egyptian Electricity Regulatory Authority</strong> requirements.
                    </p>
                    
                    <!-- Email confirmation -->
                    <p class="text-lg text-gray-600 mb-4">
                        You'll receive a confirmation email at 
                        <span class="text-blue-600 font-bold text-xl">{{ auth()->user()->email }}</span>
                    </p>
                    
                    <!-- Processing time -->
                    <p class="text-blue-600 text-lg font-bold">Typically 1-2 business days</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
