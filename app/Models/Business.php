<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;
    protected $table = 'business';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','vendor_id','business_name','primary_contact','secondary_contact','admin_email','staff_email','state','city','avg_for','avg_price','open_time','close_time','amenity','slug','status','business_address','description','others'];
    protected $casts = ['amenity'=>'array','others'=>'array'];

    public function getBusinessNameAttribute($value)
    {
    	return ucfirst($value);
    }

    public function vendor_user() {
        return $this->belongsTo(\App\Models\User::class, 'vendor_id', 'id');
    }

    public function user() {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    public function cities()
    {
    	return $this->belongsTo(\App\Models\City::class,'city','id');
    }

    public function states()
    {
    	return $this->belongsTo(\App\Models\State::class,'state','id');
    }
}
