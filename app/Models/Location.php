<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'short_description',
        'long_description',
        'latitude',
        'longitude',
        'entry_price',
        'currency',
        'best_time_year',
        'best_hours',
        'best_tide_level',
        'suitable_vehicles',
        'is_approved',
    ];

    protected $casts = [
        'suitable_vehicles' => 'array',
        'is_approved' => 'boolean',
        'entry_price' => 'decimal:2',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(LocationImage::class);
    }

    public function approvedImages()
    {
        return $this->hasMany(LocationImage::class)->where('is_approved', true);
    }

    public function edits()
    {
        return $this->hasMany(LocationEdit::class);
    }

    public function pendingEdits()
    {
        return $this->hasMany(LocationEdit::class)->where('status', 'pending');
    }
}
