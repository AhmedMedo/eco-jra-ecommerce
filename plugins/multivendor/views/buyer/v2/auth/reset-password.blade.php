<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Reset Password - Ecojarah</title>

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
                <p class="text-lg text-gray-600 mb-8">Set your new password</p>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif

            <form class="space-y-6" action="{{ route('plugin.multivendor.buyer.v2.password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input id="email" name="email" type="email" autocomplete="email" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-teal focus:border-primary-teal"
                           placeholder="Enter your email address"
                           value="{{ $email ?? old('email') }}">
                </div>

                <!-- New Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-teal focus:border-primary-teal"
                           placeholder="Enter your new password">
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-teal focus:border-primary-teal"
                           placeholder="Confirm your new password">
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" 
                            class="w-full bg-primary-teal text-white py-3 px-4 rounded-lg font-semibold hover:bg-primary-teal-dark transition-colors duration-200">
                        Reset Password
                    </button>
                </div>

                <!-- Back to Login Link -->
                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Remember your password? 
                        <a href="{{ route('plugin.multivendor.buyer.v2.login') }}" class="font-medium text-primary-teal hover:text-primary-teal-dark">
                            Sign in here
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
