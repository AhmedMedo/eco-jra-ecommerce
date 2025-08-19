<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Verify Email - Ecojarah</title>

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
</head>
<body class="min-h-screen bg-gradient-to-br from-teal-50 to-blue-50">
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="text-center">
                <!-- Logo -->
                <div class="flex justify-center mb-6">
                    <img src="{{ asset('logo/eco-jara-logo.jpeg') }}" alt="Ecojarah" class="w-16 h-16" />
                </div>

                <!-- Brand Name -->
                <h1 class="text-4xl font-bold text-gray-900 mb-2">Ecojarah</h1>
                
                <!-- Subtitle -->
                <p class="text-lg text-gray-600 mb-8">Verify your email address</p>
            </div>

            @if (session('status'))
                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                    <div class="text-sm text-green-700">
                        {{ session('status') }}
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                <!-- Email Icon -->
                <div class="flex justify-center mb-6">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>

                <!-- Message -->
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Check your email</h2>
                <p class="text-gray-600 mb-6">
                    We've sent a verification link to <strong>{{ auth()->user()->email }}</strong>
                </p>
                <p class="text-sm text-gray-500 mb-8">
                    Click the link in the email to verify your account and continue to your dashboard.
                </p>

                <!-- Resend Button -->
                <form method="POST" action="{{ route('plugin.multivendor.buyer.v2.verification.send') }}">
                    @csrf
                    <button type="submit" 
                            class="w-full bg-primary-teal text-white py-3 px-4 rounded-lg font-semibold hover:bg-primary-teal-dark transition-colors duration-200 mb-4">
                        Resend Verification Email
                    </button>
                </form>

                <!-- Logout Link -->
                <div class="text-center">
                    <form method="POST" action="{{ route('plugin.multivendor.buyer.v2.logout') }}">
                        @csrf
                        <button type="submit" 
                                class="text-sm text-gray-500 hover:text-gray-700 underline">
                            Sign out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
