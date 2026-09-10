<?php

namespace App\Models;

use Database\Factories\CarFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    /** @use HasFactory<CarFactory> */
    use HasFactory;

    protected $fillable = [
        'name', 'brand', 'year', 'price_per_day', 'transmission',
        'passenger_capacity', 'description', 'status', 'main_image',
    ];

    public function images()
    {
        return $this->hasMany(CarImage::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, fn ($q, $v) => $q->where(function ($q) use ($v) {
                $q->where('name', 'like', "%{$v}%")
                  ->orWhere('brand', 'like', "%{$v}%");
            })
        )->when($filters['transmission'] ?? null, fn ($q, $v) => $q->where('transmission', $v)
        )->when($filters['capacity'] ?? null, fn ($q, $v) => $q->where('passenger_capacity', $v)
        );
    }
}
