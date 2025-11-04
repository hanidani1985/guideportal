@extends('layouts.app')

@section('title', $location->name . ' - My Location')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('tourguide.locations.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to My Locations
        </a>
    </div>

    <!-- Status Banner -->
    @if(!$location->is_approved)
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        This location is pending approval. It will be visible to the public once an admin approves it.
                    </p>
                </div>
            </div>
        </div>
    @else
        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700">
                        This location is approved and visible to the public. 
                        <a href="{{ route('client.locations.show', $location) }}" class="underline font-medium">View public page</a>
                    </p>
                </div>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Location Details Card -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
                        {{ $location->name }}
                    </h1>
                    <a href="{{ route('filament.admin.resources.locations.locations.edit', $location) }}" 
                       class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                        Edit
                    </a>
                </div>

                <div class="space-y-4">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Short Description</h3>
                        <p class="text-gray-700">{{ $location->short_description }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Full Description</h3>
                        <p class="text-gray-700 whitespace-pre-line">{{ $location->long_description }}</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 border-t">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Entry Price</h3>
                            <p class="text-lg font-bold text-gray-900">
                                @if($location->entry_price)
                                    {{ number_format($location->entry_price, 0) }} {{ $location->currency }}
                                @else
                                    Free
                                @endif
                            </p>
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Coordinates</h3>
                            <p class="text-sm text-gray-700">
                                {{ $location->latitude }}, {{ $location->longitude }}
                            </p>
                        </div>

                        @if($location->best_time_year)
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Best Season</h3>
                                <p class="text-gray-700">{{ $location->best_time_year }}</p>
                            </div>
                        @endif

                        @if($location->best_hours)
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Best Hours</h3>
                                <p class="text-gray-700">{{ $location->best_hours }}</p>
                            </div>
                        @endif

                        @if($location->best_tide_level)
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Best Tide Level</h3>
                                <p class="text-gray-700">{{ $location->best_tide_level }}</p>
                            </div>
                        @endif

                        @if($location->suitable_vehicles && count($location->suitable_vehicles) > 0)
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Suitable Vehicles</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($location->suitable_vehicles as $vehicle)
                                        <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs rounded">
                                            {{ ucfirst(str_replace('_', ' ', $vehicle)) }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Images Section -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-bold text-gray-900">Images</h2>
                    <a href="{{ route('filament.admin.resources.location-images.location-images.create') }}?location_id={{ $location->id }}" 
                       class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-medium text-sm">
                        + Add Image
                    </a>
                </div>

                @if($location->images->count() > 0)
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @foreach($location->images as $image)
                            <div class="relative group">
                                <div class="aspect-square rounded-lg overflow-hidden">
                                    <img src="{{ Storage::url($image->image_path) }}" 
                                         alt="{{ $image->caption ?? $location->name }}"
                                         class="w-full h-full object-cover">
                                </div>
                                <div class="absolute top-2 right-2">
                                    @if($image->is_approved)
                                        <span class="px-2 py-1 bg-green-500 text-white text-xs font-semibold rounded">
                                            Approved
                                        </span>
                                    @else
                                        <span class="px-2 py-1 bg-yellow-500 text-white text-xs font-semibold rounded">
                                            Pending
                                        </span>
                                    @endif
                                </div>
                                @if($image->caption)
                                    <p class="mt-2 text-xs text-gray-600">{{ $image->caption }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="mt-2">No images uploaded yet</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('filament.admin.resources.locations.locations.edit', $location) }}" 
                       class="block w-full px-4 py-2 bg-blue-600 text-white text-center rounded-lg hover:bg-blue-700 font-medium">
                        Edit Location
                    </a>
                    <a href="{{ route('filament.admin.resources.location-images.location-images.create') }}?location_id={{ $location->id }}" 
                       class="block w-full px-4 py-2 bg-green-600 text-white text-center rounded-lg hover:bg-green-700 font-medium">
                        Add Images
                    </a>
                    @if($location->is_approved)
                        <a href="{{ route('client.locations.show', $location) }}" 
                           class="block w-full px-4 py-2 bg-gray-100 text-gray-700 text-center rounded-lg hover:bg-gray-200 font-medium">
                            View Public Page
                        </a>
                    @endif
                </div>
            </div>

            <!-- Map Preview -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Location Map</h3>
                <div id="location-map" class="w-full h-64 rounded-lg overflow-hidden"></div>
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
        .bindPopup('<strong>{{ addslashes($location->name) }}</strong>')
        .openPopup();
</script>
@endpush
@endsection
