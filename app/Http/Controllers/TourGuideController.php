<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class TourGuideController extends Controller
{
    /**
     * Show the tour guide's location listing
     */
    public function index()
    {
        $locations = Location::where('user_id', auth()->id())
            ->with(['images' => function($query) {
                $query->where('is_approved', true);
            }])
            ->latest()
            ->paginate(12);
        
        return view('tourguide.index', compact('locations'));
    }

    /**
     * Show a specific location for the tour guide
     */
    public function show(Location $location)
    {
        // Ensure the tour guide can only view their own locations
        if ($location->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        $location->load(['images', 'edits', 'user']);
        
        return view('tourguide.show', compact('location'));
    }
}
