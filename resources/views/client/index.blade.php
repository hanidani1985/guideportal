@extends('layouts.app')

@section('title', 'Discover Sumba Locations')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
        <div class="text-center">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4">
                Discover Sumba's Hidden Gems
            </h1>
            <p class="text-lg sm:text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Explore breathtaking locations curated by local tour guides
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('client.map') }}" class="px-6 py-3 bg-white text-blue-600 rounded-lg hover:bg-gray-100 font-semibold inline-flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                    </svg>
                    View on Map
                </a>
                <a href="#locations" class="px-6 py-3 bg-transparent border-2 border-white text-white rounded-lg hover:bg-white hover:text-blue-600 font-semibold inline-flex items-center justify-center">
                    Browse Locations
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Locations Grid -->
<div id="locations" class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if($locations->count() > 0)
        <div class="mb-8">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
                Featured Locations
            </h2>
            <p class="text-gray-600">
                {{ $locations->total() }} amazing places to explore
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($locations as $location)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <!-- Image -->
                    <div class="aspect-video bg-gray-200 overflow-hidden">
                        @if($location->approvedImages->count() > 0)
                            <img src="{{ Storage::url($location->approvedImages->first()->image_path) }}" 
                                 alt="{{ $location->name }}"
                                 class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">
                            {{ $location->name }}
                        </h3>
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                            {{ $location->short_description }}
                        </p>
                        
                        <!-- Metadata -->
                        <div class="flex flex-wrap gap-2 mb-3">
                            @if($location->entry_price)
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded">
                                    {{ number_format($location->entry_price, 0) }} {{ $location->currency }}
                                </span>
                            @else
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded">
                                    Free Entry
                                </span>
                            @endif
                            
                            @if($location->best_time_year)
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded">
                                    {{ Str::limit($location->best_time_year, 15) }}
                                </span>
                            @endif
                        </div>

                        <!-- Tour Guide -->
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            By {{ $location->user->name }}
                        </div>

                        <!-- View Button -->
                        <a href="{{ route('client.locations.show', $location) }}" 
                           class="block w-full py-2 px-4 bg-blue-600 text-white text-center rounded-lg hover:bg-blue-700 font-medium transition-colors">
                            View Details
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $locations->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">No locations yet</h3>
            <p class="mt-2 text-sm text-gray-500">
                Check back soon for amazing locations!
            </p>
        </div>
    @endif
</div>
@endsection
