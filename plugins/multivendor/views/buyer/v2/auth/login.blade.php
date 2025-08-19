<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Buyer Login - Ecojarah</title>

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
<body class="bg-gradient-to-b from-blue-50 to-blue-100 min-h-screen">
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="text-center">
                <!-- Logo -->
                <div class="flex justify-center mb-6">
                    <div class="w-16 h-16 bg-primary-teal rounded-full flex items-center justify-center">
                        <span class="text-white text-2xl font-bold">E</span>
                    </div>
                </div>
                
                <!-- Brand Name -->
                <h1 class="text-4xl font-bold text-gray-900 mb-2">Ecojarah</h1>
                
                <!-- Subtitle -->
                <p class="text-lg text-gray-600 mb-8">Sign in to your buyer dashboard</p>
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

            <form class="space-y-6" action="{{ route('plugin.multivendor.buyer.v2.login.attempt') }}" method="POST">
                @csrf
                
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input id="email" name="email" type="email" autocomplete="email" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-teal focus:border-primary-teal"
                           placeholder="Enter your email"
                           value="{{ old('email') }}">
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-teal focus:border-primary-teal"
                           placeholder="Enter your password">
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox" 
                               class="h-4 w-4 text-primary-teal focus:ring-primary-teal border-gray-300 rounded">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                            Remember me
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-medium text-primary-teal hover:text-primary-teal-dark">
                            Forgot password?
                        </a>
                    </div>
                </div>

                <!-- Sign In Button -->
                <div>
                    <button type="submit" 
                            class="w-full bg-primary-teal text-white py-3 px-4 rounded-lg font-semibold hover:bg-primary-teal-dark transition-colors duration-200">
                        Sign in as Buyer
                    </button>
                </div>

                <!-- Registration Link -->
                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Don't have an account? 
                        <a href="{{ route('plugin.multivendor.buyer.v2.register') }}" class="font-medium text-primary-teal hover:text-primary-teal-dark">
                            Register here
                        </a>
                    </p>
                </div>

                <!-- Seller Login Link -->
                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Are you a seller? 
                        <a href="#" class="font-medium text-primary-teal hover:text-primary-teal-dark">
                            Sign in here
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
