<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationEdit extends Model
{
    protected $fillable = [
        'location_id',
        'user_id',
        'proposed_changes',
        'reason',
        'status',
        'reviewed_by',
        'review_notes',
    ];

    protected $casts = [
        'proposed_changes' => 'array',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
