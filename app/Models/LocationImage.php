<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationImage extends Model
{
    protected $fillable = [
        'location_id',
        'user_id',
        'image_path',
        'caption',
        'is_approved',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
