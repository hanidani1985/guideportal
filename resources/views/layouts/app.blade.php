<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sumba Tour Guide Portal') }} - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Leaflet CSS for maps -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin=""/>
    
    @stack('styles')
</head>
<body class="bg-gray-50 font-sans antialiased">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-xl sm:text-2xl font-bold text-blue-600">
                        🏝️ Sumba Guide
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex items-center gap-2 md:hidden">
                    @auth
                        <a href="{{ route('filament.admin.pages.dashboard') }}" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('filament.admin.auth.login') }}" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600">
                            Login
                        </a>
                    @endauth
                    <button id="mobile-menu-button" type="button" class="p-2 rounded-md text-gray-700 hover:text-blue-600 hover:bg-gray-100">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex md:items-center md:gap-6">
                    <a href="{{ route('client.locations.index') }}" class="text-gray-700 hover:text-blue-600 font-medium">
                        Locations
                    </a>
                    <a href="{{ route('client.map') }}" class="text-gray-700 hover:text-blue-600 font-medium">
                        Map
                    </a>
                    @auth
                        <a href="{{ route('tourguide.locations.index') }}" class="text-gray-700 hover:text-blue-600 font-medium">
                            My Locations
                        </a>
                        <a href="{{ route('filament.admin.pages.dashboard') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('filament.admin.auth.login') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                            Login
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden pb-4">
                <div class="flex flex-col gap-2">
                    <a href="{{ route('client.locations.index') }}" class="px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-gray-100 rounded-md font-medium">
                        Locations
                    </a>
                    <a href="{{ route('client.map') }}" class="px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-gray-100 rounded-md font-medium">
                        Map
                    </a>
                    @auth
                        <a href="{{ route('tourguide.locations.index') }}" class="px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-gray-100 rounded-md font-medium">
                            My Locations
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-bold mb-4">Sumba Tour Guide Portal</h3>
                    <p class="text-gray-400 text-sm">
                        Discover the beauty of Sumba with local tour guides.
                    </p>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('client.locations.index') }}" class="text-gray-400 hover:text-white">All Locations</a></li>
                        <li><a href="{{ route('client.map') }}" class="text-gray-400 hover:text-white">Map View</a></li>
                        @auth
                            <li><a href="{{ route('filament.admin.pages.dashboard') }}" class="text-gray-400 hover:text-white">Dashboard</a></li>
                        @endauth
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">For Tour Guides</h4>
                    <p class="text-gray-400 text-sm mb-2">
                        Share your favorite locations and help travelers discover Sumba.
                    </p>
                    @guest
                        <a href="{{ route('filament.admin.auth.login') }}" class="text-blue-400 hover:text-blue-300 text-sm">
                            Login / Register
                        </a>
                    @endguest
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-700 text-center text-sm text-gray-400">
                <p>&copy; {{ date('Y') }} Sumba Tour Guide Portal. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>
    
    <!-- Mobile menu toggle -->
    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>

    @stack('scripts')
</body>
</html>
