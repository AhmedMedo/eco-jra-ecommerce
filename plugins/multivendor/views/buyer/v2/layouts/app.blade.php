<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Buyer v2')</title>

    <!-- Tailwind (scoped to v2 layout only) -->
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

    <!-- Alpine.js for light interactivity -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* Scoped helpers to avoid global leakage */
        #buyer-v2-app {
            --brand-teal: #167070;
            --brand-teal-dark: #0f5050;
            --brand-orange: #fe6625;
            --brand-orange-light: #fb9335;
            --brand-white: #ffffff;
            --brand-beige: #c19f7a;
            --brand-navy: #013f59;
        }
        #buyer-v2-app .sidebar-gradient {
            background: linear-gradient(180deg, var(--brand-teal) 0%, var(--brand-navy) 100%);
        }
        #buyer-v2-app .status-badge { padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500; }
        #buyer-v2-app .status-active { background-color: #dcfce7; color: #166534; }
        #buyer-v2-app .status-inactive { background-color: #fef9c3; color: #854d0e; }
        #buyer-v2-app .status-cancelled { background-color: #fee2e2; color: #991b1b; }
        #buyer-v2-app .btn-primary { background:#167070; color:#fff; padding:0.5rem 1rem; border-radius:0.5rem; font-weight:600; }
        #buyer-v2-app .btn-primary:hover { background:#0f5050; }
        #buyer-v2-app .btn-secondary { background:#f3f4f6; color:#374151; padding:0.5rem 1rem; border-radius:0.5rem; font-weight:600; }
        #buyer-v2-app .btn-secondary:hover { background:#e5e7eb; }
        #buyer-v2-app .table-header { background:#f9fafb; color:#374151; font-weight:600; font-size:0.875rem; }
        #buyer-v2-app .sidebar-link { display:flex; align-items:center; padding:0.75rem 1rem; color:#fff; border-radius:0.5rem; margin:0.25rem 0.5rem; }
        #buyer-v2-app .sidebar-link:hover { background: rgba(255,255,255,0.1); }
        #buyer-v2-app .sidebar-link.active { background: rgba(255,255,255,0.2); }
        
        /* Buyer Primary Color Classes */
        .buyer-primary {
            background-color: #167070 !important;
        }
        .buyer-primary-focus:focus {
            --tw-ring-color: #167070 !important;
            border-color: #167070 !important;
        }
        .buyer-primary-hover:hover {
            background-color: #0f5a5a !important;
        }
        .buyer-primary-text {
            color: #167070 !important;
        }
        .buyer-primary-border {
            border-color: #167070 !important;
        }
    </style>

    @stack('head')
    @yield('head')
    @stack('css')
</head>
<body class="bg-gray-50">
<div id="buyer-v2-app" class="flex h-screen">
    <!-- Sidebar -->
    <aside class="sidebar-gradient w-64 flex flex-col">
        <div class="flex items-center px-6 py-6 border-b border-white/20">
            <img src="{{ asset('logo/eco-jara-logo.jpeg') }}" alt="Logo" class="w-8 h-8 mr-3">
            <h1 class="text-xl font-bold text-white">Ecojarah</h1>
        </div>

        <nav class="flex-1 py-6">
            @php
                $items = [
                  ['name' => 'Dashboard', 'href' => route('plugin.multivendor.buyer.v2.dashboard')],
                  ['name' => 'Marketplace', 'href' => route('plugin.multivendor.buyer.v2.marketplace')],
                  ['name' => 'My Request', 'href' => route('plugin.multivendor.buyer.v2.my-request')],
                  ['name' => 'Certificates', 'href' => route('plugin.multivendor.buyer.v2.certificates')],
                  ['name' => 'Settings', 'href' => route('plugin.multivendor.buyer.v2.settings')],
                ];
            @endphp
            @foreach ($items as $item)
                <a href="{{ $item['href'] }}"
                   class="sidebar-link {{ url()->current() === $item['href'] ? 'active' : '' }}">
                    <span class="w-5 h-5 mr-3"></span>
                    {{ $item['name'] }}
                </a>
            @endforeach
        </nav>

        <div class="p-4 border-t border-white/20">
            <div class="relative" x-data="{ open: false }">
                <div class="flex items-center cursor-pointer" @click="open = !open">
                    <img class="w-10 h-10 rounded-full" src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?w=100&h=100&fit=crop&crop=face" alt="User">
                    <div class="ml-3">
                        <p class="text-sm font-medium text-white">{{ auth()->user()->name ?? 'Buyer' }}</p>
                        <p class="text-xs text-gray-300">Buyer</p>
                    </div>
                    <svg class="w-4 h-4 ml-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
                
                <!-- Dropdown Menu -->
                <div x-show="open" 
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="absolute bottom-full left-0 mb-2 w-48 bg-white rounded-md shadow-lg border border-gray-200 z-50"
                     @click.away="open = false">
                    <div class="py-1">
                        <a href="{{ route('plugin.multivendor.buyer.v2.settings') }}" 
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Profile Settings
                        </a>
                        <hr class="my-1">
                        <form method="POST" action="{{ route('plugin.multivendor.buyer.v2.logout') }}">
                            @csrf
                            <button type="submit" 
                                    class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                Sign Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <header class="bg-white shadow-sm border-b border-gray-200">
            <div class="flex items-center justify-between px-6 py-4">
                <div class="flex items-center">
                    <h2 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                </div>
                <div class="flex items-center space-x-4">
                    <!-- Search Bar -->
{{--                    <div class="relative">--}}
{{--                        <input type="text" placeholder="Search projects..." --}}
{{--                               class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-teal focus:border-primary-teal">--}}
{{--                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">--}}
{{--                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>--}}
{{--                            </svg>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    
                    <!-- Notification Bell -->
                    <button class="relative p-2 text-gray-600 hover:text-gray-800">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                        </svg>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>
                    
                    <!-- User Profile with Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <div class="flex items-center cursor-pointer" @click="open = !open">
                            <img class="w-8 h-8 rounded-full" src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?w=100&h=100&fit=crop&crop=face" alt="User Profile">
                            <div class="ml-3 text-right">
                                <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name ?? 'Buyer' }}</p>
                                <p class="text-xs text-gray-500">Buyer</p>
                            </div>
                            <svg class="w-4 h-4 ml-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                        
                        <!-- Dropdown Menu -->
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg border border-gray-200 z-50"
                             @click.away="open = false">
                            <div class="py-1">
                                <a href="{{ route('plugin.multivendor.buyer.v2.settings') }}" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Profile Settings
                                </a>
                                <hr class="my-1">
                                <form method="POST" action="{{ route('plugin.multivendor.buyer.v2.logout') }}">
                                    @csrf
                                    <button type="submit" 
                                            class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                        Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-auto">
            @yield('content')
        </main>
    </div>
</div>

@stack('scripts')
@yield('scripts')
</body>
</html>
