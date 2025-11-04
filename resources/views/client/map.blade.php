@extends('layouts.app')

@section('title', 'Explore Locations on Map')

@section('content')
<div class="h-screen flex flex-col">
    <!-- Map Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Explore Map</h1>
                    <p class="text-sm text-gray-600">{{ $locations->count() }} locations available</p>
                </div>
                <a href="{{ route('client.locations.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    Grid View
                </a>
            </div>
        </div>
    </div>

    <!-- Map Container -->
    <div id="main-map" class="flex-1"></div>
</div>

@push('styles')
<style>
    .leaflet-popup-content {
        margin: 8px;
        min-width: 200px;
    }
    .location-popup h3 {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 8px;
        color: #1f2937;
    }
    .location-popup p {
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 8px;
        line-height: 1.4;
    }
    .location-popup .price {
        display: inline-block;
        padding: 4px 8px;
        background-color: #10b981;
        color: white;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 8px;
    }
    .location-popup .free {
        background-color: #3b82f6;
    }
    .location-popup a {
        display: block;
        text-align: center;
        padding: 6px 12px;
        background-color: #2563eb;
        color: white;
        border-radius: 6px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        margin-top: 8px;
    }
    .location-popup a:hover {
        background-color: #1d4ed8;
    }
</style>
@endpush

@push('scripts')
<script>
    // Initialize map centered on Sumba, Indonesia
    const map = L.map('main-map', {
        center: [-9.65, 119.4], // Approximate center of Sumba
        zoom: 10,
        zoomControl: true
    });

    // Add tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 19
    }).addTo(map);

    // Locations data
    const locations = @json($locations);

    // Create markers
    const markers = [];
    const bounds = [];

    locations.forEach(location => {
        const lat = parseFloat(location.latitude);
        const lng = parseFloat(location.longitude);
        
        if (!isNaN(lat) && !isNaN(lng)) {
            bounds.push([lat, lng]);
            
            // Create popup content
            const priceHtml = location.entry_price 
                ? `<span class="price">${parseFloat(location.entry_price).toLocaleString()} ${location.currency}</span>`
                : `<span class="price free">Free Entry</span>`;
            
            const popupContent = `
                <div class="location-popup">
                    <h3>${location.name}</h3>
                    <p>${location.short_description.substring(0, 100)}${location.short_description.length > 100 ? '...' : ''}</p>
                    ${priceHtml}
                    <a href="/locations/${location.id}">View Details</a>
                </div>
            `;
            
            // Create custom icon
            const icon = L.divIcon({
                className: 'custom-marker',
                html: `<div style="background-color: #2563eb; width: 32px; height: 32px; border-radius: 50% 50% 50% 0; transform: rotate(-45deg); border: 3px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.3);"><div style="transform: rotate(45deg); width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: white; font-size: 14px;">📍</div></div>`,
                iconSize: [32, 32],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32]
            });
            
            // Add marker
            const marker = L.marker([lat, lng], { icon: icon })
                .addTo(map)
                .bindPopup(popupContent);
            
            markers.push(marker);
        }
    });

    // Fit map to show all markers
    if (bounds.length > 0) {
        map.fitBounds(bounds, { padding: [50, 50] });
    }

    // Add marker cluster support if many locations (optional enhancement)
    if (markers.length > 20) {
        console.log('Consider adding marker clustering for better performance');
    }
</script>
@endpush
@endsection
