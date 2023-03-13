<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\InteractsWithMedia;

class Booking extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $table = 'bookings';
    protected $primaryKey = 'id';
    protected $fillable = ['customer_id', 'business_id', 'booking_no', 'venue_id', 'package_id', 'book_data', 'total_amount', 'booking_datetime', 'status'];
    protected $casts = [
        'book_data' => 'array'
    ];
    public function customer()
    {
        return $this->belongsTo(\App\Models\Customer::class, 'customer_id', 'id');
    }
    public function package()
    {
        return $this->belongsTo(\App\Models\Package::class, 'package_id', 'id');
    }
    public function venue()
    {
        return $this->belongsTo(\App\Models\Venue::class, 'venue_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class,'category_id','id');
    }
}