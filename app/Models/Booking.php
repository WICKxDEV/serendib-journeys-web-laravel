<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'tour_id', 
        'booking_date', 
        'guests',
        'status', 
        'total_price', 
        'payment_status',
        'guest_name',
        'guest_email',
        'guest_phone',
        'special_requests',
        'invoice_path',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'total_price' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function guide()
    {
        return $this->belongsTo(User::class, 'guide_id');
    }
}
