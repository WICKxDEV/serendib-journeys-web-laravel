<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'destination_id', 
        'title', 
        'description', 
        'price', 
        'itinerary', 
        'images',
        'available_from', 
        'available_to'
    ];

    protected $casts = [
        'images' => 'array',
        'available_from' => 'date',
        'available_to' => 'date',
        'price' => 'decimal:2',
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getImagesArrayAttribute()
    {
        return $this->images ?? [];
    }

    public function getFirstImageAttribute()
    {
        $images = $this->images_array;
        return !empty($images) ? $images[0] : null;
    }

    public function getImageUrlAttribute()
    {
        $firstImage = $this->first_image;
        if ($firstImage) {
            return asset('storage/' . $firstImage);
        }
        return asset('img/default-tour.jpg');
    }

    public function getImageUrlsAttribute()
    {
        $images = $this->images_array;
        return array_map(function($image) {
            return asset('storage/' . $image);
        }, $images);
    }
}

