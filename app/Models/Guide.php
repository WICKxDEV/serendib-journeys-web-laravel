<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'bio',
        'profile_photo',
        'languages',
        'phone',
        'email',
        'location',
        'experience_years',
        'specializations',
        'is_active'
    ];

    protected $casts = [
        'languages' => 'array',
        'is_active' => 'boolean',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo) {
            return asset('storage/' . $this->profile_photo);
        }
        return asset('img/default-guide.jpg');
    }

    public function getLanguagesListAttribute()
    {
        if (is_array($this->languages)) {
            return implode(', ', $this->languages);
        }
        return '';
    }
}
