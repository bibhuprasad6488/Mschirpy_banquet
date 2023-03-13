<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerExperience extends Model
{
    use HasFactory;
    protected $table = 'customer_experiences';
    protected $primaryKey = 'id';
    protected $fillable = ['business_id', 'customer_name', 'room_no', 'dob', 'anniversary', 'staff', 'service', 'vibe', 'cleanliness', 'food_quality', 'delight_or_disapoint', 'about_altius', 'staff_service_exp'];
}