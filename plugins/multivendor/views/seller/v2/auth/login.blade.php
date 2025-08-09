<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Seller v2 - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-teal-50 to-blue-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <div class="flex justify-center mb-6">
                <img src="{{ asset('public/themes/fashion-theme/images/logo.png') }}" alt="Ecojarah" class="w-16 h-16" />
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Ecojarah</h2>
            <p class="text-gray-600">Sign in to your seller dashboard</p>
        </div>

        <form method="POST" action="{{ route('plugin.multivendor.seller.v2.login.attempt') }}" class="mt-8 space-y-6">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input id="email" name="email" type="email" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-teal focus:border-transparent" placeholder="Enter your email" />
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input id="password" name="password" type="password" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-teal focus:border-transparent" placeholder="Enter your password" />
                </div>
            </div>

            @if ($errors->has('login_error'))
                <p class="text-sm text-red-600">{{ $errors->first('login_error') }}</p>
            @endif

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-primary-teal border-gray-300 rounded focus:ring-primary-teal" />
                    <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                </div>
                <div class="text-sm">
                    <a href="{{ route('plugin.multivendor.seller.password.reset.link.page') }}" class="font-medium text-primary-teal hover:text-primary-teal-dark">Forgot password?</a>
                </div>
            </div>

            <div>
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary-teal hover:bg-primary-teal-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-teal">
                    Sign in
                </button>
            </div>
        </form>
    </div>
</body>
</html>


