@extends('layouts.app')

@section('title', $location->name)

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('client.locations.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Locations
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Location Name -->
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                {{ $location->name }}
            </h1>

            <!-- Tour Guide Info -->
            <div class="flex items-center text-gray-600 mb-6">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span>Recommended by <strong>{{ $location->user->name }}</strong></span>
            </div>

            <!-- Image Gallery -->
            @if($location->approvedImages->count() > 0)
                <div class="mb-8">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($location->approvedImages->take(4) as $image)
                            <div class="aspect-video rounded-lg overflow-hidden shadow-md">
                                <img src="{{ Storage::url($image->image_path) }}" 
                                     alt="{{ $image->caption ?? $location->name }}"
                                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                            </div>
                        @endforeach
                    </div>
                    @if($location->approvedImages->count() > 4)
                        <p class="text-sm text-gray-500 mt-2 text-center">
                            +{{ $location->approvedImages->count() - 4 }} more images
                        </p>
                    @endif
                </div>
            @endif

            <!-- Short Description -->
            <div class="bg-blue-50 border-l-4 border-blue-600 p-4 mb-6">
                <p class="text-lg text-gray-700">
                    {{ $location->short_description }}
                </p>
            </div>

            <!-- Long Description -->
            <div class="prose max-w-none mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">About This Location</h2>
                <p class="text-gray-700 whitespace-pre-line leading-relaxed">{{ $location->long_description }}</p>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-20">
                <!-- Price -->
                <div class="mb-6 pb-6 border-b">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Entry Price</h3>
                    @if($location->entry_price)
                        <p class="text-3xl font-bold text-green-600">
                            {{ number_format($location->entry_price, 0) }} {{ $location->currency }}
                        </p>
                    @else
                        <p class="text-3xl font-bold text-blue-600">Free</p>
                    @endif
                </div>

                <!-- Best Time to Visit -->
                @if($location->best_time_year || $location->best_hours || $location->best_tide_level)
                    <div class="mb-6 pb-6 border-b">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-3">Best Time to Visit</h3>
                        
                        @if($location->best_time_year)
                            <div class="flex items-start mb-3">
                                <svg class="w-5 h-5 text-blue-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <div>
                                    <p class="text-xs text-gray-500">Season</p>
                                    <p class="text-gray-900 font-medium">{{ $location->best_time_year }}</p>
                                </div>
                            </div>
                        @endif

                        @if($location->best_hours)
                            <div class="flex items-start mb-3">
                                <svg class="w-5 h-5 text-blue-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <p class="text-xs text-gray-500">Time of Day</p>
                                    <p class="text-gray-900 font-medium">{{ $location->best_hours }}</p>
                                </div>
                            </div>
                        @endif

                        @if($location->best_tide_level)
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-blue-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path>
                                </svg>
                                <div>
                                    <p class="text-xs text-gray-500">Tide Level</p>
                                    <p class="text-gray-900 font-medium">{{ $location->best_tide_level }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Suitable Vehicles -->
                @if($location->suitable_vehicles && count($location->suitable_vehicles) > 0)
                    <div class="mb-6 pb-6 border-b">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-3">Suitable Vehicles</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($location->suitable_vehicles as $vehicle)
                                <span class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded-full">
                                    {{ ucfirst(str_replace('_', ' ', $vehicle)) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Coordinates -->
                <div class="mb-6">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase mb-3">Location</h3>
                    <div class="text-sm text-gray-600 mb-3">
                        <p>Latitude: {{ $location->latitude }}</p>
                        <p>Longitude: {{ $location->longitude }}</p>
                    </div>
                    
                    <!-- Mini Map -->
                    <div id="location-map" class="w-full h-48 rounded-lg overflow-hidden shadow-md"></div>
                    
                    <a href="https://www.google.com/maps/search/?api=1&query={{ $location->latitude }},{{ $location->longitude }}" 
                       target="_blank"
                       class="mt-3 block w-full py-2 px-4 bg-blue-600 text-white text-center rounded-lg hover:bg-blue-700 font-medium transition-colors">
                        Open in Google Maps
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Initialize map
    const map = L.map('location-map', {
        center: [{{ $location->latitude }}, {{ $location->longitude }}],
        zoom: 13,
        zoomControl: true,
        scrollWheelZoom: false
    });

    // Add tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Add marker
    L.marker([{{ $location->latitude }}, {{ $location->longitude }}])
        .addTo(map)
        .bindPopup('<strong>' + {!! json_encode($location->name) !!} + '</strong>')
        .openPopup();
</script>
@endpush
@endsection
