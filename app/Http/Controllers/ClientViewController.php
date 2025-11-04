<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class ClientViewController extends Controller
{
    /**
     * Show all approved locations
     */
    public function index()
    {
        $locations = Location::where('is_approved', true)
            ->with(['approvedImages', 'user'])
            ->latest()
            ->paginate(12);
        
        return view('client.index', compact('locations'));
    }

    /**
     * Show a specific approved location
     */
    public function show(Location $location)
    {
        // Only show approved locations to clients
        if (!$location->is_approved) {
            abort(404);
        }

        $location->load(['approvedImages', 'user']);
        
        return view('client.show', compact('location'));
    }

    /**
     * Show map view with all approved locations
     */
    public function map()
    {
        $locations = Location::where('is_approved', true)
            ->with(['approvedImages'])
            ->select('id', 'name', 'short_description', 'latitude', 'longitude', 'entry_price', 'currency')
            ->get();
        
        return view('client.map', compact('locations'));
    }
}
