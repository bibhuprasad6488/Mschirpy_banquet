<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
   use HasFactory;

   protected $table = 'customers';
   protected $primaryKey = 'id';
   protected $fillable = ['customer_name', 'email_id', 'mobile', 'otp', 'status', 'password', 'is_used'];

   public function event()
   {
      return $this->hasMany(\App\Models\Event::class, 'customer_id', 'id');
   }
   public function booking()
   {
      return $this->hasMany(\App\Models\Booking::class, 'customer_id', 'id');
   }
}