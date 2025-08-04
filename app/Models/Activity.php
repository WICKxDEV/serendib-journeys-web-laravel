<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
        'duration',
        'price',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'tour_activities')
                    ->withPivot('order', 'day', 'start_time', 'end_time', 'notes')
                    ->withTimestamps();
    }
}