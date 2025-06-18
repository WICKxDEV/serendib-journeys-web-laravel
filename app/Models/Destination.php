<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'location', 'image_url', 'category'];

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }
}
