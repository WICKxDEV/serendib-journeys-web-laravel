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
        'available_to',
        'duration',
        'max_guests',
        'difficulty_level'
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

    // Many-to-many relationship for multiple destinations
    public function destinations()
    {
        return $this->belongsToMany(Destination::class, 'tour_destinations')
                    ->withPivot('order', 'arrival_date', 'departure_date', 'notes')
                    ->withTimestamps();
    }

    // Many-to-many relationship for activities
    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'tour_activities')
                    ->withPivot('order', 'day', 'start_time', 'end_time', 'notes')
                    ->withTimestamps();
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Calculate total price including activities
    public function getTotalPriceAttribute()
    {
        $basePrice = $this->price ?? 0;
        $activitiesPrice = $this->activities->sum('price');
        return $basePrice + $activitiesPrice;
    }

    // Get base price (without activities)
    public function getBasePriceAttribute()
    {
        return $this->price ?? 0;
    }

    // Get total activities price
    public function getActivitiesPriceAttribute()
    {
        return $this->activities->sum('price');
    }

    // Get all destinations including primary
    public function getAllDestinationsAttribute()
    {
        $allDestinations = collect();
        
        // Add primary destination first
        if ($this->destination) {
            $allDestinations->push($this->destination);
        }
        
        // Add additional destinations
        $additionalDestinations = $this->destinations()->orderBy('order')->get();
        $allDestinations = $allDestinations->merge($additionalDestinations);
        
        return $allDestinations->unique('id');
    }

    // Get destinations list as string
    public function getDestinationsListAttribute()
    {
        return $this->all_destinations->pluck('name')->join(', ');
    }

    // Get activities list as string
    public function getActivitiesListAttribute()
    {
        return $this->activities->pluck('name')->join(', ');
    }

    // Get activities grouped by day
    public function getActivitiesByDayAttribute()
    {
        return $this->activities()
                    ->orderBy('pivot_day')
                    ->orderBy('pivot_order')
                    ->get()
                    ->groupBy('pivot.day');
    }

    // Get destinations with order
    public function getDestinationsWithOrderAttribute()
    {
        return $this->destinations()->orderBy('order')->get();
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

